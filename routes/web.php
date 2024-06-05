<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\UserControllers;
// Route::get('/login', function () {
//     return view('login');
// });



 
Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', [HomeControllers::class, 'index_GET']);
    Route::get('/user', [UserControllers::class, 'index_GET'])->name('user.index');
    Route::get('/logout', [AuthControllers::class, 'logout_GET'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthControllers::class, 'login_GET'])->name('login');
    Route::post('/login', [AuthControllers::class, 'login_POST']);
});
