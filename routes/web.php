<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToDoController;




Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware([AuthMiddleware::class])->group(function () {

    Route::resource('tasks', ToDoController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/',function(){
    return redirect()->route('tasks.index');
});





});






