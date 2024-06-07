<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Http\Resources\SekolahResource;

class SekolahController extends Controller
{
    //
    public function index()
    {
        $sekolah = Sekolah::all();
        return SekolahResource::collection($sekolah);
    }

    public function store(Request $request){
        $details = [
            'nama_sekolah' => $request->nama_sekolah,
            'alamat_sekolah' => $request->alamat_sekolah,
            'no_telp' => $request->no_telp
        ];
        Sekolah::create($details);
    }
}
