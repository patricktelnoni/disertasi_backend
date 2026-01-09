<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;

interface ProductServiceInterface
{
    /** @return Collection<int, Product> */
    public function getAll(): Collection;

    /** @return Collection<int, Product>|Product|null */
    public function getById(int $id);

    public function create(array $data): bool;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
