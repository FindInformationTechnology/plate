<?php


use App\Http\Controllers\Front\PlateController;
use App\Http\Controllers\Front\UserSettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('front.index');
})->name('home');




Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('user.dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/settings/profile',[UserSettingController::class, 'profile'])->name('settings.profile');
    Route::get('/settings/security', [UserSettingController::class, 'security'])->name('settings.security');
    Route::get('/settings/notification', [UserSettingController::class, 'notification'])->name('settings.notification');
    Route::get('/settings/payment', [UserSettingController::class, 'payment'])->name('settings.payment');

    Route::get('/user/plates', [PlateController::class,'index'])->name('user.plates');
    Route::get('/user/plates/create', [PlateController::class, 'create'])->name('user.plates.create');
    Route::post('/user/plates', [PlateController::class, 'store'])->name('user.plates.store');
    Route::get('/user/plates/{id}', [PlateController::class, 'show'])->name('user.plates.show');
    Route::get('/user/plates/{id}/edit', [PlateController::class,'edit'])->name('user.plates.edit');
    Route::put('/user/plates/{id}', [PlateController::class,'update'])->name('user.plates.update');
    Route::delete('/user/plates/{id}', [PlateController::class,'destroy'])->name('user.plates.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
