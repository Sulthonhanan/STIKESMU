<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbWave extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_gelombang',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_active'       => 'boolean',
    ];

    /**
     * Dapatkan Gelombang yang sedang aktif saat ini berdasarkan tanggal hari ini.
     */
    public static function getActiveWave()
    {
        $today = now()->timezone('Asia/Jakarta')->toDateString();

        $activeWave = static::where('is_active', true)
            ->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_selesai', '>=', $today)
            ->first();

        if (!$activeWave) {
            // Jika tidak ada gelombang yang pas hari ini, ambil gelombang terdekat yang aktif
            $activeWave = static::where('is_active', true)
                ->where('tanggal_mulai', '>', $today)
                ->orderBy('tanggal_mulai', 'asc')
                ->first();
        }

        if (!$activeWave) {
            // Fallback ke gelombang pertama
            $activeWave = static::where('is_active', true)->first();
        }

        return $activeWave;
    }
}
