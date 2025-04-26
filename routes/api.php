<?php

use App\Http\Controllers\Api\PlateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Plate;
use App\Models\Page;


// Public Routes
// Route::get('/plates', [PlateController::class, 'index']);
// Route::get('/plates/{id}', [PlateController::class, 'show']);
// Route::get('/pages/{slug}', [PageController::class, 'show']);

// Auth Routes
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::post('/api/plates', [PlateController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/logout', [AuthController::class, 'logout']);
    
    // Route::get('/profile', [UserController::class, 'profile']);
    // Route::put('/profile', [UserController::class, 'update']);

    // Route::put('/plates/{id}', [PlateController::class, 'update']);
    // Route::delete('/plates/{id}', [PlateController::class, 'destroy']);

    // Route::post('/favorites', [FavoriteController::class, 'store']);
    // Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);
    
    // Route::post('/reports', [ReportController::class, 'store']);
});
