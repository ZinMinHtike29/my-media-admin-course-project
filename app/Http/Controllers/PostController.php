<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Direct Post List Page
    public function index()
    {
        $category = Category::get();
        $post = Post::orderBy("created_at", "desc")->get();
        return view("admin.post.index", compact("category", "post"));
    }

    //Create Post
    public function createPost(Request $request)
    {
        $this->postValidationCheck($request);
        $data = $this->getPostData($request);
        if ($request->hasFile("postImage")) {
            $fileName = uniqid() . $request->file("postImage")->getClientOriginalName();
            $request->file("postImage")->storeAs("public", $fileName);
            $data["image"] = $fileName;
        }
        Post::create($data);
        return redirect()->route("admin#post");
    }

    //Delete Posts
    public function deletePost($id)
    {
        $db_image_name = Post::select("image")->where("post_id", $id)->first();
        if ($db_image_name->image != null) {
            Storage::delete("public/$db_image_name->image");
        }
        Post::where("post_id", $id)->delete();
        return redirect()->route("admin#post");
    }

    //Direct Post Edit Page
    public function postEditPage($id)
    {
        $category = Category::get();
        $post = Post::orderBy("created_at", "desc")->get();
        $postDetail = Post::where("post_id", $id)->first();
        return view("admin.post.update", compact("category", "post", "postDetail"));
    }

    //Update Post
    public function updatePost(Request $request, $id)
    {
        $this->postValidationCheck($request);
        $data = $this->getPostData($request);

        //Update With New Image
        if ($request->hasFile("postImage")) {
            $db_image_name = Post::select("image")->where("post_id", $id)->first();
            //Delete Image From Storage Folder
            if ($db_image_name->image != null) {
                Storage::delete("public/$db_image_name->image");
            }
            //Store Image
            $fileName = uniqid() . $request->file("postImage")->getClientOriginalName();
            $request->file("postImage")->storeAs("public", $fileName);
            $data["image"] = $fileName;
        }
        Post::where("post_id", $id)->update($data);
        return back();
    }

    //Get Post Data
    private function getPostData($request)
    {
        return [
            "title" => $request->postTitle,
            "description" => $request->postDescription,
            "category_id" => $request->postCategory,
        ];
    }

    //Validation Post value
    private function postValidationCheck($request)
    {
        Validator::make($request->all(), [
            "postTitle" => "required",
            "postDescription" => "required",
            "postCategory" => "required"
        ])->validate();
    }
}