<?php

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PlateController;
use App\Http\Controllers\Front\UserSettingController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/plates', [FrontController::class, 'plates'])->name('plates');

Route::get('/plate/details', function () {
    return view('front.plate-details');
})->name('plate.details');

Route::middleware(['auth', 'verified', 'role:user'])
    ->prefix('user')->name('user.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        Route::get(' /security', [UserSettingController::class, 'security'])->name('security');
        Route::get('/settings/notification', [UserSettingController::class, 'notification'])->name('settings.notification');
        Route::get('/settings/payment', [UserSettingController::class, 'payment'])->name('settings.payment');

        Route::get('/plates', [PlateController::class, 'index'])->name('plates');
        Route::get('/plates/create', [PlateController::class, 'create'])->name('plates.create');
        Route::post('/plates', [PlateController::class, 'store'])->name('plates.store');
        Route::get('/plates/{id}', [PlateController::class, 'show'])->name('plates.show');
        Route::get('/plates/{id}/edit', [PlateController::class, 'edit'])->name('plates.edit');
        Route::put('/plates/{id}', [PlateController::class, 'update'])->name('plates.update');
        Route::delete('/plates/{id}', [PlateController::class, 'destroy'])->name('plates.destroy');

        // Add these routes to your user routes group
        Route::post('/plates/update-sold', [PlateController::class, 'updateSold'])->name('plates.update-sold');
        Route::post('/plates/update-visibility', [PlateController::class, 'updateVisibility'])->name('plates.update-visibility');

        Route::post('/plates/ajax-destroy', [PlateController::class, 'ajaxDestroy'])->name('plates.ajax-destroy');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// Include admin routes

require __DIR__ . '/admin.php';

require __DIR__ . '/auth.php';
