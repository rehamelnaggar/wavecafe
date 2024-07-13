<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeCafeController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('dashAdmin.users'); 
});

Auth::routes();

// Cafe
Route::get('/cafeIndex', [HomeCafeController::class, 'cafeIndex'])->name('cafeIndex');

// Admin Dashboard
Route::prefix('admin')->group(function () {
    // Default view for admin login
    Route::get('/', function () {
        return view('auth.dashLogin');
    })->name('login.view');
    
    // Routes for admin login
    Route::get('/dashLogin', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/dashLogin', [LoginController::class, 'login'])->name('admin.dashLogin');

    // Routes for admin registration
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');

    // Routes for managing users
    Route::get('/users', [HomeController::class, 'index'])->middleware('auth')->name('admin.users');
    Route::post('/admin/addUser', [HomeController::class, 'create'])->name('admin.addUser');
    Route::get('/editUser/{id}', [HomeController::class, 'edit'])->name('admin.editUser');
    Route::put('/updateUser/{id}', [HomeController::class, 'update'])->name('admin.updateUser');
});