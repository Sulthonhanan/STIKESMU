<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PmbWave;
use App\Models\PmbFee;
use Illuminate\Http\Request;

class PmbWaveController extends Controller
{
    /**
     * Tampilkan halaman kelola gelombang PMB.
     */
    public function index()
    {
        $waves = PmbWave::orderBy('id', 'asc')->get();
        return view('admin.pmb_waves.index', compact('waves'));
    }

    /**
     * Tambah gelombang PMB baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gelombang'  => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active'       => 'nullable|boolean',
        ]);

        $wave = PmbWave::create([
            'nama_gelombang'  => $request->input('nama_gelombang'),
            'tanggal_mulai'   => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'is_active'       => $request->has('is_active') ? true : false,
        ]);

        // Buat default tabel biaya untuk gelombang baru jika belum ada
        $prodis = ['S1 Farmasi', 'S1 Gizi'];
        foreach ($prodis as $prodi) {
            PmbFee::firstOrCreate(
                ['prodi' => $prodi, 'gelombang' => $wave->nama_gelombang],
                [
                    'biaya_registrasi' => 500000,
                    'ukt_semester_1'   => $prodi === 'S1 Farmasi' ? 4500000 : 4000000,
                    'jas_almamater'    => 400000,
                    'osmb'             => 350000,
                    'ktm'              => 75000,
                ]
            );
        }

        return redirect()->back()->with('success', "Gelombang '{$wave->nama_gelombang}' berhasil ditambahkan!");
    }

    /**
     * Simpan / perbarui seluruh gelombang PMB.
     */
    public function update(Request $request)
    {
        $request->validate([
            'waves'                     => 'required|array',
            'waves.*.nama_gelombang'    => 'required|string|max:255',
            'waves.*.tanggal_mulai'     => 'required|date',
            'waves.*.tanggal_selesai'   => 'required|date|after_or_equal:waves.*.tanggal_mulai',
        ]);

        $wavesData = $request->input('waves');

        foreach ($wavesData as $id => $data) {
            $wave = PmbWave::find($id);
            if ($wave) {
                $namaLama = $wave->nama_gelombang;
                $namaBaru = $data['nama_gelombang'];

                $wave->update([
                    'nama_gelombang'  => $namaBaru,
                    'tanggal_mulai'   => $data['tanggal_mulai'],
                    'tanggal_selesai' => $data['tanggal_selesai'],
                    'is_active'       => isset($data['is_active']) ? true : false,
                ]);

                // Update nama gelombang di tabel fees jika namanya berubah
                if ($namaLama !== $namaBaru) {
                    PmbFee::where('gelombang', $namaLama)->update(['gelombang' => $namaBaru]);
                }
            }
        }

        return redirect()->back()->with('success', 'Seluruh pengaturan gelombang PMB berhasil diperbarui!');
    }

    /**
     * Hapus gelombang PMB.
     */
    public function destroy($id)
    {
        $wave = PmbWave::findOrFail($id);
        $nama = $wave->nama_gelombang;

        $wave->delete();

        return redirect()->back()->with('success', "Gelombang '{$nama}' berhasil dihapus!");
    }
}
