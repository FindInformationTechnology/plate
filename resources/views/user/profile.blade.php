@extends('layouts.app')

@section('content')







<!-- Page Content -->
<div class="content">
	<div class="container">

		<!-- Content Header -->
		<!-- <div class="content-header content-settings-header">
			<h4>Profile</h4>
		</div> -->
		<!-- /Content Header -->

		<div class="row">

			<!-- Settings Menu -->
			<!-- @include('partials._settings_menu') -->

			<!-- /Settings Menu -->

			<!-- Settings Details -->
			<div class="col-lg-9 mx-auto">
				@if(request()->routeIs('user.profile.edit'))
					@include('partials.settings._profile')
				@elseif(request()->routeIs('user.security'))
					@include('partials.settings._security')
				@endif
			</div>
			<!-- /Settings Details -->

		</div>

	</div>
</div>
<!-- /Page Content -->
@endsection