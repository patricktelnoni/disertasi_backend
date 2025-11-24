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
        $product = Product::where('id', $id)->get(['id', 'name', 'description', 'foto_produk']);
        return response()->json([
            'data' => $product
        ], 200);
    }

    public function store(Request $request){
        $details = [
            'name'          => $request->name,
            'description'   => $request->description,
            'foto_produk'   => isset($request->foto_produk) ? $request->foto_produk : null,
        ];

        if(Product::create($details)){
            return response()->json(['message' => 'Product created successfully'], 201);
        }
        return response()->json(['message' => 'Product creation failed'], 400);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        if($product->save()){
            return response()->json(['message' => 'Product updated successfully'], 200);
        }
        return response()->json(['message' => 'Product update failed'], 400);
    }

    public function destroy($id){
        $product = Product::find($id);
        if($product->delete()){
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }
        return response()->json(['message' => 'Product delete failed'], 400);
    }
}
