<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
    //Set Action Log
    public function setActionLog(Request $request)
    {
        ActionLog::create($request->all());
        $data = ActionLog::where("post_id", $request->post_id)->get();
        return response()->json(["data" => $data, "message" => "Action Log Create Success.."], 200);
    }
}