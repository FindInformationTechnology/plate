<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Check if the request is for the admin login page
        if (request()->is('admin/login') || request()->is('admin/*')) {
            return view('admin.pages.auth.login');
        }
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        if($user->hasRole('admin')){
            return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Welcome to the admin dashboard');
        }elseif ($user->hasRole('user')) {
            return redirect()->intended(route('home'))
            ->with('success', 'Welcome back, ' . $user->name . '! You are logged in successfully.');
        }

        return redirect()->intended(route('home'))
        ->with('success', 'You have been logged in successfully.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
