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
Route::resource('tasks', TasksController::class)->except(['show']);
    Route::get('/tasks/trashed',[TasksController::class,'trashed'])->name('tasks.trashed');
    Route::put('/tasks/{id}/restore',[TasksController::class,'restore'])->name('tasks.restore');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware([AuthMiddleware::class,Is_admin::class])->group(function () {

    Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');
   Route::resource('usersManegment', UsersManegmentController::class);
    Route::get('/users/trashed',[UsersManegmentController::class,'trashed'])->name('usersManegment.trashed');
   Route::put('/users/{id}/restore',[UsersManegmentController::class,'restore'])->name('usersManegment.restore');
    Route::delete('/users/{id}/forceDelete',[UsersManegmentController::class,'forceDelete'])->name('usersManegment.forceDelete');
   Route::resource('tasksManegment', TasksManegmentController::class);
     Route::get('/tasks/{user}/showTasks',[AdminController::class,'showTasks'])->name('admin.showTasks');

});





