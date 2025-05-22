<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function show($id){
        $product = Product::where('id', $id)->get(['id', 'name', 'description']);
        return response()->json([
            'data' => $product
        ], 200);
    }

    public function store(Request $request){
        $details = [
            'name' => $request->name,
            'description' => $request->description
        ];
        Product::create($details);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
    }
}
