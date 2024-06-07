<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuacaLahanAmpModel extends Model
{
    use HasFactory;
    protected $table = 'table_cuaca_lahan_amp';

    protected $fillable = ['keterangan', 'cuaca_lokasi_amp', 'foto_cuaca_amp', 'lokasi_cuaca_amp', 'waktu_dokumentasi_cuaca_amp'];
}
