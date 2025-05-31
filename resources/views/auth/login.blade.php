@extends('layouts.app')

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


@endsection