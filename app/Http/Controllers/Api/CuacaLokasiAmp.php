<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CuacaLahanAmpModel;
use App\Http\Resources\CuacaLahanAmpResources;

class CuacaLokasiAmp extends Controller
{
    //
    public function index(){
        $cuaca_lokasi_amp = CuacaLahanAmpModel::all();
        return CuacaLokasiAmpResources::collection($cuaca_lokasi_amp);
    }

    public function store(Request $request){
        $image = $request->file('foto_cuaca_amp');
        $image->storeAs('public/storage/foto',   $image->getClientOriginalName() );

        $cuaca_lokasi_amp = CuacaLahanAmpModel::create([
            'keterangan'                    => $request->keterangan,
            'cuaca_lokasi_amp'              => $request->cuaca_lokasi_amp,
            'lokasi_cuaca_amp'              => $request->lokasi_cuaca_amp,
            'foto_cuaca_amp'                => $image->getSize(),      
            'waktu_dokumentasi_cuaca_amp'   => date("Y-m-d h:i:s"),
        ]);

        return new CuacaLahanAmpResources(true, 'data berhasil ditambahkan', $cuaca_lokasi_amp);

    }
}
