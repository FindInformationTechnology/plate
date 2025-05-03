<?php


use App\Http\Controllers\Front\PlateController;
use App\Http\Controllers\Front\UserSettingController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('front.index');
})->name('home');





Route::middleware(['auth', 'verified', 'role:user'])
->prefix('user')-> name('user.')
-> group(function () {
    
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');


    Route::get(' /security', [UserSettingController::class, 'security'])->name('security');
    Route::get('/settings/notification', [UserSettingController::class, 'notification'])->name('settings.notification');
    Route::get('/settings/payment', [UserSettingController::class, 'payment'])->name('settings.payment');

    Route::get('/plates', [PlateController::class,'index'])->name('plates');
    Route::get('/plates/create', [PlateController::class, 'create'])->name('plates.create');
    Route::post('/plates', [PlateController::class, 'store'])->name('plates.store');
    Route::get('/plates/{id}', [PlateController::class, 'show'])->name('plates.show');
    Route::get('/plates/{id}/edit', [PlateController::class,'edit'])->name('plates.edit');
    Route::put('/plates/{id}', [PlateController::class,'update'])->name('plates.update');
    Route::delete('/plates/{id}', [PlateController::class,'destroy'])->name('plates.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
