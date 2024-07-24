<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InfoProyek;
use App\Models\ItemPekerjaan;
use App\Http\Resources\InfoProyekResource;

class InfoProyekController extends Controller
{
    //

    public function index()
    {
        $proyekList = InfoProyek::all();
        return new InfoProyekResource(true, 'Detail seluruh proyek', $proyekList);
    }

    public function show($id){
        $proyek = InfoProyek::find($id);
        return new InfoProyekResource(true, 'Detail data proyek', $proyek);
    }

    public function store(Request $request){
        $infoProyek     = new InfoProyek();
        $itemPekerjaan  = new ItemPekerjaan();

        $infoProyek->nomor_kontrak      = $request->nomor_kontrak;
        $infoProyek->nama_paket         = $request->nama_paket;
        $infoProyek->nama_satker        = $request->nama_satker;
        $infoProyek->nama_ppk           = $request->nama_ppk;
        $infoProyek->nilai_kontrak      = $request->nilai_kontrak;
        $infoProyek->lokasi_pekerjaan   = $request->lokasi_pekerjaan;
        $infoProyek->masa_pelaksanaan   = $request->masa_pelaksanaan;
        $infoProyek->tanggal_pho        = $request->tanggal_pho;
        $infoProyek->tanggal_kontrak    = $request->tanggal_kontrak;
        
        
        if($infoProyek->save()){
            $itemPekerjaanArray = $request->item_pekerjaan;
            
            foreach($itemPekerjaanArray as $item){
                $itemPekerjaan = new ItemPekerjaan();
                $itemPekerjaan->nama_item_pekerjaan = $item['nama_item_pekerjaan'];
                $itemPekerjaan->satuan_pekerjaan = $item['satuan_pekerjaan'];
                $itemPekerjaan->harga_satuan = $item['harga_satuan'];
                $itemPekerjaan->volume_pekerjaan = $item['volume_pekerjaan'];
                $itemPekerjaan->proyek_id = $infoProyek->id;
                $itemPekerjaan->save();
            }

            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data' => $infoProyek
            ]);
        }
        else{
            return response()->json([
                'message' => 'Data gagal disimpan',
                'data' => null
            ]);
        }
        
        
    }
}
