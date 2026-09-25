<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PmbRegistration extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'tgl_lulus_seleksi' => 'datetime',
        'tgl_verifikasi_pembayaran' => 'datetime',
        'sia_account_created' => 'boolean',
    ];

    /**
     * Generate nomor pendaftaran unik: TAHUN-XXXX.
     * Urutan tidak pernah di-reuse meski pendaftar sebelumnya dihapus (soft delete).
     */
    public static function generateNomorPendaftaran(?int $year = null): string
    {
        $year = $year ?? (int) date('Y');

        $maxSuffix = static::withTrashed()
            ->where('nomor_pendaftaran', 'LIKE', "{$year}-%")
            ->get()
            ->max(fn (self $r) => (int) substr($r->nomor_pendaftaran, 5));

        $nextNumber = ($maxSuffix ?? 0) + 1;

        return $year . '-' . str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Generate NIM resmi mahasiswa secara atomik & sekuensial.
     * Format: [Tahun Angkatan 3 digit][Tahun Daftar 2 digit][Kode Prodi 4 digit][Nomor Urut 4 digit]
     * Contoh: 0072501010017 (Angkatan 007, Tahun 25, Farmasi 0101, Urut 0017)
     */
    public static function generateNim(string $prodi, ?int $year = null): string
    {
        if (!$year || $year < 2000) {
            $year = (int) date('Y');
        }

        // Tahun Angkatan 3 digit (2025 = 007, 2026 = 008, dst. Base: 2018)
        $angkatanNum = max(1, $year - 2018);
        $angkatanStr = str_pad((string) $angkatanNum, 3, '0', STR_PAD_LEFT);

        // Tahun Terdaftar 2 digit (2025 = 25, 2026 = 26)
        $tahunDaftarStr = substr((string) $year, -2);

        // Kode Prodi 4 digit: Baca dinamis dari tabel program_studis
        $kodeProdi = ProgramStudi::where('nama_prodi', $prodi)->value('kode_nim');
        if (!$kodeProdi) {
            $fallbackMap = [
                'S1 Farmasi' => '0101',
                'S1 Gizi'    => '0201',
            ];
            $kodeProdi = $fallbackMap[$prodi] ?? '0101';
        }

        // Pastikan baris counter ada di database
        \Illuminate\Support\Facades\DB::table('nim_counters')->insertOrIgnore([
            'tahun'      => (string) $year,
            'kode_prodi' => $kodeProdi,
            'last_count' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Atomic increment
        \Illuminate\Support\Facades\DB::table('nim_counters')
            ->where('tahun', (string) $year)
            ->where('kode_prodi', $kodeProdi)
            ->increment('last_count');

        $counter = \Illuminate\Support\Facades\DB::table('nim_counters')
            ->where('tahun', (string) $year)
            ->where('kode_prodi', $kodeProdi)
            ->value('last_count');

        // Nomor Urut 3 digit (misal: 001, 002, 003)
        $nomorUrutStr = str_pad((string) $counter, 3, '0', STR_PAD_LEFT);

        return $angkatanStr . $tahunDaftarStr . $kodeProdi . $nomorUrutStr;
    }

    /**
     * Memeriksa dan memperbaiki NIM jika berformat lama/cacat (kurang dari 12 digit / tahun '00').
     */
    public static function repairNimIfInvalid(?string $nim, string $prodi, ?int $year = null): string
    {
        if (!$year || $year < 2000) {
            $year = (int) date('Y');
        }

        // Jika kosong, generate baru
        if (empty($nim)) {
            return static::generateNim($prodi, $year);
        }

        $tahunDaftarStr = substr((string) $year, -2);
        $angkatanNum    = max(1, $year - 2018);
        $angkatanStr    = str_pad((string) $angkatanNum, 3, '0', STR_PAD_LEFT);
        $expectedPrefix = $angkatanStr . $tahunDaftarStr; // e.g. "00826"

        // Jika NIM panjangnya != 12 digit atau diawali '00100' (format bug lama)
        if (strlen($nim) !== 12 || str_starts_with($nim, '00100') || !str_starts_with($nim, $expectedPrefix)) {
            // Ambil nomor urut dari 3 digit terakhir NIM lama
            $nomorUrutStr = substr($nim, -3);
            if (!is_numeric($nomorUrutStr)) {
                $nomorUrutStr = '001';
            }

            $kodeProdi = ProgramStudi::where('nama_prodi', $prodi)->value('kode_nim');
            if (!$kodeProdi) {
                $fallbackMap = [
                    'S1 Farmasi'          => '0101',
                    'S1 Gizi'             => '0201',
                    'Ilmu Keperawatan'    => '0301',
                    'S1 Ilmu Keperawatan' => '0301',
                ];
                $kodeProdi = $fallbackMap[$prodi] ?? '0101';
            }

            return $angkatanStr . $tahunDaftarStr . $kodeProdi . $nomorUrutStr;
        }

        return $nim;
    }
}
