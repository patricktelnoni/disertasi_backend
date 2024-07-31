<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DimensiLahanModel;
use App\Models\ItemPekerjaan;
use App\Http\Resources\DimensiLahanResources;

class DimensiLahanController extends Controller
{
    public function index()
    {
        $dimensi_lahan = DimensiLahanModel::all();
        return DimensiLahanResources::collection($dimensi_lahan);
    }

    public function store(Request $request){

        $dimensi_lahan  = new DimensiLahanModel();
        $item_pekerjaan = new ItemPekerjaan();

        $imagePanjang = $request->file('foto_panjang');
        $imagePanjang->storeAs('public/storage/foto', $imagePanjang->getClientOriginalName());

        $imageLebar = $request->file('foto_lebar');
        $imageLebar->storeAs('public/storage/foto', $imageLebar->getClientOriginalName());

        $imageTebal = $request->file('foto_tebal');
        $imageTebal->storeAs('public/storage/foto', $imageTebal->getClientOriginalName());

        //add perhitungan biaya dan progress di sini
        
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
        $dimensi_lahan->item_pekerjaan_id   = $request->id_item_pekerjaan;

        $volume = $request->panjang_pekerjaan * $request->lebar_pekerjaan * $request->tebal_pekerjaan;

        $data   = ItemPekerjaan::where('id', $request->id_item_pekerjaan)->first();

        $biaya              = $volume * $data->harga_satuan;
        $nilai_pekerjaan    = $data->volume_pekerjaan * $data->harga_satuan;
        
        $dimensi_lahan->volume_pekerjaan    = $volume;
        $dimensi_lahan->biaya               = $biaya;
        $dimensi_lahan->nilai_pekerjaan     = $nilai_pekerjaan;

        $past_dimensi_lahan = DimensiLahanModel::where('proyek_id', $request->id_proyek)->orderBy('id', 'desc')->first();    

        if($past_dimensi_lahan){
            $biaya_kumulatif     = $biaya + $past_dimensi_lahan->biaya_kumulatif; 
            $volume_kumulatif    = $volume + $past_dimensi_lahan->volume_kumulatif;       
            $progress_kumulatif  = ($volume / $data->volume_pekerjaan * 100) + $past_dimensi_lahan->progress_pekerjaan;  
            
            $dimensi_lahan->volume_kumulatif    = $volume_kumulatif;
            $dimensi_lahan->progress_biaya      = $biaya_kumulatif;
            $dimensi_lahan->progress_pekerjaan  = $progress_kumulatif;
        }
        else{
 
            $dimensi_lahan->progress_biaya = $dimensi_lahan->biaya / $dimensi_lahan->nilai_pekerjaan * 100;
            $dimensi_lahan->progress_pekerjaan = $dimensi_lahan->volume / $data->volume_pekerjaan * 100;
        }
       
        $dimensi_lahan->save();
        

        
        return new DimensiLahanResources(true, 'data berhasil ditambahkan',$dimensi_lahan);
    }
}
