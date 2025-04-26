@extends('layouts.auth')

@section('content')



<div class="login-wrapper">
	<div class="loginbox">
		<div class="login-auth">
			<div class="login-auth-wrap">
				<div class="sign-group">
					<a href="#" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> Back To Home</a>
				</div>
				<h1>Sign Up</h1>
				<p class="account-subtitle">We'll send a confirmation code to your email.</p>

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<form method="post" action="{{ route('register') }}">
					@csrf
					<div class="input-block">
						<label class="form-label">Name <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
					</div>
					<div class="input-block">
						<label class="form-label">Email <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" placeholder="Enter your email" required>
					</div>
					<div class="input-block">
						<label class="form-label">Phone Number <span class="text-danger">*</span></label>
						<input type="tel" name="phone" class="form-control" placeholder="Enter your phone number" required>
					</div>
					<div class="input-block">
						<label class="form-label">Password <span class="text-danger">*</span></label>
						<div class="pass-group">
							<input type="password" name="password" class="form-control pass-input" placeholder="Create password" required>
							<span class="fas fa-eye-slash toggle-password"></span>
						</div>
					</div>
					<div class="input-block">
						<label class="form-label">Confirm Password <span class="text-danger">*</span></label>
						<div class="pass-group">
							<input type="password" name="password_confirmation" class="form-control pass-input" placeholder="Confirm password" required>
							<span class="fas fa-eye-slash toggle-password"></span>
						</div>
					</div>
					<button type="submit" class="btn btn-outline-light w-100 btn-size mt-1">Sign Up</button>

					<div class="login-or">
						<span class="or-line"></span>
						<span class="span-or">Or, Create an account with your email</span>
					</div>
					<!-- Social Login -->
					<div class="social-login">
						<a href="#" class="d-flex align-items-center justify-content-center input-block btn google-login w-100"><span><img src="{{ asset('assets/img/icons/google.svg') }}" class="img-fluid" alt="Google"></span>Log in with Google</a>
					</div>
					<div class="social-login">
						<a href="#" class="d-flex align-items-center justify-content-center input-block btn google-login w-100"><span><img src="{{ asset('assets/img/icons/facebook.svg') }}" class="img-fluid" alt="Facebook"></span>Log in with Facebook</a>
					</div>
					<!-- /Social Login -->
					<div class="text-center dont-have">Already have an Account? <a href="{{ route('login') }}">Sign In</a></div>
				</form>
			</div>
		</div>
	</div>
</div>



{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
@csrf

<!-- Name -->
<div>
	<x-input-label for="name" :value="__('Name')" />
	<x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
	<x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email Address -->
<div class="mt-4">
	<x-input-label for="email" :value="__('Email')" />
	<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
	<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
	<x-input-label for="password" :value="__('Password')" />

	<x-text-input id="password" class="block mt-1 w-full"
		type="password"
		name="password"
		required autocomplete="new-password" />

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
	<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
		{{ __('Already registered?') }}
	</a>

	<x-primary-button class="ms-4">
		{{ __('Register') }}
	</x-primary-button>
</div>
</form>
</x-guest-layout>
--}}

@endsection