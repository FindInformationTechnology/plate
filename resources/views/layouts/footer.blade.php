<!-- Footer -->
	<footer class="footer-two">
		<div class="sec-bg">
			<img src="{{   asset ('assets/img/bg/sec-bg-wave.png') }}" alt="Img">
			<img src="{{   asset ('assets/img/bg/anchor-img-02.png') }}" alt="Img">
		</div>
		<div class="container">
			<div class="footer-top">
				<div class="row">
					<div class="col-md-6">
						<div class="footer-widget">
							<div class="widget-title">
								<h4>About Plate</h4>
								<p class="mt-3 mb-3">Plate is a premier platform for buying and selling vehicle license plates in the UAE. We connect plate owners with potential buyers, making the process simple and secure.</p>
								<ul class="footer-address">
									<li><i class="fas fa-map-marker-alt me-2"></i>Dubai, United Arab Emirates</li>
									<li><i class="fas fa-phone-alt me-2"></i>+971 50 123 4567</li>
									<li><i class="fas fa-envelope me-2"></i>info@plate.ae</li>
								</ul>
								<!-- <li class="social-link mt-3">
									<ul>
										<li><a href="javascript:void(0);"><i class="fa-brands fa-facebook-f"></i></a></li>
										<li><a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a></li>
										<li><a href="javascript:void(0);"><i class="fa-brands fa-twitter"></i></a></li>
										<li><a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a></li>
									</ul>
								</li> -->
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<div class="widget-title">
										<h4>Quick Links</h4>
										<ul class="footer-links">
											<li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i>Home</a></li>
											<li><a href=""><i class="fas fa-chevron-right"></i>About Us</a></li>
											<li><a href="{{ route('plates') }}"><i class="fas fa-chevron-right"></i>Browse Plates</a></li>
											
											
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<div class="widget-title">
										<h4>User Account</h4>
										<ul class="footer-links">
											@guest
											<li><a href="{{ route('login') }}"><i class="fas fa-chevron-right"></i>Login</a></li>
											<li><a href="{{ route('register') }}"><i class="fas fa-chevron-right"></i>Register</a></li>
											@endguest
											@auth
											<li><a href="{{ route('user.dashboard') }}"><i class="fas fa-chevron-right"></i>My Dashboard</a></li>
											<li><a href="{{ route('user.plates') }}"><i class="fas fa-chevron-right"></i>My Plates</a></li>
											<li><a href="{{ route('user.profile') }}"><i class="fas fa-chevron-right"></i>My Profile</a></li>
											@endauth
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="copy-right">
					<p>Copyright &copy; 2025 <span> 999 | Plate </span> . All Rights Reserved.</p>
				</div>
				<div class="app-store-links d-flex align-items-center">
					<span class="me-2"><a href="javascript:void(0);"><img src="{{ asset ('assets/img/icons/google-play.svg')}}" alt="Img"></a></span>
					<span><a href="javascript:void(0);"><img src="{{ asset ('assets/img/icons/app-store.svg') }}" alt="Img"></a></span>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer -->