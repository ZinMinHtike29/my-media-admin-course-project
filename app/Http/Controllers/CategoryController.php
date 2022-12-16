<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Direct Category List Page
    public function index()
    {
        $category = Category::orderBy("category_id", "desc")->get();
        return view("admin.category.index", compact("category"));
    }

    //Create Category
    public function createCategory(Request $request)
    {
        $this->validateCategoryValue($request);
        $data = $this->getCategoryData($request);
        Category::create($data);
        return redirect()->route("admin#category");
    }

    //Delete Category
    public function deleteCategory($id)
    {
        Category::where("category_id", $id)->delete();
        return redirect()->route("admin#category")->with(["deleteSuccess" => "Category Deleted.."]);
    }

    //Search Category
    public function categorySearch(Request $request)
    {
        $category = Category::orderBy("category_id", "desc")->where("title", "like", "%$request->categorySearchKey%")->get();
        return view("admin.category.index", compact("category"));
    }

    //Direct Category Edit Page
    public function categoryEditPage($id)
    {
        $category = Category::get();
        $updateData = Category::where("category_id", $id)->first();
        return view("admin.category.edit", compact("category", "updateData"));
    }

    //Update Category
    public function updateCategory(Request $request, $id)
    {
        $this->validateCategoryValue($request);
        $data = $this->getCategoryData($request);
        Category::where("category_id", $id)->update($data);
        return redirect()->route("admin#category");
    }

    // Get CAtegory Data
    private function getCategoryData($request)
    {
        return
            [
                "title" => $request->categoryName,
                "description" => $request->categoryDescription
            ];
    }

    //Validate Category Value
    private function validateCategoryValue($request)
    {
        Validator::make($request->all(), [
            "categoryName" => "required",
            "categoryDescription" => "required",
        ])->validate();
    }
}