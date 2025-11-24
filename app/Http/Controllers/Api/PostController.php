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
        return new PostResources($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
