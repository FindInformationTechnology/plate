<?php

use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'update'])->name('login.store');

Route::get('/register', [FrontController::class,'register']) -> name('register');
Route::get('/login', [FrontController::class,'login']) -> name('login');

