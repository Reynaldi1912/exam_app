<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Session;
use Auth;

class AuthControllers extends Controller
{
    public function login_GET(Request $request){
        return view('auth.login');
    }

    public function login_POST(Request $request){
        $password = md5($request->password); 
        $credentials = $request->only('username');         
        $user = DB::table('users')->where('username', $credentials['username'])->first();
        
        if ($user && $user->password === $password) { 
            $userObject = (object) $user; 
            Auth::loginUsingId($userObject->id); 
            return redirect()->intended('/');
        } else {
            return redirect('/login')->with('danger', 'Invalid credentials');
        }
    }
    public function logout_GET(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
}
