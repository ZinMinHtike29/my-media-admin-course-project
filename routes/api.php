    <?php

    use App\Http\Controllers\Api\ActionLogController;
    use App\Http\Controllers\Api\PostController;
    use App\Http\Controllers\AuthController;
    use Illuminate\Http\Request;
    use App\Http\Controllers\api\CategoryController;
    use Illuminate\Support\Facades\Route;


    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::post("user/login", [AuthController::class, "login"]);
    Route::post('user/register', [AuthController::class, "register"]);

    //Post
    Route::get("allPostList", [PostController::class, "allPost"]);
    Route::post("post/search", [PostController::class, "searchPost"]);
    Route::post('post/details', [PostController::class, "postDetails"]);

    //Category
    Route::get("allCategory", [CategoryController::class, "allCategory"]);
    Route::post("category/search", [CategoryController::class, "categorySearch"]);

    //Action Log
    Route::post("post/actionLog", [ActionLogController::class, "setActionLog"]);