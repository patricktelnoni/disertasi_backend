<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResources;
use App\Services\CommentServiceInterface;

class CommentController extends Controller
{
    public function __construct(private readonly CommentServiceInterface $comments)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CommentResources::collection($this->comments->getAll());
    }

    public function commentsByPost($postId)
    {
        $comments = $this->comments->getByPostId((int) $postId);
        return CommentResources::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['post_id', 'user_id', 'title', 'content']);
        if ($this->comments->create($data)) {
            return response()->json(['message' => 'Comment created successfully'], 201);
        }
        return response()->json(['message' => 'Comment creation failed'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $found = $this->comments->getById($comment->id);
        return new CommentResources($found);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->only(['title', 'content']);
        if ($this->comments->update($comment, $data)) {
            return response()->json(['message' => 'Comment updated successfully'], 200);
        }
        return response()->json(['message' => 'Comment update failed'], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($this->comments->delete($comment)) {
            return response()->json(['message' => 'Comment deleted successfully'], 200);
        }
        return response()->json(['message' => 'Comment deletion failed'], 400);
    }
}
