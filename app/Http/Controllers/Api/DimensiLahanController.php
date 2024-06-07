<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DimensiLahanModel;
use App\Http\Resources\DimensiLahanResources;

class DimensiLahanController extends Controller
{
    //

    public function index()
    {
        $dimensi_lahan = DimensiLahanModel::all();
        return DimensiLahanResources::collection($dimensi_lahan);
    }

    public function store(Request $request){

        $dimensi_lahan = new DimensiLahanModel();

        $imagePanjang = $request->file('foto_panjang');
        $imagePanjang->storeAs('public/storage/foto', $imagePanjang->getClientOriginalName());

        $imageLebar = $request->file('foto_lebar');
        $imageLebar->storeAs('public/storage/foto', $imageLebar->getClientOriginalName());

        $imageTebal = $request->file('foto_tebal');
        $imageTebal->storeAs('public/storage/foto', $imageTebal->getClientOriginalName());

        $dimensi_lahan->peruntukan          = $request->peruntukan;
        $dimensi_lahan->panjang             = $request->panjang_pekerjaan;
        $dimensi_lahan->lokasi_foto_panjang = $request->lokasi_foto_panjang;
        $dimensi_lahan->foto_panjang        = $request->foto_panjang;
        $dimensi_lahan->waktu_dokumentasi_foto_panjang = date("Y-m-d h:i:s");

        $dimensi_lahan->lebar               = $request->lebar_pekerjaan;
        $dimensi_lahan->lokasi_foto_lebar   = $request->lokasi_foto_lebar;
        $dimensi_lahan->foto_lebar          = $request->foto_lebar;
        $dimensi_lahan->waktu_dokumentasi_foto_lebar = date("Y-m-d h:i:s");

        $dimensi_lahan->tebal               = $request->tebal_pekerjaan;
        $dimensi_lahan->lokasi_foto_tebal   = $request->lokasi_foto_tebal;
        $dimensi_lahan->foto_tebal          = $request->foto_tebal;
        $dimensi_lahan->waktu_dokumentasi_foto_tebal = date("Y-m-d h:i:s");
        $dimensi_lahan->save();

        return new DimensiLahanResources(true, 'data berhasil ditambahkan',$dimensi_lahan);
    }
}
