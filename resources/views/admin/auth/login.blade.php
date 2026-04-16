@extends('layouts.auth')

@section('title', __('message.Sign_In') . ' - ' . config('app.name'))

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
                    <!-- <p class="account-subtitle">{{ __('message.We_will_send_a_confirmation_code_to_your_email') }}.</p> -->
                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <div class="input-block">
                            <label class="form-label">{{ __('message.Email') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" placeholder="">
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
                        <!-- <div class="input-block">
                            <a class="forgot-link" href="{{ route('password.request') }}">{{ __('message.Forgot_Password')
                                }} ?</a>
                        </div> -->
                       

                        <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1">{{ __('message.Sign_In')
                            }}</button>
                       
                       
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection