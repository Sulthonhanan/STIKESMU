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
        return view('pmb.register', compact('selectedJalur'));
    }

    /**
     * Simpan data pendaftaran mahasiswa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identitas Mahasiswa
            'jalur_seleksi' => 'required|string|max:255',
            'prodi' => 'required|string|in:S1 Farmasi,S1 Gizi',
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
            'no_hp_wali' => 'nullable|string|max:20',

            // File Uploads
            'pas_foto' => 'required|image|max:2048',
            'raport' => 'required|image|max:2048',
            'ijazah' => 'required|image|max:2048',

            // Persetujuan
            'pernyataan' => 'accepted',
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

