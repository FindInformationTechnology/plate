<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../../">
	<title>Admin</title>
	<meta charset="utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<link rel="canonical" href="" />
	<link rel="shortcut icon" href="{{ asset ('assets/dashboard-assets/media/logos/favicon.ico') }}" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="{{ asset ('assets/dashboard-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset ('assets/dashboard-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png)">
			<!--begin::Content-->
			<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
				<!--begin::Logo-->
				<a href="assets#" class="mb-12">
					<img alt="Find" src="{{ asset ('assets/dashboard-assets/media/logos/custom-1.png') }}" class="h-40px" />
				</a>
				<!--end::Logo-->
				<!--begin::Wrapper-->
				<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
					<!-- Display login errors -->
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<!-- End of display errors -->

					<!--begin::Form-->
					<form class="form w-100" method="POST" action="{{ route ('login') }}">
						@csrf
						<!--begin::Heading-->
						<div class="text-center mb-10">
							<!--begin::Title-->
							<h1 class="text-dark mb-3">Sign In to Find</h1>
							<!--end::Title-->
							<!--begin::Link-->
							<!-- <div class="text-gray-400 fw-bold fs-4">New Here? -->
							<!-- <a href="" class="link-primary fw-bolder">Create an Account</a></div> -->
							<!--end::Link-->
						</div>
						<!--begin::Heading-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--begin::Label-->
							<label class="form-label fs-6 fw-bolder text-dark">Email</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input class="form-control form-control-lg  " type="text" name="email" autocomplete="off" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack mb-2">
								<!--begin::Label-->
								<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
								<!--end::Label-->
								<!--begin::Link-->
								@if (Route::has('password.request'))
								<a href="" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
								@endif
								<!--end::Link-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Input-->
							<input class="form-control form-control-lg  " type="password" name="password" autocomplete="off" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Actions-->
						<div class="text-center">
							<!--begin::Submit button-->
							<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
								<span class="indicator-label">Continue</span>
								<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
							<!--end::Submit button-->
							
						</div>
						<!--end::Actions-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Content-->
			<!--begin::Footer-->
			<div class="d-flex flex-center flex-column-auto p-10">
				
			</div>
			<!--end::Footer-->
		</div>
		<!--end::Authentication - Sign-in-->
	</div>
	
	<!--end::Root-->
	<!--end::Main-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="{{ asset ('assets/dashboard-assets/plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset ('assets/dashboard-assets/js/scripts.bundle.js') }}"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="{{ asset ('assets/dashboard-assets/js/custom/authentication/sign-in/general.js') }}"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
	
</body>
<!--end::Body-->

</html>