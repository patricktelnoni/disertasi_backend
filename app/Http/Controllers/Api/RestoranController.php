<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restoran;
use App\Http\Resources\RestoranResource;

class RestoranController extends Controller
{
    //
    public function index()
    {
        $restorans = Restoran::all();
        return RestoranResource::collection($restorans);
    }

    public function store(Request $request){
        $details = [
            'name' => $request->name,
            'address' => $request->address
        ];
        Restoran::create($details);
    }

    public function update(Request $request, $id){
        $restoran = Restoran::find($id);
        $restoran->name = $request->name;
        $restoran->address = $request->address;
        $restoran->save();
    }

    public function destroy($id){
        $restoran = Restoran::find($id);
        $restoran->delete();
    }
}
