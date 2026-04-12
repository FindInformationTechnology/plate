<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PlateController;
use App\Http\Controllers\Front\UserSettingController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Auth\PhoneVerificationController;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Models\Plate;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;



Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // Add main static pages with priorities
    $sitemap->add(
        Url::create('/')
            ->setPriority(1.0)
            ->setChangeFrequency('daily')
            ->setLastModificationDate(now())
    );

    $sitemap->add(
        Url::create('/plates')
            ->setPriority(0.9)
            ->setChangeFrequency('daily')
            ->setLastModificationDate(now())
    );

    $sitemap->add(
        Url::create('/contact')
            ->setPriority(0.7)
            ->setChangeFrequency('monthly')
            ->setLastModificationDate(now())
    );

    // Add search page
    $sitemap->add(
        Url::create('/plates/search')
            ->setPriority(0.8)
            ->setChangeFrequency('weekly')
            ->setLastModificationDate(now())
    );

    // Add emirate-specific pages
    \App\Models\Emirate::all()->each(function ($emirate) use ($sitemap) {
        $sitemap->add(
            Url::create("/plates/search?emirate_id={$emirate->id}")
                ->setPriority(0.8)
                ->setChangeFrequency('daily')
                ->setLastModificationDate($emirate->updated_at ?? now())
        );
    });

    // Add dynamic plate listing pages (only visible and approved)
    Plate::where('is_visible', true)
        ->where('is_approved', true)
        ->where('is_sold', false)
        ->select(['id', 'updated_at'])
        ->chunk(1000, function ($plates) use ($sitemap) {
            foreach ($plates as $plate) {
                $sitemap->add(
                    Url::create("/plate/details/{$plate->id}")
                        ->setLastModificationDate($plate->updated_at)
                        ->setPriority(0.8)
                        ->setChangeFrequency('weekly')
                );
            }
        });

    // Return XML response with proper headers
    return response($sitemap->render(), 200, [
        'Content-Type' => 'application/xml',
        'Cache-Control' => 'public, max-age=3600', // Cache for 1 hour
    ]);
});




Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/plates', [FrontController::class, 'plates'])->name('plates');

Route::get('/plate/details/{id}', [FrontController::class, 'show'])->name('plate.show');

Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.send');


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

        // Routes that require phone verification
        Route::middleware('phone.verified')->group(function () {
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
        });

        // Routes that don't require phone verification
        Route::get('/api/codes-by-emirate', [PlateController::class, 'getCodesByEmirate'])->name('api.codes.by.emirate');

        // User profile routes (don't require phone verification as user needs to access profile to verify phone)
        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    
    require __DIR__ . '/admin.php';
    require __DIR__ . '/auth.php';