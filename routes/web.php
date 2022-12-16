<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("welcome");
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    //admin
    Route::get("dashboard", [ProfileController::class, "index"])->name("dashboard");
    Route::post("admin/update", [ProfileController::class, "updateAdminAcc"])->name("admin#update");
    Route::get('admin/changePassword', [ProfileController::class, "directChangePassword"])->name("admin#directChangePassword");
    Route::post('admin/changePassword', [ProfileController::class, "changePassword"])->name("admin#changePassword");

    //Admin List
    Route::get("admin/list", [ListController::class, "index"])->name("admin#list");
    Route::get("admin/delete/{id}", [ListController::class, "deleteAcc"])->name("admin#accDelete");
    Route::post("admin/listSearch", [ListController::class, "adminListSearch"])->name("admin#ListSearch");

    //Category
    Route::get("category", [CategoryController::class, "index"])->name("admin#category");
    Route::post("category/create", [CategoryController::class, "createCategory"])->name("admin#createCategory");
    Route::get("category/delete/{id}", [CategoryController::class, "deleteCategory"])->name("admin#deleteCategory");
    Route::post("category/search", [CategoryController::class, "categorySearch"])->name("admin#categorySearch");
    Route::get("category/editPage/{id}", [CategoryController::class, "categoryEditPage"])->name("admin#categoryEditPage");
    Route::post("category/update/{id}", [CategoryController::class, "updateCategory"])->name("admin#updateCategory");

    //Post
    Route::get("post", [PostController::class, "index"])->name("admin#post");
    Route::post("admin/createPost", [PostController::class, "createPost"])->name("admin#createPost");
    Route::get("admin/deletePost/{id}", [PostController::class, "deletePost"])->name("admin#deletePost");
    Route::get("admin/posteditPage/{id}", [PostController::class, "postEditPage"])->name("admin#postEditPage");
    Route::post('admin/post/update/{id}', [PostController::class, "updatePost"])->name("admin#postUpdate");

    //Trend Post
    Route::get("trendPost", [TrendPostController::class, "index"])->name("admin#trendPost");
    Route::get("trendPost/details/{id}", [TrendPostController::class, "trendPostDetails"])->name("admin#trendPostDetails");
});
