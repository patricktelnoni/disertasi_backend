<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimensiLahanModel extends Model
{
    use HasFactory;

    protected $table = 'dimensi_lahan';

    protected $fillable = [
        'peruntukan',
        'panjang',
        'lokasi_foto_panjang',
        'foto_panjang',
        'waktu_dokumentasi_foto_panjang',
        'lebar',
        'lokasi_foto_lebar',
        'foto_lebar',
        'waktu_dokumentasi_foto_lebar',
        'tebal',
        'lokasi_foto_tebal',
        'foto_tebal',
        'waktu_dokumentasi_foto_tebal',
    ];
}
