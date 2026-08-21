<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PmbWave;

class PmbWaveSeeder extends Seeder
{
    public function run(): void
    {
        $waves = [
            ['nama_gelombang' => 'Gelombang 1', 'tanggal_mulai' => '2026-07-01', 'tanggal_selesai' => '2026-07-31', 'is_active' => true],
            ['nama_gelombang' => 'Gelombang 2', 'tanggal_mulai' => '2026-08-01', 'tanggal_selesai' => '2026-08-31', 'is_active' => true],
            ['nama_gelombang' => 'Gelombang 3', 'tanggal_mulai' => '2026-09-01', 'tanggal_selesai' => '2026-09-30', 'is_active' => true],
            ['nama_gelombang' => 'Gelombang 4', 'tanggal_mulai' => '2026-10-01', 'tanggal_selesai' => '2026-10-31', 'is_active' => true],
            ['nama_gelombang' => 'Gelombang 5', 'tanggal_mulai' => '2026-11-01', 'tanggal_selesai' => '2026-11-30', 'is_active' => true],
        ];

        foreach ($waves as $wave) {
            PmbWave::updateOrCreate(
                ['nama_gelombang' => $wave['nama_gelombang']],
                $wave
            );
        }
    }
}
