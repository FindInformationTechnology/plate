<?php

use App\Http\Controllers\Front\UserSettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('front.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/settings/profile',[UserSettingController::class, 'profile'])->name('settings.profile');
    Route::get('/settings/security', [UserSettingController::class, 'security'])->name('settings.security');
    Route::get('/settings/notification', [UserSettingController::class, 'notification'])->name('settings.notification');
    Route::get('/settings/payment', [UserSettingController::class, 'payment'])->name('settings.payment');

   

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
