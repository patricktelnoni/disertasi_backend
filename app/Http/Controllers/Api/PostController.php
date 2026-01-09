<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResources;
use App\Http\Controllers\Controller;
use App\Services\PostServiceInterface;

class PostController extends Controller
{
    private PostServiceInterface $posts;

    public function __construct(PostServiceInterface $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PostResources::collection($this->posts->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $post = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
        ];
        if($this->posts->create($post)){
            return response()->json(['message' => 'Post created successfully'], 201);
        }
        return response()->json(['message' => 'Post creation failed'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json([
            "data" => $this->posts->getById($post->id)
        ]);
    }

    public function getUserPosts(String $userId){
        $posts = $this->posts->getByUserId($userId);
        return response()->json([
            "data" => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $payload = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ];
        if($this->posts->update($post, $payload)){
            return response()->json(['message' => 'Post updated successfully'], 200);
        }
        return response()->json(['message' => 'Post update failed'], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        if($this->posts->delete($post)){
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }
        return response()->json(['message' => 'Post deletion failed'], 400);
    }
}
