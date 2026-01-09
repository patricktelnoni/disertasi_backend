<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements ProductServiceInterface
{
    /** @return Collection<int, Product> */
    public function getAll(): Collection
    {
        return Product::all();
    }

    /**
     * Return the same shape currently used by controller: a collection (possibly empty)
     * with selected columns for the given id.
     * @return Collection<int, Product>
     */
    public function getById(int $id)
    {
        return Product::where('id', $id)->get(['id', 'name', 'description', 'foto_produk']);
    }

    public function create(array $data): bool
    {
        return (bool) Product::create([
            'name' => $data['name'] ?? null,
            'description' => $data['description'] ?? null,
            'foto_produk' => $data['foto_produk'] ?? null,
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $product = Product::find($id);
        if (!$product) {
            return false;
        }
        $product->name = $data['name'] ?? $product->name;
        $product->description = $data['description'] ?? $product->description;
        return (bool) $product->save();
    }

    public function delete(int $id): bool
    {
        $product = Product::find($id);
        return $product ? (bool) $product->delete() : false;
    }
}
