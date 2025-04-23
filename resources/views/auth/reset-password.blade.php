@extends('layouts.auth')

@section('content')



        <div class="login-wrapper">
            <div class="loginbox">
                <div class="login-auth">
                    <div class="login-auth-wrap">
                        <div class="sign-group">
                            <a href="index.html" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> Back To Home</a>
                        </div>
                        <h1>Reset Password</h1>
                        <p class="account-subtitle">Your new password must be different from previous used passwords.</p>
                        <form action="index.html">
                            <div class="input-block">
                                <label class="form-label">New Password <span class="text-danger">*</span></label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" placeholder="">
                                    <span class="fas fa-eye-slash toggle-password"></span>
                                </div>
                            </div>
                            <div class="input-block">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input-two" placeholder="">
                                    <span class="fas fa-eye-slash toggle-password-two"></span>
                                </div>
                            </div>
                            <button class="btn btn-outline-light w-100 btn-size">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

     

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
@csrf

<!-- Password Reset Token -->
<input type="hidden" name="token" value="{{ $request->route('token') }}">

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />
    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

    <x-text-input id="password_confirmation" class="block mt-1 w-full"
        type="password"
        name="password_confirmation" required autocomplete="new-password" />

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button>
        {{ __('Reset Password') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout>
--}}

@endsection