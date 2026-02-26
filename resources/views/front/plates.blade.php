@extends('layouts.app')

@section('title', __('message.Browse_Plates') . ' - ' . config('app.name'))
@section('meta_description', __('message.Plates_Meta_Description'))
@section('keywords', 'browse UAE plates, search license plates, Dubai car plates, Abu Dhabi number plates')
@section('og_title', __('message.Browse_Plates') . ' - ' . config('app.name'))
@section('og_description', __('message.Plates_Meta_Description'))

@section('content')


    <!-- Breadscrumb Section -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12 col-12">
                    <h1 class="breadcrumb-title">{{ __('message.Plates') }}</h1>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('message.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('message.Plates') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadscrumb Section -->

    <!-- Plate Details -->

    <section class="plate-details">

        <div class="container">
            @include('front.search-form')
        </div>


        <div class="container my-4 ">



            <div>
                <!-- <h1 class="text-secondary fs-3">Similar</h1> -->
                <div class="pt-3 d-grid">
                    <div class="row">
                        @foreach($plates as $plate)
                            <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="listing-item plate-card position-relative">
                                    @if($plate->is_featured)
                                        <div class="d-flex justify-content-end align-items-center">
                                            <div class="text-left py-1 px-3 featured-color text-white rounded-2">
                                                {{ __('message.Featured') }}</div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-end align-items-center">
                                            <!-- <div class="text-left py-1 px-3  text-white rounded-2">{{ __('message.New') }}</div> -->
                                        </div>
                                    @endif
                                    <div class="position-relative plate ">
                                        <div class="w-100 my-4">
                                            <img src="{{ $plate->emirate->image_url }}" alt="car-plate" class="w-100"
                                                loading="lazy">
                                        </div>
                                        @if ($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak')
                                                                <span
                                                                    class="position-absolute {{ $plate->emirate->slug }}-icon fw-semibold main-shadow">{{
                                            $plate->code->name }}</span>
                                                                <h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal main-shadow">
                                                                    {{
                                            $plate->number }}</h2>
                                        @else
                                            <div class=" {{ $plate->emirate->slug }}-plate position-absolute d-flex
                                                justify-content-around align-items-center">
                                                <span class="fw-medium main-shadow">{{ $plate->code->name }}</span>
                                                <h2 class="fw-medium main-shadow">{{ $plate->number }}</h2>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="price fs-4 text-center fw-normal pb-4">{{ $plate->price_digits }}</p>
                                    </div>
                                    <div class="border-top">
                                        <a href="{{ route('plate.show', $plate->id) }}"
                                            class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2 nav-link"><i
                                                class="bx bx-phone"></i>
                                            <p>{{ __('message.Contact') }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- {{ $plates->links() }} -->
                {{ $plates->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>

    <!-- Plate Details -->



@endsection

@push('scripts')
    <script>
        document.querySelector(".toggle-options").addEventListener("click", function () {
            const extraOptions = document.querySelectorAll(".extra");
            const isHidden = extraOptions[0].classList.contains("d-none");

            extraOptions.forEach(opt => {
                opt.classList.toggle("d-none");
            });

            this.textContent = isHidden ? "- {{ __('message.less_options') }}" : "+ {{ __('message.more_options') }}";
        });

        document.getElementById('emirate_id').addEventListener('change', function () {
            var emirateId = this.value;
            var codeSelect = document.getElementById('code_id');

            // Clear existing options
            codeSelect.innerHTML = '<option value="">{{ __("message.Select_Code") }}</option>';

            if (emirateId) {
                // Make AJAX request to fetch codes
                fetch('/getCodes/' + emirateId) // Define this route in your web.php
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(code => {
                            var option = document.createElement('option');
                            option.value = code.id;
                            option.textContent = code.name;
                            codeSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>

@endpush