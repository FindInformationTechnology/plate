<div class="col-lg-3 theiaStickySidebar">
	<div class="settings-widget">
		<div class="settings-menu">
			<ul>
				<li>
					<a href="{{ route('user.profile.edit') }}" 
					@if(request()->routeIs('user.profile')) class="active" @endif>
						<i class="feather-user"></i> Profile
					</a>
				</li>
				<li>
					<a href="{{ route('user.security') }}" @if(request()->routeIs('user.security')) class="active" @endif>
						<i class="feather-shield"></i> Security
					</a>
				</li>
				<li>
					<a href="#">
						<i class="feather-star"></i> Preferences
					</a>
				</li>
				<li>
					<a href="#">
						<i class="feather-bell"></i> Notifications
					</a>
				</li>
				<li>
					<a href="#">
						<i class="feather-git-merge"></i> Integration
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>