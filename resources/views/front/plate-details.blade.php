@extends('layouts.app')

@section('content')

<!-- Plate Details -->

<section class="plate-details">
	<div class="container my-4 border border-dark-subtle rounded-3">
		<div class="w-100">
			<img src="{{ asset('assets/img/car-plates/1-X3214410.png') }}" alt="car-plate" class="w-100 mt-2">
		</div>
		<div class="p-4 border-bottom border-dark-subtle">
			<div class="d-flex justify-content-between align-items-center">
				<div>
					<h1 class="text-dark fs-1 fw-semibold">Dubai 32144 code X</h1>
					<p class="text-success fs-2 fw-semibold py-1">AED 2,800</p>
				</div>
				<div>
					<i class="bx bx-heart fs-2"></i>
				</div>
			</div>
			<div class="d-flex align-items-center gap-3 my-2 text-center ">
				<a href="#" class="contact d-flex align-items-center justify-content-center gap-2 py-2 flex-grow-1 rounded-2"><i class="bx bx-phone fs-5"></i>
					<p>contact</p>
				</a>
				<a href="#" class="whatsapp d-flex align-items-center justify-content-center gap-2 py-2 flex-grow-1 rounded-2"><i class="bx bxl-whatsapp fs-5"></i>
					<p>whatsapp</p>
				</a>
			</div>
		</div>
		<div class="p-3">
			<h1 class="text-secondary fs-3">Similar</h1>
			<div class="pt-5 d-grid">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12">
						<div class="listing-item plate-card position-relative">
							<div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div>
							<div class="d-flex justify-content-end align-items-center">
								<div class="text-left"><i class="bx bx-heart fs-4"></i></div>
							</div>
							<div class="w-100 my-4">
								<img src="{{ asset('assets/img/car-plates/1-X3210.png')}}" alt="car-plate" class="w-100" loading="lazy">
							</div>
							<div>
								<p class="text-success fs-4 text-center fw-semibold pb-4">AED 5000 </p>
							</div>
							<div class="border-top">
								<a href="#" class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i class="bx bx-phone"></i>
									<p>Contact</p>
								</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<div class="listing-item plate-card position-relative">
							<div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div>
							<div class="d-flex justify-content-end align-items-center">
								<div class="text-left"><i class="bx bx-heart fs-4"></i></div>
							</div>
							<div class="w-100 my-4">
								<img src="{{ asset('assets/img/car-plates/1-X3214410.png') }}" alt="car-plate" class="w-100" loading="lazy">
							</div>
							<div>
								<p class="text-success fs-4 text-center fw-semibold pb-4">AED 5,700</p>
							</div>
							<div class="border-top">
								<a href="#" class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i class="bx bx-phone"></i>
									<p>Contact</p>
								</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<div class="listing-item plate-card position-relative">
							<div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div>
							<div class="d-flex justify-content-end align-items-center">
								<div class="text-left"><i class="bx bx-heart fs-4"></i></div>
							</div>
							<div class="w-100 my-4">
								<img src="{{ asset('assets/img/car-plates/25.png') }}" alt="car-plate" class="w-100" loading="lazy">
							</div>
							<div>
								<p class="text-success fs-4 text-center fw-semibold pb-4">AED 5000</p>
							</div>
							<div class="border-top">
								<a href="#" class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i class="bx bx-phone"></i>
									<p>Contact</p>
								</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<div class="listing-item plate-card position-relative">
							<div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div>
							<div class="d-flex justify-content-end align-items-center">
								<div class="text-left"><i class="bx bx-heart fs-4"></i></div>
							</div>
							<div class="w-100 my-4">
								<img src="{{ asset('assets/img/car-plates/20.png') }}" alt="car-plate" class="w-100" loading="lazy">
							</div>
							<div>
								<p class="text-success fs-4 text-center fw-semibold pb-4">AED 1,500</p>
							</div>
							<div class="border-top">
								<a href="#" class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i class="bx bx-phone"></i>
									<p>Contact</p>
								</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<div class="listing-item plate-card position-relative">
							<div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div>
							<div class="d-flex justify-content-end align-items-center">
								<div class="text-left"><i class="bx bx-heart fs-4"></i></div>
							</div>
							<div href="listing-details.html" class="w-100 my-4 d-block">
								<img src="{{ asset('assets/img/car-plates/25.png') }}" alt="car-plate" class="w-100" loading="lazy">
							</div>
							<div>
								<p class="text-success fs-4 text-center fw-semibold pb-4">AED 3,500</p>
							</div>
							<div class="border-top">
								<a href="#" class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i class="bx bx-phone"></i>
									<p>Contact</p>
								</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<div class="listing-item plate-card position-relative">
							<div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div>
							<div class="d-flex justify-content-end align-items-center">
								<div class="text-left"><i class="bx bx-heart fs-4"></i></div>
							</div>
							<div class="w-100 my-4">
								<img src="{{ asset('assets/img/car-plates/250.png') }}" alt="car-plate" class="w-100" loading="lazy">
							</div>
							<div>
								<p class="text-success fs-4 text-center fw-semibold pb-4">AED 2000</p>
							</div>
							<div class="border-top">
								<a href="#" class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i class="bx bx-phone"></i>
									<p>Contact</p>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Plate Details -->



@endsection