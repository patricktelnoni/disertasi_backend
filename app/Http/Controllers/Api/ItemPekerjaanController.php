<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemPekerjaan;
use App\Http\Resources\ItemPekerjaanResource;

class ItemPekerjaanController extends Controller
{
    //
    function index(){
        $itemPekerjaan = ItemPekerjaan::all();
        return new ItemPekerjaanResource(true, 'Detail seluruh item pekerjaan', $itemPekerjaan);
    }

    function show($id){
        $itemPekerjaan = ItemPekerjaan::where('proyek_id', $id)->get();
        return new ItemPekerjaanResource(true, 'Detail item pekerjaan per proyek', $itemPekerjaan);
    }

}
