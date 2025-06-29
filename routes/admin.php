<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmirateController;
use App\Http\Controllers\Admin\CodeController;



Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');

    // Emirates and code management
    Route::resource('emirates', EmirateController::class)->only(['index', 'edit', 'store', 'update', 'destroy']);
    Route::resource('codes', CodeController::class)->only(['index', 'edit', 'store', 'update', 'destroy']);

    // Plates Management
    // Route::resource('plates', PlateController::class);
    // Route::post('plates/update-status', [PlateController::class, 'updateStatus'])->name('plates.update-status');
    // Route::post('plates/update-sold', [PlateController::class, 'updateSold'])->name('plates.update-sold');
    // Route::post('plates/destroy', [PlateController::class, 'destroy'])->name('plates.destroy');

    Route::resource('plates', PlateController::class);
    Route::post('plates/update-status', [PlateController::class, 'updateStatus'])->name('plates.update-status');
    Route::post('plates/update-sold', [PlateController::class, 'updateSold'])->name('plates.update-sold');
    Route::post('plates/destroy', [PlateController::class, 'destroy'])->name('plates.destroy');
});

Route::get('/lang', function () {
    // return view('front.plates');
})->name('admin.lang.switch');

// Route::get('/plate/details', function () {
//     return view('front.plate-details');
// })->name('plate.details');

// Route::middleware(['auth', 'verified', 'role:user'])
//     ->prefix('user')->name('user.')
//     ->group(function () {

//         Route::get('/dashboard', function () {
//             return view('user.dashboard');
//         })->name('dashboard');

//     });



require __DIR__ . '/auth_admin.php';
