@extends('layouts.app')

@section('content')



<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="{{ route('home') }}" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> {{ __('message.Back_To_Home') }}</a>
                </div>
                <h1>{{ __('message.Reset_Password') }}</h1>
                <p class="account-subtitle">{{ __('message.Your_new_password_must_be_different_from_previous_used_passwords') }}</p>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Email_Address') }} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-block">
                        <label class="form-label">{{ __('message.New_Password') }} <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control pass-input" placeholder="">
                            <span class="fas fa-eye-slash toggle-password"></span>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Confirm_Password') }} <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password_confirmation" class="form-control pass-input-two" placeholder="">
                            <span class="fas fa-eye-slash toggle-password-two"></span>
                        </div>
                    </div>
                    <button class="btn btn-outline-light w-100 btn-size">{{ __('message.Save_Changes') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>






@endsection