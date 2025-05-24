<?php

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PlateController;
use App\Http\Controllers\Front\UserSettingController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;





Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/plates', [FrontController::class, 'plates'])->name('plates');

Route::get('/plate/details/{id}', [FrontController::class, 'show'])->name('plate.show');

// Search Route
Route::get('/search', [FrontController::class, 'search'])->name('search');
Route::get('/plates/search', [FrontController::class, 'search'])->name('plates.search');
Route::get('/getCodes/{emirate_id}', [FrontController::class, 'getCodes']);
// Social Authentication Routes
Route::get('auth/google', [App\Http\Controllers\Auth\SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\SocialAuthController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [App\Http\Controllers\Auth\SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\SocialAuthController::class, 'handleFacebookCallback']);

// Add this with your other social auth routes
Route::get('auth/apple', [App\Http\Controllers\Auth\SocialAuthController::class, 'redirectToApple'])->name('auth.apple');
Route::get('auth/apple/callback', [App\Http\Controllers\Auth\SocialAuthController::class, 'handleAppleCallback']);

// Change Language
Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('change.language');

Route::middleware(['auth', 'verified', 'role:user'])
    ->prefix('user')->name('user.')
    ->group(function () {
        // USE THIS CONTROLLER FOR USER SETTING
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
        Route::get(
            '/dashboard',
            [ProfileController::class, 'dashboard']
        )->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// Include admin routes

require __DIR__ . '/admin.php';

require __DIR__ . '/auth.php';
