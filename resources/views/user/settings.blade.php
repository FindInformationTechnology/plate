@extends('layouts.app')

@section('content')



<!-- Breadscrumb Section -->
<div class="breadcrumb-bar">
	<div class="container">
		<div class="row align-items-center text-center">
			<div class="col-md-12 col-12">
				<h2 class="breadcrumb-title">User Settings</h2>
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">User Settings</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- /Breadscrumb Section -->

<!-- Dashboard Menu -->
@include('partials._settings_sidebar')
<!-- /Dashboard Menu -->

<!-- Page Content -->
<div class="content">
	<div class="container">

		<!-- Content Header -->
		<div class="content-header content-settings-header">
			<h4>Settings</h4>
		</div>
		<!-- /Content Header -->

		<div class="row">

			<!-- Settings Menu -->
			@include('partials._settings_menu')

			<!-- /Settings Menu -->

			<!-- Settings Details -->
			<div class="col-lg-9">
				@if(request()->routeIs('settings.profile'))
					@include('partials.settings._profile')
				@elseif(request()->routeIs('settings.security'))
					@include('partials.settings._security')
				@endif
			</div>
			<!-- /Settings Details -->

		</div>

	</div>
</div>
<!-- /Page Content -->
@endsection