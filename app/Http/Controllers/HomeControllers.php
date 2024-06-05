<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Auth;

class HomeControllers extends Controller
{
    public function index_GET(Request $request){
        return view('index');
    }
}
