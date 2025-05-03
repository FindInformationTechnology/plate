<div class="dashboard-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="dashboard-menu">
							<ul>
								<li>
									<a href="{{ route('user.profile.edit') }}" class=" @if (Route::currentRouteName() == 'user.profile.edit' ) active  @endif ">
										<img src="{{ asset ('assets/img/icons/dashboard-icon.svg') }}" alt="Icon">
										<span>Profile</span>
									</a>
								</li>
								<li>
									<a href="{{ route('user.plates') }}" class=" @if (Route::currentRouteName() == 'user.plates' ) active  @endif ">
										<img src="{{ asset ('assets/img/icons/booking-icon.svg') }}" alt="Icon">
										<span>My Plate List</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ asset ('assets/img/icons/review-icon.svg') }}" alt="Icon">
										<span>Reviews</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ asset ('assets/img/icons/wishlist-icon.svg') }}" alt="Icon">
										<span>Wishlist</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ asset ('assets/img/icons/message-icon.svg') }}" alt="Icon">
										<span>Messages</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ asset ('assets/img/icons/wallet-icon.svg') }}" alt="Icon">
										<span>My Wallet</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ asset ('assets/img/icons/payment-icon.svg') }}" alt="Icon">
										<span>Payments</span>
									</a>
								</li>
								<li>
									<a href="#" class=" @if (Route::currentRouteName() == 'setting.profile' ) active  @endif ">
										<img src="{{ asset ('assets/img/icons/settings-icon.svg') }}" alt="Icon">
										<span>Settings</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>