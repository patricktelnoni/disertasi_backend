<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiLahanModel extends Model
{
    use HasFactory;

    protected $table = 'table_kondisi_lahan_penghamparan';

    protected $fillable = ['kondisi_lahan_penghamparan', 'foto_kondisi_lahan_penghamparan'];
}
