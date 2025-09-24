<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\PostController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->group(function () {
        // route category
        Route::resource('category', CategoryController::class);

        // route post
        Route::resource('post', PostController::class);
    });
});

Route::view('/register', 'back.auth.register')->name('register')->middleware('guest');
Route::post('/register', Register::class)
    ->middleware('guest');

// Login routes
Route::view('/login', 'back.auth.login')
    ->middleware('guest')
    ->name('login');
 
Route::post('/login', Login::class)
    ->middleware('guest');
 
// Logout route
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');