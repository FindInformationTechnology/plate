<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmirateController;
use App\Http\Controllers\Admin\CodeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
    

    // Emirates and code management
    Route::resource('emirates', EmirateController::class)->only(['index', 'edit', 'store', 'update', 'destroy']);
    Route::resource('codes', CodeController::class)->only(['index', 'edit', 'store', 'update', 'destroy']);

    Route::view('/users','admin.pages.users.list')->name('users.index');
    

    // Plates Management
    // Route::resource('plates', PlateController::class);
    // Route::post('plates/update-status', [PlateController::class, 'updateStatus'])->name('plates.update-status');
    // Route::post('plates/update-sold', [PlateController::class, 'updateSold'])->name('plates.update-sold');
    // Route::post('plates/destroy', [PlateController::class, 'destroy'])->name('plates.destroy');

    Route::resource('plates', PlateController::class);
    Route::post('plates/update-status', [PlateController::class, 'updateStatus'])->name('plates.update-status');
    Route::post('plates/update-sold', [PlateController::class, 'updateSold'])->name('plates.update-sold');
    Route::post('plates/destroy', [PlateController::class, 'destroy'])->name('plates.destroy');
    Route::post('plates/update-featured', [PlateController::class, 'updateFeatured'])->name('plates.update-featured');
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



