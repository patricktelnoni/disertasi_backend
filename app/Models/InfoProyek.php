<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoProyek extends Model
{
    use HasFactory;

    protected $table = 'table_info_proyek';

    protected $fillable = [
        'nomor_kontrak',
        'nama_paket',
        'nama_satker',
        'nama_ppk',
        'nilai_kontrak',
        'lokasi_pekerjaan',
        'masa_pelaksanaan',
        'tanggal_pho',
        'tanggal_kontrak',
    ];
}
