<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlateController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('/api/plates', PlateController::class);
Route::get('/plates', [PlateController::class, 'index']);
Route::post('/plates', [PlateController::class, 'store']);


