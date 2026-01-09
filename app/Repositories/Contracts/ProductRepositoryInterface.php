<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function all();

    public function find(int $id, array $columns = ['*']);

    public function create(array $data): bool;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
