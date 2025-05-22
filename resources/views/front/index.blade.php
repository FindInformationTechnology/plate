@extends('layouts.app')

@section('content')

<!-- Banner -->
<!-- Banner -->
<section class="banner-section banner-sec-two banner-slider">
	<div class="banner-img-slider owl-carousel">
		<div class="slider-img">
			<img src="assets/img/owl-2.jpg" alt="Img">
		</div>
		<div class="slider-img">
			<img src="assets/img/owl-1.jpg" alt="Img">
		</div>
		<div class="slider-img">
			<img src="assets/img/owl-3.jpg" alt="Img">
		</div>
	</div>
	<div class="container">
		<div class="home-banner">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="hero-sec-contents">
						<div class="banner-title">
							<h1>{{ __('message.Popular Plates Categorie')}}
								<span>Made Simple.</span>
							</h1>
							<p>Modern design sports cruisers for those who crave adventure & grandeur yachts for relaxing with your loved ones.
								We Offer diverse and fully equipped yachts
							</p>
						</div>

					</div>

				</div>
			</div>
		</div>

	</div>
</section>
<!-- /Banner -->
<!-- /Banner -->
<!-- </div> -->


<!-- Yacht Categories -->
<section class="yacht-category-sec">

	<div class="container">

		<div class="section-header-two">
			<h2>Popular Plates Categories</h2>
			<p>
				Already have a plate style in mind? Explore our exclusive collection of premium license plates from across the country.
			</p>
		</div>
		<div class="row yacht-category-lists">



			@foreach ($plates as $plate)


			<div class="col-lg-4 col-md-6 col-12">
				<div class="listing-item plate-card position-relative">
					<!-- <div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div> -->
					<div class="d-flex justify-content-end align-items-center">
						<div class="text-left"><i class="bx bx-heart fs-4"></i></div>
					</div>
					<div class="position-relative plate ">
						<div class="w-100 my-4">
							<img src="{{ $plate->emirate->image_url }}" alt="car-plate" class="w-100"
								loading="lazy">
						</div>
						@if ($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak')
						<h1 class="position-absolute {{ $plate->emirate->slug }}-icon fs-1 fw-semibold">{{ $plate->code->name }}</h1>
						<h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal">{{ $plate->number }}</h2>
						@else
						<div class=" {{  $plate->emirate->slug }}-plate position-absolute d-flex justify-content-between align-items-center">
							<h1 class=" fw-medium">{{ $plate->code->name }}</h1>
							<h2 class="fw-medium">{{ $plate->number }}</h2>
						</div>
						@endif
					</div>
					<div>
						<p class="text-success fs-4 text-center fw-semibold pb-4">{{ $plate->price_digits }}</p>
					</div>
					<div class="border-top">
						<a href="{{ route('plate.show', $plate->id) }}"
							class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i
								class="bx bx-phone"></i>
							<p>Contact</p>
						</a>
					</div>
				</div>
			</div>


			@endforeach


			<div class="col-md-12">
				<div class="view-more-btn text-center">
					<a href="{{ route('plates') }}" class="btn btn-secondary">View More Plates</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Yacht Categories -->





@endsection