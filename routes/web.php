<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeCafeController;

Route::get('/', function () {
    return view('homePage');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/homePage', [HomeCafeController::class, 'homePage'])->name('homePage');