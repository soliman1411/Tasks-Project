<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasksManegmentController;
use App\Http\Controllers\UsersManegmentController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\Is_admin;

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// User Routes (requires login)
Route::middleware([AuthMiddleware::class])->group(function () {
    Route::resource('tasks', TasksController::class)->except(['show']);
    Route::get('/tasks/trashed', [TasksController::class, 'trashed'])->name('tasks.trashed');
    Route::put('/tasks/{id}/restore', [TasksController::class, 'restore'])->name('tasks.restore');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Routes (requires login + admin role)
Route::middleware([AuthMiddleware::class, Is_admin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Users Management
    Route::resource('usersManegment', UsersManegmentController::class);
    Route::get('/users/trashed', [UsersManegmentController::class, 'trashed'])->name('usersManegment.trashed');
    Route::put('/users/{id}/restore', [UsersManegmentController::class, 'restore'])->name('usersManegment.restore');
    Route::delete('/users/{id}/forceDelete', [UsersManegmentController::class, 'forceDelete'])->name('usersManegment.forceDelete');

    // Tasks Management
    Route::resource('tasksManegment', TasksManegmentController::class)->except('show');
    Route::get('/tasksManegment/trashed', [TasksManegmentController::class, 'trashed'])->name('tasksManegment.trashed');
    Route::put('/tasksManegment/{id}/restore', [TasksManegmentController::class, 'restore'])->name('tasksManegment.restore');
    Route::delete('/tasksManegment/{id}/forceDelete', [TasksManegmentController::class, 'forceDelete'])->name('tasksManegment.forceDelete');

    // Show tasks of a specific user
    Route::get('/tasks/{user}/showTasks', [AdminController::class, 'showTasks'])->name('admin.showTasks');
});
