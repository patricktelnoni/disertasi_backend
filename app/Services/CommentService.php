<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService implements CommentServiceInterface
{
    /** @return Collection<int, Comment> */
    public function getAll(): Collection
    {
        return Comment::all();
    }

    public function create(array $data): bool
    {
        return (bool) Comment::create([
            'title' => $data['title'] ?? null,
            'content' => $data['content'] ?? null,
            'user_id' => $data['user_id'] ?? null,
        ]);
    }

    public function getById(int $id): Comment
    {
        return Comment::findOrFail($id);
    }

    /** @return Collection<int, Comment> */
    public function getByUserId(string $userId): Collection
    {
        return Comment::where('user_id', $userId)->get();
    }

    public function update(Comment $comment, array $data): bool
    {
        $comment->title = $data['title'] ?? $comment->title;
        $comment->content = $data['content'] ?? $comment->content;
        return (bool) $comment->save();
    }

    public function delete(Comment $comment): bool
    {
        return (bool) $comment->delete();
    }
}
