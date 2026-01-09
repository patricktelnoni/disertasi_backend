<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Services\ProductServiceInterface;

class ProductController extends Controller
{
    private ProductServiceInterface $products;

    public function __construct(ProductServiceInterface $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        $products = $this->products->getAll();
        return ProductResource::collection($products);
    }

    public function show($id){
        $product = $this->products->getById((int) $id);
        return response()->json([
            'data' => $product
        ], 200);
    }

    public function store(Request $request){
        $details = [
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'foto_produk'   => $request->input('foto_produk'),
        ];

        if($this->products->create($details)){
            return response()->json(['message' => 'Product created successfully'], 201);
        }
        return response()->json(['message' => 'Product creation failed'], 400);
    }

    public function update(Request $request, $id){
        $details = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];
        if($this->products->update((int) $id, $details)){
            return response()->json(['message' => 'Product updated successfully'], 200);
        }
        return response()->json(['message' => 'Product update failed'], 400);
    }

    public function destroy($id){
        if($this->products->delete((int) $id)){
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }
        return response()->json(['message' => 'Product delete failed'], 400);
    }
}
