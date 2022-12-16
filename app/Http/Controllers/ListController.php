<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //Direct Admin List Page
    public function index()
    {
        $userData = User::select("id", "name", "email", "phone", "address", "gender")->get();
        return view("admin.list.index", compact("userData"));
    }

    //Delete Admin Account
    public function deleteAcc($id)
    {
        User::where("id", $id)->delete();
        return back()->with(["deleteSuccess" => "Admin Acc Deleted.."]);
    }

    //Search Admin With Search Key
    public function adminListSearch(Request $request)
    {
        $userData = User::select("id", "name", "email", "phone", "address", "gender")
            ->orWhere("name", "like", "%$request->adminSearchKey%")
            ->orWhere("email", "like", "%$request->adminSearchKey%")
            ->orWhere("phone", "like", "%$request->adminSearchKey%")
            ->orWhere("address", "like", "%$request->adminSearchKey%")
            ->orWhere("gender", "like", "%$request->adminSearchKey%")
            ->get();
        return view("admin.list.index", compact("userData"));
    }
}