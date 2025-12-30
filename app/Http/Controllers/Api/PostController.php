<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResources;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PostResources::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $post = [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
        ];
        if(Post::create($post)){
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
            "data" => Post::findOrFail($post->id)
        ]);
    }

    public function getUserPosts(String $userId){
        $posts = Post::where('user_id', $userId)->get();
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
        $edit = Post::find($post->id);
        $edit->title = $request->title;
        $edit->content = $request->content;
        if($edit->save()){
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
        $post = Post::find($post->id);
        if($post->delete()){
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }
        return response()->json(['message' => 'Post deletion failed'], 400);
    }
}
