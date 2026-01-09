<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostService implements PostServiceInterface
{
    /** @return Collection<int, Post> */
    public function getAll(): Collection
    {
        return Post::all();
    }

    public function create(array $data): bool
    {
        return (bool) Post::create([
            'title' => $data['title'] ?? null,
            'content' => $data['content'] ?? null,
            'user_id' => $data['user_id'] ?? null,
        ]);
    }

    public function getById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /** @return Collection<int, Post> */
    public function getByUserId(string $userId): Collection
    {
        return Post::where('user_id', $userId)->get();
    }

    public function update(Post $post, array $data): bool
    {
        $post->title = $data['title'] ?? $post->title;
        $post->content = $data['content'] ?? $post->content;
        return (bool) $post->save();
    }

    public function delete(Post $post): bool
    {
        return (bool) $post->delete();
    }
}
