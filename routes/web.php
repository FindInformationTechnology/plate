<?php

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PlateController;
use App\Http\Controllers\Front\UserSettingController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/plates', [FrontController::class, 'plates'])->name('plates');

Route::get('/plate/details/{id}', [FrontController::class, 'show'])->name('plate.show');


Route::middleware(['auth', 'verified', 'role:user'])
->prefix('user')->name('user.')
->group(function () {
    
    
       

        // Route::get(' /security', [UserSettingController::class, 'security'])->name('security');
        // Route::get('/settings/notification', [UserSettingController::class, 'notification'])->name('settings.notification');
        // Route::get('/settings/payment', [UserSettingController::class, 'payment'])->name('settings.payment');

        Route::get('/plates', [PlateController::class, 'index'])->name('plates');
        Route::get('/plates/create', [PlateController::class, 'create'])->name('plates.create');
        Route::post('/plates', [PlateController::class, 'store'])->name('plates.store');
        Route::get('/plates/{id}/edit', [PlateController::class, 'edit'])->name('plates.edit');
        Route::put('/plates/{id}', [PlateController::class, 'update'])->name('plates.update');
        Route::delete('/plates/{id}', [PlateController::class, 'destroy'])->name('plates.destroy');

        // Add these routes to your user routes group
        Route::post('/plates/update-sold', [PlateController::class, 'updateSold'])->name('plates.update-sold');
        Route::post('/plates/update-visibility', [PlateController::class, 'updateVisibility'])->name('plates.update-visibility');

        Route::post('/plates/ajax-destroy', [PlateController::class, 'ajaxDestroy'])->name('plates.ajax-destroy');

        // Add this route to your web.php file
        Route::get('/api/codes-by-emirate', [PlateController::class, 'getCodesByEmirate'])->name('api.codes.by.emirate');


        // User profile routes

       

        

        
        Route::get('/dashboard', 
        [ProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    });

// Include admin routes

require __DIR__ . '/admin.php';

require __DIR__ . '/auth.php';
