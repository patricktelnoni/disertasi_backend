<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Likes;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $liked = Likes::create([
            'user_id' => 1,
            'post_id' => $request->post_id,
        ]);
        if($liked){
            return response()->json([
                'message' => 'Post liked successfully',
                'data' => $liked
            ], 201);
        }else{
            return response()->json([
                'message' => 'Failed to like post'
            ], 500);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $like = Likes::findOrFail($id);
        if($like){
            $like->delete();
            return response()->json([
                'message' => 'Like removed successfully'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Like not found'
            ], 404);    
        }
    }
}
