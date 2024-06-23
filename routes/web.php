<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\UserControllers;
use App\Http\Controllers\ExamControllers;


Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', [HomeControllers::class, 'index_GET']);

    Route::get('/user', [UserControllers::class, 'index_GET'])->name('user.index');
    Route::get('/user-create', [UserControllers::class, 'create_GET'])->name('user.create');
    Route::get('/user-edit/{id}', [UserControllers::class, 'edit_GET'])->name('user.edit');

    Route::post('/user-create-post', [UserControllers::class, 'create_POST'])->name('user.post');
    Route::post('/user-create-update', [UserControllers::class, 'edit_POST'])->name('user.update');
    Route::get('/user-delete/{id}', [UserControllers::class, 'delete_GET'])->name('user.delete');

    Route::get('/exam', [ExamControllers::class, 'index_GET'])->name('exam.index');
    Route::get('/exam-create', [ExamControllers::class, 'create_GET'])->name('exam.create');
    Route::get('/exam-edit/{id}', [ExamControllers::class, 'edit_GET'])->name('exam.edit');

    Route::post('/exam-user-update', [ExamControllers::class, 'change_exam_user_POST'])->name('exam_user.update');
    Route::post('/exam-create-post', [ExamControllers::class, 'create_POST'])->name('exam.post');
    Route::post('/exam-create-update', [ExamControllers::class, 'edit_POST'])->name('exam.update');
    Route::get('/exam-delete/{id}', [ExamControllers::class, 'delete_GET'])->name('exam.delete');

    Route::get('/logout', [AuthControllers::class, 'logout_GET'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthControllers::class, 'login_GET'])->name('login');
    Route::post('/login', [AuthControllers::class, 'login_POST']);
});


