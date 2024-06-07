<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuacaLahanPenghamparanModel extends Model
{
    use HasFactory;

    protected $table = 'table_cuaca_lahan_penghamparan';

    protected $fillable = [ 'cuaca_lahan_penghamparan', 
                            'foto_lahan_penghamparan', 
                            'lokasi_lahan_penghamparan', 
                            'waktu_dokumentasi_lahan_penghamparan'];
}
