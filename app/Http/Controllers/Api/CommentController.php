<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResources;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return CommentResources::collection(Comment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $comment = [
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'title' => $request->title,
            'content' => $request->content,
        ];
        if(Comment::create($comment)){
            return response()->json(['message' => 'Comment created successfully'], 201);
        }
        return response()->json(['message' => 'Comment creation failed'], 400);    
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
        return Comment::find($comment->id)->toResource(CommentResources::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
        $edit = Comment::find($comment->id);
        $edit->title = $request->title;
        $edit->content = $request->content;
        if($edit->save()){
            return response()->json(['message' => 'Comment updated successfully'], 200);
        }
        return response()->json(['message' => 'Comment update failed'], 400)    ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $comment = Comment::find($comment->id);
        if($comment->delete()){    
            return response()->json(['message' => 'Comment deleted successfully'], 200);
        }
        return response()->json(['message' => 'Comment deletion failed'], 400);
    }
}
