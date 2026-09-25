<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope query untuk prodi yang aktif dibuka di PMB.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
