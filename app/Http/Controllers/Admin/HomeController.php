<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    function index(){
        $user = User::find(Auth::getUser()->id);
        return view("admin-components.user.profile",["user"=>$user]);

    }
}
