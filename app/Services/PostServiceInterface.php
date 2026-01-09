<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;

interface PostServiceInterface
{
    /** @return Collection<int, Post> */
    public function getAll(): Collection;

    public function create(array $data): bool;

    public function getById(int $id): Post;

    /** @return Collection<int, Post> */
    public function getByUserId(string $userId): Collection;

    public function update(Post $post, array $data): bool;

    public function delete(Post $post): bool;
}
