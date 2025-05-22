<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255', 'unique:' . User::class],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,

            'password' => Hash::make($request->password),
        ]);

        // Assign the 'user' role to the newly registered user
        $user->assignRole('user');

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeEmail($user));

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false))
        ->with('success', 'Welcome to Plate! A confirmation email has been sent to your email address.');

        // return redirect(route('dashboard', absolute: false));
    }
}
