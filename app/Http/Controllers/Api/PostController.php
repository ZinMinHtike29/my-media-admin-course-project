<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //Get All Post
    public function allPost()
    {
        $post = Post::get();
        return response()->json([
            "status" => "success",
            "post" => $post
        ], 200);
    }

    //Search Post
    public function searchPost(Request $request)
    {
        $post = Post::where("title", "like", "%$request->key%")->get();
        return response()->json(["searchData" => $post], 200);
    }

    //Post Details
    public function postDetails(Request $request)
    {
        $post = Post::where("post_id", $request->postId)->first();
        return response()->json(["post" => $post], 200);
    }
}