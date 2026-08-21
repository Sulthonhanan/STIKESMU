<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PmbFee;

class PmbFeeSeeder extends Seeder
{
    public function run(): void
    {
        $defaultFees = [
            'S1 Farmasi' => [
                'Gelombang 1' => ['biaya_registrasi' => 500000, 'ukt_semester_1' => 4500000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 2' => ['biaya_registrasi' => 500000, 'ukt_semester_1' => 5000000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 3' => ['biaya_registrasi' => 600000, 'ukt_semester_1' => 5500000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 4' => ['biaya_registrasi' => 600000, 'ukt_semester_1' => 6000000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 5' => ['biaya_registrasi' => 750000, 'ukt_semester_1' => 6500000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
            ],
            'S1 Gizi' => [
                'Gelombang 1' => ['biaya_registrasi' => 500000, 'ukt_semester_1' => 4000000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 2' => ['biaya_registrasi' => 500000, 'ukt_semester_1' => 4500000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 3' => ['biaya_registrasi' => 600000, 'ukt_semester_1' => 5000000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 4' => ['biaya_registrasi' => 600000, 'ukt_semester_1' => 5500000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
                'Gelombang 5' => ['biaya_registrasi' => 750000, 'ukt_semester_1' => 6000000, 'jas_almamater' => 400000, 'osmb' => 350000, 'ktm' => 75000],
            ],
        ];

        foreach ($defaultFees as $prodi => $gelombangList) {
            foreach ($gelombangList as $gelombang => $data) {
                PmbFee::updateOrCreate(
                    ['prodi' => $prodi, 'gelombang' => $gelombang],
                    $data
                );
            }
        }
    }
}
