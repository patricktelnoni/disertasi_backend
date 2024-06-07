<?php

namespace App\Http\Controllers\Api           ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KondisiLahanModel;
use App\Http\Resources\KondisiLahanResources;

class KondisiLahan extends Controller
{
    //
    public function index(){
        $kondisi_lahan = KondisiLahanModel::all();
        return KondisiLahanResources::collection($kondisi_lahan);
    }

    public function store(Request $request){
        $image = $request->file('foto_kondisi_lahan_penghamparan');
        $image->storeAs('public/storage/foto',   $image->getClientOriginalName() );

        $kondisi_lahan = KondisiLahanModel::create([
            'kondisi_lahan_penghamparan'               => $request->kondisi_lahan_penghamparan,
            'foto_kondisi_lahan_penghamparan'          => $image->getSize(),      
        ]);

        return new KondisiLahanResources(true, 'data berhasil ditambahkan',$kondisi_lahan);
    }   
}
