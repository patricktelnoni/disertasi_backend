<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'item_pekerjaan';

    protected $fillable = [
        'nama_item_pekerjaan',
        'satuan_pekerjaan',
        'harga_satuan',
        'volume_pekerjaan',
        'proyek_id',
    ];
}
