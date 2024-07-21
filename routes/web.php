<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\HomeCafeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// Default route to redirect to login
Route::get('/', function () {
    return redirect()->route('admin.dashLogin');
})->name('home');

// Cafe Routes
Route::get('/cafeIndex', [HomeCafeController::class, 'cafeIndex'])->name('cafeIndex');
Route::post('insertContact', [ContactController::class, 'store'])->name('contact.store');
Route::post('sendMail', [ContactController::class, 'sendMail'])->name('contact.sendMail');

// Auth Routes
Auth::routes(['verify' => true]);

// Admin Dashboard Routes
Route::prefix('admin')->group(function () {
    // Login & Logout
    Route::get('/dashLogin', [LoginController::class, 'showLoginForm'])->name('admin.dashLogin');
    Route::post('/dashLogin', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Routes for managing users
    Route::middleware('auth')->group(function () {
        Route::get('/users', [HomeController::class, 'index'])->name('admin.users');
        Route::get('/addUser', [HomeController::class, 'create'])->name('admin.addUser');
        Route::post('/addUser', [HomeController::class, 'store'])->name('admin.storeUser');
        Route::get('/editUser/{id}', [HomeController::class, 'edit'])->name('admin.editUser');
        Route::put('/updateUser/{id}', [HomeController::class, 'update'])->name('admin.updateUser');
        
        // Routes for managing beverages and categories
        Route::get('/manageCategories', [DrinkController::class, 'manageCategories'])->name('admin.manageCategories');
        Route::post('/addCategory', [DrinkController::class, 'storeCategory'])->name('admin.addCategory');
        Route::get('/addBeverage', [HomeCafeController::class, 'create'])->name('admin.beverageView');
        Route::post('/addBeverage', [HomeCafeController::class, 'store'])->name('admin.addBeverage');
        
        // Contact & Email
        Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact');
        Route::get('/showEmail/{id}', [ContactController::class, 'show'])->name('admin.showEmail');
    });
});