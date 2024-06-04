<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/', function () {
    return view('index');
});

 
Route::get('/login', [AuthControllers::class, 'login_GET']);