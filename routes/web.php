<?php

use App\Http\Middleware\Is_admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasksManegmentController;
use App\Http\Controllers\UsersManegmentController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::resource('tasks', TasksController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware([AuthMiddleware::class,Is_admin::class])->group(function () {

    Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/showTasks',[AdminController::class,'showTasks'])->name('admin.showTasks');

    // Route::get('/',function(){
    //     if (Auth::check() && Auth::user()->is_admin ==true) {
    //         return redirect()->route('admin.dashboard');

    //     } else {
    //         return redirect()->route('tasks.index');
    //     }

    //});
   Route::resource('usersManegment', UsersManegmentController::class);
   Route::resource('tasksManegment', TasksManegmentController::class);
});





