﻿@extends('layouts.app')

@section('content')

<!-- Breadscrumb Section -->
<!-- <div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Plates</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Plates</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> -->
<!-- /Breadscrumb Section -->

<!-- Plate Details -->

<section class="plate-details">
    <div class="container my-4 border border-dark-subtle rounded-3">

        <div class="p-3">
            <!-- <h1 class="text-secondary fs-3">Similar</h1> -->
            <div class="pt-5 d-grid">
                <div class="row">
                    @forelse($plates as $plate)
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
                                <h1 class="position-absolute {{ $plate->emirate->slug }}-icon fw-semibold">{{
                                    $plate->code->name }}</h1>
                                <h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal">{{
                                    $plate->number }}</h2>
                                @else
                                <div class=" {{ $plate->emirate->slug }}-plate position-absolute d-flex
                                    justify-content-between align-items-center">
                                    <h1 class="fw-medium">{{ $plate->code->name }}</h1>
                                    <h2 class="fw-medium">{{ $plate->number }}</h2>
                                </div>
                                @endif
                            </div>
                            <div>
                                <p class="price fs-4 text-center fw-normal pb-4">{{ $plate->price_digits }}</p>
                            </div>
                            <div class="border-top">
                                <a href="{{ route('plate.show', $plate->id) }}"
                                    class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2"><i
                                        class="bx bx-phone"></i>
                                    <p>{{ __('message.Contact') }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p class="text-danger">{{ __('message.No_plates_found') }}.</p>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Plate Details -->



@endsection
