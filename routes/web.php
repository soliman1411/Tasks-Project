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

        // User Tasks
        Route::resource('tasks', TasksController::class)->except('show');

        // User Profile
        Route::prefix('user/profile')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'show')->name('profile.show');
            Route::put('/{id}/update', 'update_profile')->name('profile.update');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Moderator & Admin Routes (role:admin or moderator)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'role:admin|moderator'])->group(function () {

        Route::resource('tasksManegment', TasksManegmentController::class)->except('show');

        Route::prefix('tasksManegment')->controller(TasksManegmentController::class)->group(function () {
            Route::get('/trashed', 'trashed')->name('tasksManegment.trashed');
            Route::put('/{id}/restore', 'restore')->name('tasksManegment.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('tasksManegment.forceDelete');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Only Routes (role:admin only)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/notifications', 'AllNotifications')->name('notifications');
            Route::get('/tasks/showAllTasks', 'showAllTasks')->name('showAllTasks');
            Route::get('/tasks/{id}/show', 'showTasks')->name('showTasks');
        });

        Route::resource('usersManegment', UsersManegmentController::class);

        Route::prefix('users')->controller(UsersManegmentController::class)->group(function () {
            Route::get('/trashed', 'trashed')->name('usersManegment.trashed');
            Route::put('/{id}/restore', 'restore')->name('usersManegment.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('usersManegment.forceDelete');
        });
    });

});
