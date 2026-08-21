<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PmbWave;
use Illuminate\Http\Request;

class PmbWaveController extends Controller
{
    /**
     * Tampilkan halaman kelola tanggal gelombang PMB.
     */
    public function index()
    {
        $waves = PmbWave::orderBy('id', 'asc')->get();
        return view('admin.pmb_waves.index', compact('waves'));
    }

    /**
     * Simpan / perbarui tanggal gelombang PMB.
     */
    public function update(Request $request)
    {
        $request->validate([
            'waves'                     => 'required|array',
            'waves.*.tanggal_mulai'   => 'required|date',
            'waves.*.tanggal_selesai' => 'required|date|after_or_equal:waves.*.tanggal_mulai',
        ]);

        $wavesData = $request->input('waves');

        foreach ($wavesData as $id => $data) {
            $wave = PmbWave::find($id);
            if ($wave) {
                $wave->update([
                    'tanggal_mulai'   => $data['tanggal_mulai'],
                    'tanggal_selesai' => $data['tanggal_selesai'],
                    'is_active'       => isset($data['is_active']) ? true : false,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Jadwal tanggal gelombang PMB berhasil diperbarui!');
    }
}
