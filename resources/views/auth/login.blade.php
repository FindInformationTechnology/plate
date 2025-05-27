@extends('layouts.auth')

@section('content')


<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="{{ route('home') }}" class="btn sign-up"><span><i class="fe feather-corner-down-left"
                                aria-hidden="true"></i></span> {{ __('message.Back_To_Home') }}</a>
                </div>
                <h1>{{ __('message.Sign_In') }}</h1>
                <p class="account-subtitle">{{ __('message.We_will_send_a_confirmation_code_to_your_email') }}.</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Email_or_Phone') }} <span class="text-danger">*</span></label>
                        <input type="text" name="login" class="form-control" placeholder="">
                        @error('login')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Password') }} <span
                                class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control pass-input" placeholder="">
                            <span class="fas fa-eye-slash toggle-password"></span>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-block">
                        <a class="forgot-link" href="{{ route('password.request') }}">{{ __('message.Forgot_Password')
                            }} ?</a>
                    </div>
                    <div class="input-block m-0">
                        <label class="custom_check d-inline-flex"><span>{{ __('message.Remember_me') }}</span>
                            <input type="checkbox" name="remeber">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1">{{ __('message.Sign_In')
                        }}</button>
                    <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or-log">{{ __('message.Or_log_in_with_your_email') }}</span>
                    </div>
                    <!-- Social Login -->
                    <div class="social-login">
                        <a href="#"
                            class="d-flex align-items-center justify-content-center input-block btn google-login w-100"><span><img
                                    src="assets/img/icons/google.svg" class="img-fluid" alt="Google"></span>{{
                            __('message.Log_in_with_Google') }}</a>
                    </div>
                    <!-- <div class="social-login">
                        <a href="#"
                            class="d-flex align-items-center justify-content-center input-block btn google-login w-100"><span><img
                                    src="assets/img/icons/facebook.svg" class="img-fluid" alt="Facebook"></span>{{
                            __('message.Log_in_with_Facebook') }}</a>
                    </div> -->
                    <!-- /Social Login -->
                    <div class="text-center dont-have">{{ __('message.Dont_have_an_account_yet') }}? <a
                            href="{{  route ('register') }}">{{ __('message.Register') }}</a></div>
                </form>
            </div>
        </div>
    </div>
</div>



{{--<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="current-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
</div>

<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
    </a>
    @endif

    <x-primary-button class="ms-3">
        {{ __('Log in') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout>
--}}

@endsection