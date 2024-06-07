<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CuacaLahanPenghamparanModel;
use App\Http\Resources\CuacaLahanHamparanResources;

class CuacaLahanPenghamparan extends Controller
{
    //

    public function index()
    {
        $cuaca_lahan_penghamparan = CuacaLahanPenghamparanModel::all();
        return CuacaLahanHamparanResources::collection($cuaca_lahan_penghamparan);
    }

    public function store(Request $request){
        $image = $request->file('foto_cuaca_lahan_penghamparan');
        $image->storeAs('public/storage/foto',   $image->getClientOriginalName() );

        $cuaca_lahan_penghamparan = CuacaLahanPenghamparanModel::create([
            'cuaca_lahan_penghamparan'               => $request->cuaca_lahan_penghamparan,
            'lokasi_lahan_penghamparan'              => $request->lokasi_lahan_penghamparan,
            'foto_lahan_penghamparan'                => $image->getSize(),      
            'waktu_dokumentasi_lahan_penghamparan'   => date("Y-m-d h:i:s"),
        ]);

        return new CuacaLahanHamparanResources(true, 'data berhasil ditambahkan',$cuaca_lahan_penghamparan);
    }
}
