<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PmbFee;
use Illuminate\Http\Request;

class PmbFeeController extends Controller
{
    /**
     * Tampilkan halaman kelola rincian biaya PMB.
     */
    public function index()
    {
        $prodis = ['S1 Farmasi', 'S1 Gizi'];
        $gelombangs = ['Gelombang 1', 'Gelombang 2', 'Gelombang 3', 'Gelombang 4', 'Gelombang 5'];

        $existingFees = PmbFee::all()->groupBy('prodi')->map(function ($item) {
            return $item->keyBy('gelombang');
        });

        return view('admin.pmb_fees.index', compact('prodis', 'gelombangs', 'existingFees'));
    }

    /**
     * Simpan / perbarui tabel rincian biaya PMB.
     */
    public function update(Request $request)
    {
        $request->validate([
            'fees' => 'required|array',
        ]);

        $feesData = $request->input('fees');

        foreach ($feesData as $prodi => $gelombangList) {
            foreach ($gelombangList as $gelombang => $values) {
                PmbFee::updateOrCreate(
                    [
                        'prodi' => $prodi,
                        'gelombang' => $gelombang,
                    ],
                    [
                        'biaya_registrasi' => (int) ($values['biaya_registrasi'] ?? 0),
                        'ukt_semester_1'   => (int) ($values['ukt_semester_1'] ?? 0),
                        'jas_almamater'    => (int) ($values['jas_almamater'] ?? 0),
                        'osmb'             => (int) ($values['osmb'] ?? 0),
                        'ktm'              => (int) ($values['ktm'] ?? 0),
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Tabel rincian biaya PMB berhasil diperbarui!');
    }
}
