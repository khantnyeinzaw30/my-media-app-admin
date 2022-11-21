<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // return all category data
    public function getAllCategories()
    {
        $categories = Category::select('id', 'name', 'description')->get();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    // return posts of the same category
    public function filterWithCategory(Request $request)
    {
        if ($request->categoryId) {
            $filterResults = Post::select('id', 'title', 'image')
                ->where('category_id', $request->categoryId)->get();
        } else {
            $filterResults =
                Post::select('id', 'title', 'image')->get();
        }
        return response()->json(['results' => $filterResults], 200);
    }
}
