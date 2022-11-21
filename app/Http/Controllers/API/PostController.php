<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // return posts data
    public function getAllPosts()
    {
        $posts = Post::select('id', 'title', 'image')->get();
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    // search posts data
    public function searchPosts(Request $request)
    {
        $results = Post::where('title', 'LIKE', '%' . $request->searchKey . '%')->get();
        return response()->json([
            'results' => $results
        ]);
    }

    // get a specific post
    public function getSinglePost(Request $request)
    {
        $post = Post::where('id', $request->postId)->first();
        return response()->json([
            'post' => $post
        ]);
    }
}
