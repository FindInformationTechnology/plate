<?php

use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [FrontController::class,'register']) -> name('register');
Route::get('/login', [FrontController::class,'login']) -> name('login');
// Auth Routes
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'update'])->name('login.store');

Route::get('/', [FrontController::class,'index'])->name('home');

Route::group(['prefix'=> 'user'], function () {
    
    Route::get('dashboard', [FrontController::class,'dashboard']) -> name('user.dashboard');
    
    Route::get('settings', [FrontController::class,'settings']) -> name('user.settings');
    
    Route::get('logout', [AuthController::class, 'logout']) -> name('user.logout');

});

