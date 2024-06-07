<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesiapanLahan extends Model
{
    use HasFactory;

    protected $table = 'table_kesiapan_lahan';

    protected $fillable = [
        'keterangan',
        'cuaca_lokasi_amp',
        'foto_cuaca_amp',
        'lokasi_cuaca_amp',
        'waktu_dokumentasi_cuaca_amp',
        'cuaca_lahan_penghamparan',
        'foto_lahan_penghamparan',
        'lokasi_lahan_penghamparan',
        'waktu_dokumentasi_lahan_penghamparan',
        'kondisi_lahan_penghamparan',
        'foto_kondisi_lahan_penghamparan',
    ];
}
