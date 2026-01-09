<?php

namespace App\Services;

interface LikeServiceInterface
{
    public function getAll(): Collection;

    public function create(array $data): bool;

}
