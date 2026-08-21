<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PmbRegistration;
use Illuminate\Http\Request;
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

        return view('admin.pmb.index', compact('registrations'));
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
     * dikirim secara otomatis ke sistem SIA-STIKES via API.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Lulus Seleksi,Tidak Lulus Seleksi'
        ]);

        $registration = PmbRegistration::findOrFail($id);
        $statusLama   = $registration->status;
        $statusBaru   = $request->input('status');

        $registration->update(['status' => $statusBaru]);

        // --- Kirim data ke SIA jika status adalah "Lulus Seleksi" ---
        if ($statusBaru === 'Lulus Seleksi') {
            $hasilIntegrasi = $this->kirimKeSia($registration);

            if ($hasilIntegrasi['success']) {
                $nim   = $hasilIntegrasi['data']['nim']        ?? '-';
                $email = $hasilIntegrasi['data']['email_login'] ?? '-';
                $pass  = $hasilIntegrasi['data']['password_sementara'] ?? '-';

                return redirect()
                    ->route('admin.pmb.show', $id)
                    ->with('success', "Status berhasil diubah ke Lulus Seleksi. Data mahasiswa telah dikirim ke SIA.")
                    ->with('sia_info', "NIM: {$nim} | Email Login SIA: {$email} | Password Sementara: {$pass}");
            } else {
                // Status tetap tersimpan, tapi tampilkan peringatan integrasi gagal
                return redirect()
                    ->route('admin.pmb.show', $id)
                    ->with('warning', "Status berhasil diubah, NAMUN pengiriman data ke SIA GAGAL: " . $hasilIntegrasi['message']);
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
        $hasilIntegrasi = $this->kirimKeSia($registration);

        if ($hasilIntegrasi['success']) {
            $nim   = $hasilIntegrasi['data']['nim']        ?? '-';
            $email = $hasilIntegrasi['data']['email_login'] ?? '-';
            $pass  = $hasilIntegrasi['data']['password_sementara'] ?? '-';

            return redirect()
                ->back()
                ->with('success', "Data mahasiswa berhasil disinkronkan ke SIA.")
                ->with('sia_info', "NIM: {$nim} | Email Login SIA: {$email} | Password Sementara: {$pass}");
        } else {
            return redirect()
                ->back()
                ->with('warning', "Gagal sinkronkan data ke SIA: " . $hasilIntegrasi['message']);
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
        $siaUrl    = rtrim(env('SIA_API_URL', 'http://localhost:8000'), '/');
        $siaSecret = env('SIA_API_SECRET', '');
        $endpoint  = $siaUrl . '/api/mahasiswa/import-pmb';

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
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
                'tahun_lulus'     => $registration->tahun_lulus,
                'no_hp'           => $registration->no_hp,
                'prodi'           => $registration->prodi,
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

        $registration->update($updateData);

        // Jika status disahkan sebagai Cicilan 1 Lunas atau Lunas Total, sync status ke SIA
        if (in_array($statusPembayaran, ['Cicilan 1 Lunas', 'Lunas Total'])) {
            $this->kirimStatusPembayaranKeSia($registration, $statusPembayaran);
        }

        return redirect()
            ->route('admin.pmb.show', $id)
            ->with('success', "Status pembayaran daftar ulang berhasil diperbarui menjadi '{$statusPembayaran}'.");
    }

    /**
     * Mengirimkan pembaruan status pembayaran daftar ulang ke SIA via HTTP API.
     */
    private function kirimStatusPembayaranKeSia(PmbRegistration $registration, string $statusPembayaran): array
    {
        try {
            $siaUrl = env('SIA_API_URL', 'http://127.0.0.1:8000');
            $secret = env('SIA_API_SECRET', 'sia-stikes-pmb-secret-2026');

            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'X-PMB-Secret' => $secret,
                'Accept'       => 'application/json',
            ])->post($siaUrl . '/api/mahasiswa/update-payment-status', [
                'pmb_id'            => $registration->id,
                'status_pembayaran' => $statusPembayaran,
            ]);

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Status pembayaran berhasil dikirim ke SIA.'];
            } else {
                return ['success' => false, 'message' => $response->json('message', 'Gagal kirim ke SIA')];
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("PMB Payment Sync Error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}

