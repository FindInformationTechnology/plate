@extends('layouts.auth')

@section('content')

<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="{{ route('home') }}" class="btn sign-up"><span><i
                                class="fe feather-corner-down-left" aria-hidden="true"></i></span> {{
                        __('message.Back_To_Home') }}</a>
                </div>
                <h1>{{ __('message.Sign_Up') }}</h1>
                <p class="account-subtitle">{{ __('message.We_will_send_a_confirmation_code_to_your_email') }}.</p>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="post" action="{{ route('register') }}" id="registerForm">
                    @csrf
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                            placeholder="{{ __('message.Enter_your_full_name') }}" required>
                    </div>
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Email') }} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control"
                            placeholder="{{ __('message.Enter_your_email') }}" required>
                    </div>
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Phone_Number') }} <span
                                class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control"
                            placeholder="{{ __('message.Enter_your_phone_number') }}" required>
                    </div>
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Password') }} <span
                                class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control pass-input"
                                placeholder="{{ __('message.Create_password') }}" required>
                            <span class="fas fa-eye-slash toggle-password"></span>
                        </div>
                    </div>
                    <div class="input-block">
                        <label class="form-label">{{ __('message.Confirm_Password') }} <span
                                class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password_confirmation" class="form-control pass-input"
                                placeholder="{{ __('message.Confirm_password') }}" required>
                            <span class="fas fa-eye-slash toggle-password"></span>
                        </div>
                    </div>

                    <div class="input-block">
                       
                        <div class="pass-group">
                            <!-- Add hidden reCAPTCHA input field -->
                            <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">

                        </div>
                    </div>



                    <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1">{{ __('message.Sign_Up')
                        }}</button>

                    <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or">{{ __('message.Or_Create_an_account_with_your_email') }}</span>
                    </div>
                    <!-- Social Login -->
                    <div class="social-login">
                        <a href="{{ route('auth.google') }}"
                            class="d-flex align-items-center justify-content-center input-block btn google-login w-100">
                            <span><img src="{{ asset('assets/img/icons/google.svg') }}" class="img-fluid"
                                    alt="Google"></span>{{ __('message.Sign_up_with_Google') }}
                        </a>
                    </div>
                    <!-- <div class="social-login">
                        <a href="{{ route('auth.apple') }}" class="d-flex align-items-center justify-content-center input-block btn apple-login w-100">
                            <span><img src="{{ asset('assets/img/icons/apple.svg') }}" class="img-fluid" alt="Apple"></span>Sign up with Apple
                        </a>
                    </div> -->
                    <!-- <div class="social-login">
                        <a href="{{ route('auth.facebook') }}" class="d-flex align-items-center justify-content-center input-block btn google-login w-100">
                            <span><img src="{{ asset('assets/img/icons/facebook.svg') }}" class="img-fluid" alt="Facebook"></span>Sign up with Facebook
                        </a>
                    </div> -->
                    <!-- /Social Login -->

                    <div class="text-center dont-have">{{ __('message.Already_have_an_Account') }}? <a
                            href="{{ route('login') }}">{{ __('message.Sign_In') }}</a></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add reCAPTCHA v3 script at the end of the body -->
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    grecaptcha.ready(function() {
        // Execute reCAPTCHA with action 'register'
        grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", {
                action: 'register'
            })
            .then(function(token) {
                // Add the token to the hidden field
                document.getElementById('recaptchaResponse').value = token;
            });
    });
</script>

@endsection