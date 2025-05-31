@extends('layouts.app')

@section('content')


<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="{{ route('home') }}" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> {{ __('message.Back_To_Home') }}</a>
                </div>
                <h1>{{ __('message.Forgot_Password') }}</h1>
                <p class="account-subtitle">{{ __('message.Enter_your_email_and_we_will_send_you_a_link_to_reset_your_password') }}.</p>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Email_Address') }} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- <a href="{{ route('password.email') }}" class="btn btn-outline-light w-100 btn-size">Save Changes</a> -->
            
                    <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1">{{ __('message.Send') }}</button>

                </form>
            </div>
        </div>
    </div>
</div>





@endsection
