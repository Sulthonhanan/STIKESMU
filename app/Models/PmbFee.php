<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi',
        'gelombang',
        'biaya_registrasi',
        'ukt_semester_1',
        'jas_almamater',
        'osmb',
        'ktm',
    ];
}
