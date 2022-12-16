<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct Admin Profile Page
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select("id", "name", "address", "phone", "email", "gender")->where("id", $id)->first();
        return view("admin.profile.index", compact("user"));
    }

    //Update Admin Acc
    public function updateAdminAcc(Request $request)
    {
        $this->validationAdminData($request);
        $userData = $this->getUserInfo($request);
        User::where("id", Auth::user()->id)->update($userData);
        return back()->with(["updateSuccess" => "Admin Account Updated!"]);
    }

    //Validation Admin ProfileData
    private function validationAdminData($request)
    {
        Validator::make($request->all(), [
            "adminName" => "required",
            "adminEmail" => "required"
        ], [
            "adminName.required" => "Name Is Required!",
            "adminEmail.required" => "Email Is Required!",
        ])->validate();
    }

    //direct password PAge
    public function directChangePassword()
    {
        return view("admin.profile.changepassword");
    }

    //Admin Acc Change Passsword
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);
        $dbPassword = User::where("id", Auth::user()->id)->first();
        if (Hash::check($request->oldPassword, $dbPassword->password)) {
            User::where("id", Auth::user()->id)->update(["password" => Hash::make($request->newPassword)]);
            return redirect()->route("dashboard");
        } else {
            return back()->with(["notMatchError" => "Old Password Not Match.Try Again!"]);
        };
    }

    //Password Change validation Check
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            "oldPassword" => "required|",
            "newPassword" => "required|min:7|max:15",
            "confirmPassword" => "required|min:7|max:15|same:newPassword"
        ])->validate();
    }

    //Get User Data
    private function getUserInfo($request)
    {
        return [
            "name" => $request->adminName,
            "email" => $request->adminEmail,
            "phone" => $request->adminPhone,
            "gender" => $request->adminGender,
            "address" => $request->adminAddress,
            "updated_at" => Carbon::now()
        ];
    }
}