<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>999 | Plate</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Fearther CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper login-body">
			<!-- Header -->
			<header class="log-header">
				<a href="">
				<a href=""><h1 >999 | Plate</h1></a>
 				</a> 
			</header>
			<!-- /Header -->

			<div class="login-wrapper">
				<div class="loginbox">						
					<div class="login-auth">
						<div class="login-auth-wrap">
							<div class="sign-group">
								<a href="#" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> Back To Home</a>
							</div>
							<h1>Sign Up</h1>
							<p class="account-subtitle">We'll send a confirmation code to your email.</p>								
							<form method="post" action="{{ route('register.store') }}">
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
			
			<!-- Footer -->
			<footer class="log-footer">				
				<div class="container-fluid">					
					<!-- Copyright -->
					<div class="copyright">
						<div class="copyright-text">
							<p>© 2024 999 Plate. All Rights Reserved.</p>
						</div>
					</div>
					<!-- /Copyright -->						
				</div>			
			</footer>
			<!-- /Footer -->
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{ asset('assets/js/script.js') }}"></script>

	</body>
</html>