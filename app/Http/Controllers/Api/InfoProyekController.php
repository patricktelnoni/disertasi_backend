<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InfoProyek;
use App\Models\ItemPekerjaan;
use App\Http\Resources\InfoProyekResource;
use Illuminate\Support\Facades\DB;

class InfoProyekController extends Controller
{
    //

    public function getTotalDetailProyek($proyek_id){
        $total = DB::select("
            SELECT ip.proyek_id, 
                COUNT(ip.id) as total_item_pekerjaan, 
                MAX(dl.persentase_progress) as total_progress, 
                SUM(dl.biaya)as total_biaya
            FROM item_pekerjaan ip
            JOIN dimensi_lahan dl ON ip.id = dl.item_pekerjaan_id
            WHERE ip.proyek_id = $proyek_id
            GROUP BY ip.proyek_id;
            
            ");
        return ['total_biaya' => $total[0]->total_biaya, 'total_progress' => $total[0]->total_progress, 'total_item_pekerjaan' => $total[0]->total_item_pekerjaan];
    }

    public function getDetailProgress($proyek_id){

        /*
        SELECT ip.id, ip.nama_item_pekerjaan, 
            max(dl.updated_at),
            ip.harga_satuan,
            ip.harga_satuan * dl.panjang * dl.lebar * dl.tebal as biaya_total,
            dl.panjang * dl.lebar * dl.tebal as volume_total
            
        FROM item_pekerjaan ip
        JOIN dimensi_lahan dl ON ip.id = dl.item_pekerjaan_id
        WHERE ip.proyek_id = $proyek_id
        GROUP BY ip.id;
        */
        $progressProyek = DB::select("
           SELECT ip.id, ip.nama_item_pekerjaan,                
                tif.nilai_kontrak as nilai_kontrak,        
                ip.harga_satuan,        
                sum(ip.harga_satuan * dl.panjang * dl.lebar * dl.tebal) as biaya_total,         
                sum(dl.panjang * dl.lebar * dl.tebal) as volume_total,     
            ((dl.panjang * dl.lebar * dl.tebal)/ ip.volume_pekerjaan ) * 100 as progress
            FROM item_pekerjaan ip JOIN dimensi_lahan dl ON ip.id = dl.item_pekerjaan_id 
            JOIN table_info_proyek tif on tif.id = ip.proyek_id 
            WHERE ip.proyek_id = $proyek_id
            GROUP BY ip.id;
            ");
        
        $totalDana      = 0;
        $nilaiKontrak   = 0;
        $progress       = 0;

        if($progressProyek != null){
            foreach($progressProyek as $prog){
                $totalDana      += $prog->biaya_total;
                $nilaiKontrak   = $prog->nilai_kontrak;
            }
    
            $progress = ($totalDana / $nilaiKontrak) * 100;
            $progress = $progress > 0 ? $progress : 0;
        }
        

        return new InfoProyekResource(true, 'Detail progress seluruh proyek', $progressProyek, ["total_dana" => $totalDana, "progress" => $progress]);
    }
    public function index()
    {
        /*
        SELECT tip.*,  MAX(dl.id), dl.persentase_progress
        FROM `table_info_proyek` tip
        LEFT JOIN item_pekerjaan ip ON tip.id = ip.proyek_id
        LEFT JOIN dimensi_lahan dl ON ip.id = dl.item_pekerjaan_id
        ORDER BY dl.id DESC;
        */ 
        //$proyekList = InfoProyek::orderBy('created_at', 'desc')->get();
        $proyekList = DB::select("
            SELECT  tip.*, 
            ((dl.panjang * dl.lebar * dl.tebal)/ ip.volume_pekerjaan ) * 100  as persentase_progress
            FROM `table_info_proyek` tip
            LEFT JOIN item_pekerjaan ip ON tip.id = ip.proyek_id
            LEFT JOIN dimensi_lahan dl ON ip.id = dl.item_pekerjaan_id
            GROUP BY tip.id
            ORDER BY tip.id DESC
            ");
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
            $namaPekerjaanArray = json_decode($request->nama_pekerjaan, true);
            $satuanPekerjaanArray = json_decode($request->satuan_pekerjaan, true);
            $hargaSatuanArray = json_decode($request->harga_satuan, true);
            $volumePekerjaanArray = json_decode($request->volume_pekerjaan, true);
            $i=0;
            foreach($namaPekerjaanArray as $namaPekerjaan){
                $itemPekerjaan                      = new ItemPekerjaan();
                $itemPekerjaan->nama_item_pekerjaan = $namaPekerjaan;
                $itemPekerjaan->satuan_pekerjaan    = $satuanPekerjaanArray[$i];
                $itemPekerjaan->harga_satuan        = $hargaSatuanArray[$i];
                $itemPekerjaan->volume_pekerjaan    = $volumePekerjaanArray[$i];
                $itemPekerjaan->proyek_id           = $infoProyek->id;
                $itemPekerjaan->save();
                $i++;
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
