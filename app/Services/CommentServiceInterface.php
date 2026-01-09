<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Comment;

interface CommentServiceInterface
{
    /** @return Collection<int, Comment> */
    public function getAll(): Collection;

    public function create(array $data): bool;

    public function getById(int $id): Comment;

    /** @return Collection<int, Comment> */
    public function getByUserId(string $userId): Collection;

    /** @return Collection<int, Comment> */
    public function getByPostId(int $postId): Collection;

    public function update(Comment $comment, array $data): bool;

    public function delete(Comment $comment): bool;
}
