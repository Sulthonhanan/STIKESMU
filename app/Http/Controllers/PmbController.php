<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PmbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PmbController extends Controller
{
    /**
     * Tampilkan halaman pilihan jalur seleksi.
     */
    public function jalur()
    {
        return view('pmb.jalur');
    }

    /**
     * Halaman Cek Status Pendaftaran.
     */
    public function checkStatus(Request $request)
    {
        $registration = null;
        $searched = false;
        $keyword = trim($request->input('keyword', ''));

        if ($request->filled('keyword')) {
            $searched = true;
            $registration = PmbRegistration::where('nomor_pendaftaran', $keyword)
                ->orWhere('nomor_ktp', $keyword)
                ->first();
        }

        return view('pmb.status_check', compact('registration', 'searched', 'keyword'));
    }

    /**
     * Tampilkan formulir pendaftaran dengan jalur seleksi terpilih.
     */
    public function create(Request $request)
    {
        $selectedJalur = $request->query('jalur', 'Jalur Nilai Rapor');
        $programStudis = \App\Models\ProgramStudi::active()->get();
        return view('pmb.register', compact('selectedJalur', 'programStudis'));
    }

    /**
     * Simpan data pendaftaran mahasiswa baru.
     */
    public function store(Request $request)
    {
        $jalur = $request->input('jalur_seleksi');

        $validated = $request->validate([
            // Identitas Mahasiswa
            'jalur_seleksi' => 'required|string|max:255',
            'prodi' => 'required|string|exists:program_studis,nama_prodi',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_ktp' => 'required|digits:16',
            'nisn' => 'required|digits:10',
            'npsn' => 'required|digits:8',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'no_hp' => 'required|string|max:20',
            
            // Alamat Mahasiswa
            'alamat_dusun' => 'required|string|max:255',
            'alamat_rt' => 'required|string|max:10',
            'alamat_rw' => 'required|string|max:10',
            'alamat_desa' => 'required|string|max:255',
            'alamat_kecamatan_kabupaten' => 'required|string|max:255',

            // Data Ayah
            'nama_ayah' => 'required|string|max:255',
            'ktp_ayah' => 'required|digits:16',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|string|max:255',
            
            // Data Ibu
            'nama_ibu' => 'required|string|max:255',
            'ktp_ibu' => 'required|digits:16',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|string|max:255',

            // Alamat Orang Tua
            'alamat_orangtua_dusun' => 'required|string|max:255',
            'alamat_orangtua_rt' => 'required|string|max:10',
            'alamat_orangtua_rw' => 'required|string|max:10',
            'alamat_orangtua_desa' => 'required|string|max:255',
            'alamat_orangtua_kecamatan_kabupaten' => 'required|string|max:255',
            'no_hp_orangtua' => 'required|string|max:20',

            // Data Wali (Optional)
            'nama_wali' => 'nullable|string|max:255',
            'ktp_wali' => 'nullable|digits:16',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'alamat_wali_dusun' => 'nullable|string|max:255',
            'alamat_wali_rt' => 'nullable|string|max:10',
            'alamat_wali_rw' => 'nullable|string|max:10',
            'alamat_wali_desa' => 'nullable|string|max:255',
            'alamat_wali_kecamatan_kabupaten' => 'nullable|string|max:255',

            // === Jalur Beasiswa & Prestasi (required jika jalur ini dipilih) ===
            'jenis_beasiswa' => ($jalur === 'Jalur Beasiswa & Prestasi')
                ? 'required|string|max:255'
                : 'nullable|string|max:255',
            'link_berkas_beasiswa' => ($jalur === 'Jalur Beasiswa & Prestasi')
                ? 'required|url|max:500'
                : 'nullable|url|max:500',

            // === Jalur Nilai UTBK-SNBT (required jika jalur ini dipilih) ===
            'utbk_pu'   => ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|numeric|between:200,900' : 'nullable|numeric|between:200,900',
            'utbk_ppu'  => ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|numeric|between:200,900' : 'nullable|numeric|between:200,900',
            'utbk_pbm'  => ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|numeric|between:200,900' : 'nullable|numeric|between:200,900',
            'utbk_pk'   => ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|numeric|between:200,900' : 'nullable|numeric|between:200,900',
            'utbk_lbid' => ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|numeric|between:200,900' : 'nullable|numeric|between:200,900',
            'utbk_lbing'=> ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|numeric|between:200,900' : 'nullable|numeric|between:200,900',
            'utbk_pm'   => ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|numeric|between:200,900' : 'nullable|numeric|between:200,900',
            'link_sertifikat_utbk' => ($jalur === 'Jalur Nilai UTBK-SNBT') ? 'required|url|max:500' : 'nullable|url|max:500',

            // File Uploads
            'pas_foto' => 'required|image|max:2048',
            'raport'   => 'required|image|max:2048',
            'ijazah'   => 'required|image|max:2048',

            // Persetujuan
            'pernyataan' => 'accepted',
        ], [
            'jenis_beasiswa.required'      => 'Jenis Beasiswa harus dipilih untuk Jalur Beasiswa & Prestasi.',
            'link_berkas_beasiswa.required' => 'Tautan Google Form berkas beasiswa wajib diisi.',
            'link_berkas_beasiswa.url'     => 'Tautan berkas beasiswa harus berupa URL yang valid (dimulai dengan https://).',
            'utbk_pu.required'   => 'Skor Penalaran Umum UTBK wajib diisi.',
            'utbk_ppu.required'  => 'Skor Pengetahuan & Pemahaman Umum UTBK wajib diisi.',
            'utbk_pbm.required'  => 'Skor Pemahaman Bacaan & Menulis UTBK wajib diisi.',
            'utbk_pk.required'   => 'Skor Pengetahuan Kuantitatif UTBK wajib diisi.',
            'utbk_lbid.required' => 'Skor Literasi Bahasa Indonesia UTBK wajib diisi.',
            'utbk_lbing.required'=> 'Skor Literasi Bahasa Inggris UTBK wajib diisi.',
            'utbk_pm.required'   => 'Skor Penalaran Matematika UTBK wajib diisi.',
            'link_sertifikat_utbk.required' => 'Tautan sertifikat UTBK wajib diisi.',
        ]);

        // Generate nomor pendaftaran: TAHUN-XXXX (urut, tidak reuse nomor yang pernah dipakai)
        $nomorPendaftaran = PmbRegistration::generateNomorPendaftaran();

        if ($request->hasFile('pas_foto')) {
            $validated['pas_foto'] = $request->file('pas_foto')->store('pmb_foto', 'public');
        }
        if ($request->hasFile('raport')) {
            $validated['raport_path'] = $request->file('raport')->store('pmb_dokumen', 'public');
            unset($validated['raport']);
        }
        if ($request->hasFile('ijazah')) {
            $validated['ijazah_path'] = $request->file('ijazah')->store('pmb_dokumen', 'public');
            unset($validated['ijazah']);
        }
        
        // Hapus 'pernyataan' dari array karena tidak disimpan di database
        if (isset($validated['pernyataan'])) {
            unset($validated['pernyataan']);
        }
        
        // Penentuan Gelombang Pendaftaran (Dinamis dari PmbWave database)
        $activeWave = \App\Models\PmbWave::getActiveWave();
        $gelombang  = $activeWave ? $activeWave->nama_gelombang : 'Gelombang 1';
        $validated['gelombang'] = $gelombang;

        $validated['nomor_pendaftaran'] = $nomorPendaftaran;
        $validated['status'] = 'Pending';

        $registration = PmbRegistration::create($validated);

        return redirect()->route('pmb.success', $registration->id)->with('success', 'Pendaftaran online Anda berhasil dikirim!');
    }

    /**
     * Tampilkan halaman sukses pendaftaran.
     */
    public function success($id)
    {
        $registration = PmbRegistration::findOrFail($id);
        return view('pmb.success', compact('registration'));
    }

    /**
     * Halaman khusus cetak formulir untuk siswa.
     */
    public function print($id)
    {
        $registration = PmbRegistration::findOrFail($id);
        return view('pmb.print', compact('registration'));
    }

    /**
     * Handle upload foto struk transfer daftar ulang (Cicilan 1 / Cicilan 2).
     */
    public function uploadBuktiBayar(Request $request, $id)
    {
        $registration = PmbRegistration::findOrFail($id);

        // Strip format rupiah (titik) sebelum validasi
        if ($request->has('nominal')) {
            $request->merge([
                'nominal' => str_replace('.', '', $request->input('nominal'))
            ]);
        }

        $request->validate([
            'tahap_cicilan' => 'required|in:cicilan_1,cicilan_2',
            'foto_bukti'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nominal'       => 'nullable|numeric',
        ]);

        $tahap   = $request->input('tahap_cicilan');
        $nominal = $request->input('nominal');

        if ($request->hasFile('foto_bukti')) {
            $path = $request->file('foto_bukti')->store('pmb_bukti_bayar', 'public');

            if ($tahap === 'cicilan_1') {
                $registration->foto_bukti_cicilan_1           = $path;
                $registration->nominal_cicilan_1              = $nominal;
                $registration->status_pembayaran_daftar_ulang = 'Menunggu Verifikasi Cicilan 1';
            } else {
                $registration->foto_bukti_cicilan_2           = $path;
                $registration->nominal_cicilan_2              = $nominal;
                $registration->status_pembayaran_daftar_ulang = 'Menunggu Verifikasi Cicilan 2';
            }

            $registration->save();
        }

        return redirect()
            ->back()
            ->with('success', 'Foto bukti transfer pembayaran daftar ulang berhasil diunggah! Sedang dalam proses verifikasi oleh Bagian Keuangan.');
    }
}

