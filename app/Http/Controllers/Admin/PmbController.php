<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PmbRegistration;
use App\Models\PmbWave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PmbController extends Controller
{
    /**
     * Tampilkan daftar pendaftar PMB.
     */
    public function index(Request $request)
    {
        $query = PmbRegistration::query();

        // Pencarian Nama / Nomor Pendaftaran
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('nomor_pendaftaran', 'LIKE', "%{$search}%");
            });
        }

        // Filter Program Studi
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->input('prodi'));
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter Gelombang
        if ($request->filled('gelombang')) {
            $query->where('gelombang', $request->input('gelombang'));
        }

        $registrations = $query->latest()->paginate(15)->withQueryString();

        $programStudis = \App\Models\ProgramStudi::orderBy('kode_nim')->get();

        return view('admin.pmb.index', compact('registrations', 'programStudis'));
    }

    /**
     * Tampilkan detail pendaftar PMB.
     */
    public function show($id)
    {
        $registration = PmbRegistration::findOrFail($id);
        return view('admin.pmb.show', compact('registration'));
    }

    /**
     * Update status pendaftaran.
     * Jika status diubah menjadi "Lulus Seleksi", data mahasiswa akan
     * dikirim secara otomatis ke sistem SIA-STIKES via API (akses pra-bayar tanpa NIM).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Lulus Seleksi,Tidak Lulus Seleksi'
        ]);

        $registration = PmbRegistration::findOrFail($id);
        $statusLama   = $registration->status;
        $statusBaru   = $request->input('status');

        $updateData = ['status' => $statusBaru];

        // Catat tanggal kelulusan jika baru pertama kali lulus seleksi
        if ($statusBaru === 'Lulus Seleksi' && empty($registration->tgl_lulus_seleksi)) {
            $updateData['tgl_lulus_seleksi'] = now();
        }

        $registration->update($updateData);

        // --- Kirim data ke SIA jika status adalah "Lulus Seleksi" ---
        if ($statusBaru === 'Lulus Seleksi') {
            $hasilIntegrasi = $this->kirimKeSia($registration);

            if ($hasilIntegrasi['success']) {
                $email = $hasilIntegrasi['data']['email_login'] ?? '-';
                $pass  = $hasilIntegrasi['data']['password_sementara'] ?? '-';

                $registration->update(['sia_account_created' => true]);

                return redirect()
                    ->route('admin.pmb.show', $id)
                    ->with('success', "Status berhasil diubah ke Lulus Seleksi. Akun SIAKAD pra-bayar berhasil dibuat.")
                    ->with('sia_info', "Email Login SIA: {$email} | Password Sementara: {$pass}");
            } else {
                // Status tetap tersimpan, tapi tampilkan peringatan integrasi gagal
                return redirect()
                    ->route('admin.pmb.show', $id)
                    ->with('warning', "Status berhasil diubah, NAMUN sinkronisasi akun SIAKAD gagal: " . $hasilIntegrasi['message']);
            }
        }

        return redirect()
            ->route('admin.pmb.show', $id)
            ->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    /**
     * Manual trigger sync data ke SIA.
     */
    public function syncSia($id)
    {
        $registration = PmbRegistration::findOrFail($id);
        
        // Auto-perbaiki format NIM jika pendaftar sudah memiliki NIM lama yang cacat (< 12 digit / tahun '00')
        if (!empty($registration->nim)) {
            $activeWave = PmbWave::getActiveWave();
            $tahun = ($activeWave && !empty($activeWave->tahun_akademik)) ? (int) substr($activeWave->tahun_akademik, 0, 4) : (int) date('Y');
            if (!$tahun || $tahun < 2000) {
                $tahun = (int) date('Y');
            }

            $nimValid = PmbRegistration::repairNimIfInvalid($registration->nim, $registration->prodi, $tahun);
            if ($nimValid !== $registration->nim) {
                $registration->update(['nim' => $nimValid]);
                $registration->refresh();
            }
        }

        // 1. Import data pendaftar ke SIAKAD
        $hasilIntegrasi = $this->kirimKeSia($registration);

        // 2. Jika punya NIM / sudah terverifikasi bayar, unlock access di SIAKAD
        if (!empty($registration->nim) || in_array($registration->status_pembayaran_daftar_ulang, ['Cicilan 1 Lunas', 'Lunas Total'])) {
            $statusBayar = $registration->status_pembayaran_daftar_ulang ?? 'Cicilan 1 Lunas';
            $this->kirimStatusPembayaranKeSia($registration, $statusBayar, $registration->nim);
        }

        if ($hasilIntegrasi['success']) {
            $nim   = $registration->nim ?? ($hasilIntegrasi['data']['nim'] ?? '-');
            return redirect()
                ->back()
                ->with('success', "Data mahasiswa " . $registration->nama_lengkap . " berhasil disinkronkan ke SIAKAD! (NIM: {$nim})");
        } else {
            return redirect()
                ->back()
                ->with('warning', "Catatan sinkronisasi SIAKAD: " . $hasilIntegrasi['message']);
        }
    }

    /**
     * Mengirimkan data pendaftar PMB ke sistem SIA-STIKES via HTTP API.
     *
     * @param  \App\Models\PmbRegistration $registration
     * @return array ['success' => bool, 'message' => string, 'data' => array]
     */
    private function kirimKeSia(PmbRegistration $registration): array
    {
        $siaUrl    = rtrim(env('SIA_API_URL', 'https://dev.stikesmuwsb.ac.id'), '/');
        $siaSecret = env('SIA_API_SECRET', 'sia-stikes-pmb-secret-2026');
        $endpoint  = $siaUrl . '/api/mahasiswa/import-pmb';

        try {
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()->withHeaders([
                'X-PMB-Secret' => $siaSecret,
                'Accept'       => 'application/json',
            ])->timeout(15)->post($endpoint, [
                'pmb_id'          => $registration->id,
                'nomor_pendaftaran'=> $registration->nomor_pendaftaran,
                'nama_lengkap'    => $registration->nama_lengkap,
                'nomor_ktp'       => $registration->nomor_ktp,
                'nisn'            => $registration->nisn,
                'npsn'            => $registration->npsn,
                'jenis_kelamin'   => $registration->jenis_kelamin,
                'tempat_lahir'    => $registration->tempat_lahir,
                'tanggal_lahir'   => $registration->tanggal_lahir,
                'asal_sekolah'    => $registration->asal_sekolah,
                'jurusan'         => $registration->jurusan,
                'tahun_lulus'     => (string) $registration->tahun_lulus,
                'no_hp'           => $registration->no_hp,
                'prodi'           => $registration->prodi,
                'nim'             => $registration->nim,
                'alamat_dusun'    => $registration->alamat_dusun,
                'alamat_kecamatan_kabupaten' => $registration->alamat_kecamatan_kabupaten,
                'nik_ayah'        => $registration->ktp_ayah,
                'nama_ayah'       => $registration->nama_ayah,
                'pekerjaan_ayah'  => $registration->pekerjaan_ayah,
                'penghasilan_ayah'=> $registration->penghasilan_ayah,
                'nik_ibu'         => $registration->ktp_ibu,
                'nama_ibu'        => $registration->nama_ibu,
                'pekerjaan_ibu'   => $registration->pekerjaan_ibu,
                'penghasilan_ibu' => $registration->penghasilan_ibu,
                'alamat_orangtua_dusun'     => $registration->alamat_orangtua_dusun,
                'alamat_orangtua_kecamatan_kabupaten' => $registration->alamat_orangtua_kecamatan_kabupaten,
                'no_hp_orangtua'  => $registration->no_hp_orangtua,
                'nik_wali'        => $registration->ktp_wali,
                'nama_wali'       => $registration->nama_wali,
                'pekerjaan_wali'  => $registration->pekerjaan_wali,
                'alamat_wali_dusun' => $registration->alamat_wali_dusun,
                'no_hp_wali'      => $registration->no_hp_wali,
            ]);

            $body = $response->json();

            if ($response->successful() && ($body['success'] ?? false)) {
                return [
                    'success' => true,
                    'message' => $body['message'] ?? 'Berhasil.',
                    'data'    => $body['data'] ?? [],
                ];
            }

            return [
                'success' => false,
                'message' => $body['message'] ?? "HTTP {$response->status()}: Gagal mengirim data ke SIA.",
                'data'    => [],
            ];

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return [
                'success' => false,
                'message' => 'Tidak dapat terhubung ke SIA. Pastikan server SIA sedang berjalan di ' . $siaUrl,
                'data'    => [],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'data'    => [],
            ];
        }
    }


    /**
     * Hapus pendaftar.
     */
    public function destroy($id)
    {
        $registration = PmbRegistration::findOrFail($id);
        
        // Hapus pas foto dari storage
        if ($registration->pas_foto) {
            Storage::disk('public')->delete($registration->pas_foto);
        }

        $registration->delete();

        return redirect()->route('admin.pmb.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }
    /**
     * Cetak Rekap Pendaftar yang Lulus Seleksi.
     */
    public function printRekap(Request $request)
    {
        $query = PmbRegistration::where('status', 'Lulus Seleksi');

        if ($request->filled('prodi')) {
            $query->where('prodi', $request->input('prodi'));
        }

        if ($request->filled('gelombang')) {
            $query->where('gelombang', $request->input('gelombang'));
        }

        $registrations = $query->orderBy('gelombang')->orderBy('prodi')->orderBy('nama_lengkap')->get();
        $filterProdi    = $request->input('prodi', 'Semua');
        $filterGelombang = $request->input('gelombang', 'Semua');
        $totalLulus     = $registrations->count();
        $byProdi        = $registrations->groupBy('prodi');
        $byGelombang    = $registrations->groupBy('gelombang');

        return view('admin.pmb.print_rekap', compact(
            'registrations', 'filterProdi', 'filterGelombang',
            'totalLulus', 'byProdi', 'byGelombang'
        ));
    }

    /**
     * Verifikasi pembayaran daftar ulang (Staff Keuangan / Super Admin).
     * Pilihan aksi: 'Cicilan 1 Lunas', 'Lunas Total', 'Ditolak'.
     * Saat pembayaran pertama kali disahkan, NIM mahasiswa digenerate secara sekuensial & atomik.
     */
    public function verifyPayment(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|string|in:Cicilan 1 Lunas,Lunas Total,Ditolak',
            'catatan'           => 'nullable|string|max:1000',
        ]);

        $registration = PmbRegistration::findOrFail($id);
        $statusPembayaran = $request->input('status_pembayaran');
        $catatan          = $request->input('catatan');

        $updateData = [
            'status_pembayaran_daftar_ulang' => $statusPembayaran,
            'catatan_pembayaran'            => $catatan,
        ];

        if ($statusPembayaran === 'Cicilan 1 Lunas') {
            $updateData['tanggal_bayar_cicilan_1'] = now()->toDateString();
        } elseif ($statusPembayaran === 'Lunas Total') {
            $updateData['tanggal_bayar_cicilan_2'] = now()->toDateString();
        }

        // Generate NIM atomik jika disetujui & belum punya NIM
        $nimFinal = $registration->nim;
        if (in_array($statusPembayaran, ['Cicilan 1 Lunas', 'Lunas Total'])) {
            $updateData['tgl_verifikasi_pembayaran'] = now();

            $activeWave = PmbWave::getActiveWave();
            $tahun = ($activeWave && !empty($activeWave->tahun_akademik)) ? (int) substr($activeWave->tahun_akademik, 0, 4) : (int) date('Y');
            if (!$tahun || $tahun < 2000) {
                $tahun = (int) date('Y');
            }

            if (empty($nimFinal)) {
                $nimFinal = PmbRegistration::generateNim($registration->prodi, $tahun);
                $updateData['nim'] = $nimFinal;
            } else {
                $nimFinal = PmbRegistration::repairNimIfInvalid($nimFinal, $registration->prodi, $tahun);
                $updateData['nim'] = $nimFinal;
            }
        }

        $registration->update($updateData);

        // Jika status disahkan sebagai Cicilan 1 Lunas atau Lunas Total, buka akses penuh & kirim NIM ke SIA
        if (in_array($statusPembayaran, ['Cicilan 1 Lunas', 'Lunas Total'])) {
            $hasilSync = $this->kirimStatusPembayaranKeSia($registration, $statusPembayaran, $nimFinal);
            
            $msg = "Status pembayaran berhasil diverifikasi menjadi '{$statusPembayaran}'. NIM Resmi Mahasiswa: {$nimFinal}.";
            if ($hasilSync['success'] && !empty($hasilSync['message'])) {
                $msg .= " (" . $hasilSync['message'] . ")";
            }

            return redirect()
                ->route('admin.pmb.show', $id)
                ->with('success', $msg);
        }

        return redirect()
            ->route('admin.pmb.show', $id)
            ->with('success', "Status pembayaran daftar ulang berhasil diperbarui menjadi '{$statusPembayaran}'.");
    }


    /**
     * Mengirimkan pembaruan status pembayaran & NIM ke SIA via HTTP API untuk unlock akses penuh.
     */
    private function kirimStatusPembayaranKeSia(PmbRegistration $registration, string $statusPembayaran, ?string $nim = null): array
    {
        try {
            $siaUrl = rtrim(env('SIA_API_URL', 'https://dev.stikesmuwsb.ac.id'), '/');
            $secret = env('SIA_API_SECRET', 'sia-stikes-pmb-secret-2026');

            // 1. Coba unlock access
            $payloadUnlock = [
                'pmb_id'            => $registration->id,
                'nomor_pendaftaran' => $registration->nomor_pendaftaran,
                'nomor_ktp'         => $registration->nomor_ktp,
                'nama_lengkap'      => $registration->nama_lengkap,
                'status_pembayaran' => $statusPembayaran,
                'nim'               => $nim ?? $registration->nim,
                'is_payment_verified' => true,
            ];

            $response = \Illuminate\Support\Facades\Http::withoutVerifying()->withHeaders([
                'X-PMB-Secret' => $secret,
                'Accept'       => 'application/json',
            ])->timeout(15)->post($siaUrl . '/api/mahasiswa/unlock-access', $payloadUnlock);

            // Jika 404 (belum di-import ke SIAKAD), import data pendaftar dulu
            if ($response->status() === 404) {
                $importResp = \Illuminate\Support\Facades\Http::withoutVerifying()->withHeaders([
                    'X-PMB-Secret' => $secret,
                    'Accept'       => 'application/json',
                ])->timeout(15)->post($siaUrl . '/api/mahasiswa/import-pmb', [
                    'pmb_id'                     => $registration->id,
                    'nomor_pendaftaran'          => $registration->nomor_pendaftaran,
                    'nama_lengkap'               => $registration->nama_lengkap,
                    'nomor_ktp'                  => $registration->nomor_ktp,
                    'nisn'                       => $registration->nisn,
                    'npsn'                       => $registration->npsn,
                    'jenis_kelamin'              => $registration->jenis_kelamin,
                    'tempat_lahir'               => $registration->tempat_lahir,
                    'tanggal_lahir'              => $registration->tanggal_lahir,
                    'asal_sekolah'               => $registration->asal_sekolah,
                    'jurusan'                    => $registration->jurusan,
                    'tahun_lulus'                => (string) $registration->tahun_lulus,
                    'no_hp'                      => $registration->no_hp,
                    'prodi'                      => $registration->prodi,
                    'nim'                        => $nim ?? $registration->nim,
                    'gelombang'                  => $registration->gelombang,
                    'alamat_dusun'               => $registration->alamat_dusun,
                    'alamat_kecamatan_kabupaten' => $registration->alamat_kecamatan_kabupaten,
                    'nama_ayah'                  => $registration->nama_ayah,
                    'nik_ayah'                   => $registration->ktp_ayah,
                ]);

                if ($importResp->successful()) {
                    // Coba unlock lagi
                    $response = \Illuminate\Support\Facades\Http::withoutVerifying()->withHeaders([
                        'X-PMB-Secret' => $secret,
                        'Accept'       => 'application/json',
                    ])->timeout(15)->post($siaUrl . '/api/mahasiswa/unlock-access', $payloadUnlock);
                }
            }

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Status pembayaran & NIM berhasil disinkronkan ke SIAKAD.'];
            } else {
                return ['success' => false, 'message' => $response->json('message', 'Gagal sinkronkan ke SIAKAD')];
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("PMB Payment Sync Error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}

