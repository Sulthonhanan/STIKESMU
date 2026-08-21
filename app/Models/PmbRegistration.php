<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PmbRegistration extends Model
{
    use SoftDeletes;

    protected $guarded = [];

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
}
