<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //Direct Trend Post Page
    public function index()
    {
        $post = ActionLog::select(DB::raw("COUNT(action_logs.post_id) as post_count"), "action_logs.*",  "posts.*")
            ->leftJoin("posts", "posts.post_id", "action_logs.post_id")
            ->groupBy("action_logs.post_id")
            ->get();
        return view("admin.trend_post.index", compact("post"));
    }

    //Direct trend Post Details
    public function trendPostDetails($id)
    {
        $post = Post::where("post_id", $id)->first();
        return view("admin.trend_post.details", compact("post"));
    }
}