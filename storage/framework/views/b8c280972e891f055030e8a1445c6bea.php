<!-- Footer -->
	<footer class="footer-two">
		<div class="sec-bg">
			<img src="<?php echo e(asset ('assets/img/bg/sec-bg-wave.png')); ?>" alt="Img">
			<!-- <img src="<?php echo e(asset ('assets/img/bg/anchor-img-02.png')); ?>" alt="Img"> -->
		</div>
		<div class="container">
			<div class="footer-top">
				<div class="row">
					<div class="col-md-6">
						<div class="footer-widget">
							<div class="widget-title">
								<div>
								<img src="<?php echo e(asset ('assets/img/logo-b.png')); ?>" width="150" class="img-fluid" alt="Logo">
								</div>
								<p class="mt-3 mb-3"><?php echo e(__('message.Plate_is_a_premier_platform')); ?></p>
								<ul class="footer-address">
									<li><i class="fas fa-map-marker-alt me-2"></i><?php echo e(__('message.Dubai_United_Arab_Emirates')); ?></li>
									<li ><i class="fas fa-phone-alt me-2"></i> <span style="direction: ltr !important;">050 551 5131</span> </li>
									<li><i class="fas fa-envelope me-2"></i>info@plate35.com</li>
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
										<h4><?php echo e(__('message.Quick_Links')); ?></h4>
										<ul class="footer-links">
											<li><a href="<?php echo e(route('home')); ?>"><i class="fas fa-chevron-right"></i><?php echo e(__('message.Home')); ?></a></li>
											<li><a href=""><i class="fas fa-chevron-right"></i><?php echo e(__('message.About_Us')); ?></a></li>
											<li><a href="<?php echo e(route('plates')); ?>"><i class="fas fa-chevron-right"></i><?php echo e(__('message.Browse_Plates')); ?></a></li>
											
											
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<div class="widget-title">
										<h4><?php echo e(__('message.User_Account')); ?></h4>
										<ul class="footer-links">
											<?php if(auth()->guard()->guest()): ?>
											<li><a href="<?php echo e(route('login')); ?>"><i class="fas fa-chevron-right"></i><?php echo e(__('message.Login')); ?></a></li>
											<li><a href="<?php echo e(route('register')); ?>"><i class="fas fa-chevron-right"></i><?php echo e(__('message.Register')); ?></a></li>
											<?php endif; ?>
											<?php if(auth()->guard()->check()): ?>
											<li><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fas fa-chevron-right"></i><?php echo e(__('message.My_Dashboard')); ?></a></li>
											<li><a href="<?php echo e(route('user.plates')); ?>"><i class="fas fa-chevron-right"></i><?php echo e(__('message.My_Plates')); ?></a></li>
											<li><a href="<?php echo e(route('user.profile')); ?>"><i class="fas fa-chevron-right"></i><?php echo e(__('message.My_Profile')); ?></a></li>
											<?php endif; ?>
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
					<p><?php echo e(__('message.Copyright')); ?> &copy; 2025 <span>   Plate 35 </span> . <?php echo e(__('message.All_Rights_Reserved')); ?>.</p>
				</div>
				<div class="app-store-links d-flex align-items-center">
					<span class="me-2"><a href="javascript:void(0);"><img src="<?php echo e(asset ('assets/img/icons/google-play.svg')); ?>" alt="Img"></a></span>
					<span><a href="javascript:void(0);"><img src="<?php echo e(asset ('assets/img/icons/app-store.svg')); ?>" alt="Img"></a></span>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer --><?php /**PATH E:\Website\Github\plate\resources\views/layouts/footer.blade.php ENDPATH**/ ?>