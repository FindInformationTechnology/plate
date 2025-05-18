@extends('layouts.app')

@section('content')

<!-- Plate Details -->

<section class="plate-details">
	<div class="container my-4 border border-dark-subtle rounded-3">
		<div class="w-100">
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
		</div>
		<div class="p-4 border-bottom border-dark-subtle">
			<div class="d-flex justify-content-between align-items-center">
				<div>
					<h1 class="text-dark fs-1 fw-semibold">{{ $plate->emirate->name }} 
					{{ $plate->number }} code {{ $plate->code->name }}</h1>
					<p class="text-success fs-2 fw-semibold py-1">{{ $plate->price_digits }}</p>
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
				@foreach($plates as $plate)
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
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Plate Details -->



@endsection