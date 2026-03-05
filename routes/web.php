<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksManegmentController;
use App\Http\Controllers\UsersManegmentController;

/*
|--------------------------------------------------------------------------
| Localization Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localization'],
], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes (Public)
    |--------------------------------------------------------------------------
    */
    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'showLoginForm')->name('login.form');
        Route::post('/login', 'login')->name('login');
        Route::get('/register', 'showRegisterForm')->name('register.form');
        Route::post('/register', 'register')->name('register');
        Route::post('/logout', 'logout')->name('logout');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated User Routes (يحتاج تسجيل دخول)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        /*
        |--------------------------------------------------------------------------
        | User Routes (للمستخدم العادي فقط)
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:user'])->group(function () {
            // المستخدم العادي: يدير مهامه الشخصية فقط
            Route::resource('tasks', TasksController::class)->except('show');
        });

        /*
        |--------------------------------------------------------------------------
        | Admin Routes (كل الصلاحيات)
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

            // لوحة التحكم
            Route::controller(AdminController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('dashboard');
                Route::get('/notifications', 'allNotifications')->name('notifications');
            });

            /*
            |--------------------------------------------------------------------------
            | Admin: Users Management (كامل الصلاحيات)
            |--------------------------------------------------------------------------
            */
            Route::resource('users', UsersManegmentController::class)->except('show');

            // Soft Delete & Force Delete للمستخدمين
            Route::prefix('users')->controller(UsersManegmentController::class)->group(function () {
                Route::get('/trashed', 'trashed')->name('users.trashed');
                Route::put('/{id}/restore', 'restore')->name('users.restore');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('users.forceDelete');
            });

            /*
            |--------------------------------------------------------------------------
            | Admin: Tasks Management (كامل الصلاحيات)
            |--------------------------------------------------------------------------
            */
            Route::resource('tasks', TasksManegmentController::class)->except('show');
            // Soft Delete & Force Delete للمهام
            Route::prefix('tasks')->controller(TasksManegmentController::class)->group(function () {
                Route::get('/trashed', 'trashed')->name('tasks.trashed');
                Route::put('/{id}/restore', 'restore')->name('tasks.restore');
                Route::delete('/{id}/force-delete', 'forceDelete')->name('tasks.forceDelete');
            });

            /*
            |--------------------------------------------------------------------------
            | Admin: View User Tasks
            |--------------------------------------------------------------------------
            */
            Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/notifications', 'AllNotifications')->name('notifications');
            Route::get('/users/{user}/tasks', 'showUserTasks')->name('showTasks');
        });

        });
    });
});
