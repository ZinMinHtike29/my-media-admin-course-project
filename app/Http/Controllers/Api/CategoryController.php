<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Get All Category
    public function allCategory()
    {
        $category = Category::select("title", "category_id", "description")->get();
        return response()->json([
            "category" => $category
        ], 200,);
    }

    //Category Search
    public function categorySearch(Request $request)
    {
        if ($request->key == null) {
            $category = Category::select("posts.*")
                ->join("posts", "categories.category_id", "posts.category_id")
                ->get();
        } else {
            $category = Category::select("posts.*")
                ->where("categories.title", "like", "%$request->key%")
                ->join("posts", "categories.category_id", "posts.category_id")
                ->get();
        }
        return response()->json(["result" => $category], 200);
    }
}