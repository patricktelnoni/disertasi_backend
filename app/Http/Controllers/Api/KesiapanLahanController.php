<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KesiapanLahan;
use App\Http\Resources\KesiapanLahanResource;

class KesiapanLahanController extends Controller
{
    //
    public function index()
    {
        $kesiapanLahan = KesiapanLahan::all();
        return new KesiapanLahanResource(true, 'List Data Posts', $kesiapanLahan);
    }

    public function store(Request $request){
        //validate data
       /* $request->validate([
            'keterangan' => 'required',
            'cuaca_lokasi_amp' => 'required',
            'lokasi_cuaca_amp' => 'required',
            'cuaca_lahan_penghamparan' => 'required',
            'lokasi_lahan_penghamparan' => 'required',
            'kondisi_lahan_penghamparan' => 'required',
            'foto_kondisi_lahan_penghamparan' => 'required',
        ]);
        */
        $image = $request->file('foto_cuaca_amp');
        $image->storeAs('public/storage/foto',   $image->getClientOriginalName() );
        //echo  $image->getClientOriginalName();
        //save to database
        $kesiapanLahan = KesiapanLahan::create([
            'keterangan' => $request->keterangan,
            'cuaca_lokasi_amp' => $request->cuaca_lokasi_amp,
            'lokasi_cuaca_amp' => $request->lokasi_cuaca_amp,
            'foto_cuaca_amp' => $image->getSize(),      
            'cuaca_lahan_penghamparan' => $request->cuaca_lahan_penghamparan,
            'kondisi_lahan_penghamparan' => $request->kondisi_lahan_penghamparan,
            'waktu_dokumentasi_cuaca_amp' => date("Y-m-d h:i:s"),
            'foto_lahan_penghamparan' => $request->foto_lahan_penghamparan,
            'lokasi_lahan_penghamparan' => $request->lokasi_lahan_penghamparan,
            'foto_kondisi_lahan_penghamparan' => $request->foto_kondisi_lahan_penghamparan,
            'waktu_dokumentasi_lahan_penghamparan' => date("Y-m-d h:i:s"),
            
            
        ]);
        
        return new KesiapanLahanResource(true, 'data berhasil ditambahkan', $kesiapanLahan);
        
        
        
    }
}
