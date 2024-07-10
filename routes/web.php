<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeCafeController;

Route::get('/', function () {
    return view('dashAdmin.users');
});

Auth::routes();

// Cafe
Route::get('/cafeIndex', [HomeCafeController::class, 'cafeIndex'])->name('cafeIndex');

// Admin Dashboard
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('auth.dashLogin');
    })->name('login.view');
    
    Route::get('/dashLogin', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.dashLogin');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');

    Route::get('/users', function () {
        return view('dashAdmin.users');
    })->middleware('auth')->name('users');
});