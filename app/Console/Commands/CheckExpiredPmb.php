<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\PmbRegistration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckExpiredPmb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pmb:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek dan ubah status pendaftar yang melebihi batas 7 hari daftar ulang menjadi Gugur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $batasWaktu = now()->subDays(7);

        $expiredList = PmbRegistration::where('status', 'Lulus Seleksi')
            ->whereNotNull('tgl_lulus_seleksi')
            ->where('tgl_lulus_seleksi', '<', $batasWaktu)
            ->whereNull('foto_bukti_cicilan_1')
            ->get();

        $count = 0;
        foreach ($expiredList as $reg) {
            $reg->update([
                'status' => 'Gugur (Tidak Daftar Ulang)',
            ]);

            // Kirim penonaktifan akun ke SIAKAD
            try {
                $siaUrl = env('SIA_API_URL', 'https://dev.stikesmuwsb.ac.id');
                $siaSecret = env('SIA_API_SECRET', 'sia-stikes-pmb-secret-2026');

                Http::withHeaders([
                    'X-PMB-Secret' => $siaSecret,
                    'Accept'       => 'application/json',
                ])->timeout(5)->post("{$siaUrl}/api/mahasiswa/deactivate", [
                    'pmb_id'            => $reg->id,
                    'nomor_pendaftaran' => $reg->nomor_pendaftaran,
                ]);
            } catch (\Throwable $e) {
                Log::warning("Gagal menonaktifkan akun SIAKAD untuk PMB ID: {$reg->id}: " . $e->getMessage());
            }

            $count++;
        }

        $this->info("✅ Sukses: {$count} pendaftar ditandai gugur karena melewati batas waktu 7 hari.");
    }
}
