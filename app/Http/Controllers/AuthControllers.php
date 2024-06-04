<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;

class AuthControllers extends Controller
{
    public function login_GET(Request $request){
        return view('auth.login');
    }

    public function login_POST(request $request){
        $username = $request->username;
        $password = $request->password;
    }
}
