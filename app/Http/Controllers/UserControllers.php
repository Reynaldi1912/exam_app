<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserControllers extends Controller
{
    public function index_GET(){
        return view('user.create');
    }
}
