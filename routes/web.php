<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasksManegmentController;
use App\Http\Controllers\UsersManegmentController;
use App\Http\Middleware\AuthMiddleware;

// Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes (requires login)
Route::middleware([AuthMiddleware::class])->group(function () {
    Route::resource('tasks', TasksController::class)->except(['show']);
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/user/profile/{id}/update', [ProfileController::class, 'update_profile'])->name('profile.update');
});


// Moderator Routes (requires login + moderator role)
Route::middleware([AuthMiddleware::class,'role:moderator'])->group(function () {
    // إدارة المهام للمشرف
    Route::resource('tasksManegment', TasksManegmentController::class)->except('show');
    Route::get('/tasksManegment/trashed', [TasksManegmentController::class, 'trashed'])->name('tasksManegment.trashed');
    Route::put('/tasksManegment/{id}/restore', [TasksManegmentController::class, 'restore'])->name('tasksManegment.restore');
    Route::delete('/tasksManegment/{id}/forceDelete', [TasksManegmentController::class, 'forceDelete'])->name('tasksManegment.forceDelete');
});

// Admin Routes (requires login + admin role)
Route::middleware([AuthMiddleware::class,'role:admin'])->prefix('admin/')
->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('AllNotifications', [AdminController::class, 'AllNotifications'])->name('admin.AllNotifications');
    Route::get('/tasks/{user}/showTasks', [AdminController::class, 'showTasks'])->name('admin.showTasks');

    // إدارة المستخدمين
    Route::resource('usersManegment', UsersManegmentController::class);
    Route::get('/users/trashed', [UsersManegmentController::class, 'trashed'])->name('usersManegment.trashed');
    Route::put('/users/{id}/restore', [UsersManegmentController::class, 'restore'])->name('usersManegment.restore');
    Route::delete('/users/{id}/forceDelete', [UsersManegmentController::class, 'forceDelete'])->name('usersManegment.forceDelete');

    // إدارة المهام للأدمن
    Route::resource('tasksManegment', TasksManegmentController::class)->except('show');
    Route::get('/tasksManegment/trashed', [TasksManegmentController::class, 'trashed'])->name('tasksManegment.trashed');
    Route::put('/tasksManegment/{id}/restore', [TasksManegmentController::class, 'restore'])->name('tasksManegment.restore');
    Route::delete('/tasksManegment/{id}/forceDelete', [TasksManegmentController::class, 'forceDelete'])->name('tasksManegment.forceDelete');
});
