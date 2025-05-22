<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Check if user already exists
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                // Log the user in
                Auth::login($existingUser);
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make(uniqid()), // Random password
                    'google_id' => $user->id,

                ]);

                // Set the role to 'user'
                $newUser->assignRole('user');

                Auth::login($newUser);
            }

            return redirect()->intended(route('user.dashboard'));
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            // Check if user already exists
            $existingUser = User::where('facebook_id', $user->id)->orWhere('email', $user->email)->first();

            if ($existingUser) {
                // Update facebook_id if it's not set
                if (!$existingUser->facebook_id) {
                    $existingUser->update(['facebook_id' => $user->id]);
                }

                // Log the user in
                Auth::login($existingUser);
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make(uniqid()), // Random password
                    'facebook_id' => $user->id,

                ]);

                // Set the role to 'user'
                $newUser->assignRole('user');

                Auth::login($newUser);
            }

            return redirect()->intended(route('user.dashboard'));
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Facebook authentication failed: ' . $e->getMessage());
        }
    }

    /**
     * Redirect the user to the Apple authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    /**
     * Obtain the user information from Apple.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleAppleCallback()
    {
        try {
            $user = Socialite::driver('apple')->user();

            // Check if user already exists
            $existingUser = User::where('apple_id', $user->id)->orWhere('email', $user->email)->first();

            if ($existingUser) {
                // Update apple_id if it's not set
                if (!$existingUser->apple_id) {
                    $existingUser->update(['apple_id' => $user->id]);
                }

                // Log the user in
                Auth::login($existingUser);
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => $user->name ?? explode('@', $user->email)[0], // Use email prefix if name not provided
                    'email' => $user->email,
                    'password' => Hash::make(uniqid()), // Random password
                    'apple_id' => $user->id,
                    
                ]);

                // Set the role to 'user'
                $newUser->assignRole('user');

                Auth::login($newUser);
            }

            return redirect()->intended(route('user.dashboard'));
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Apple authentication failed: ' . $e->getMessage());
        }
    }
}
