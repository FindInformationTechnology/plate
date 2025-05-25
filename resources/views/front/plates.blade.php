@extends('layouts.app')

@section('content')

<!-- Breadscrumb Section -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">{{ __('message.Plates') }}</h2>
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
    <div class="container my-4 ">
        <!-- Search Form -->
        <div class="mt-5 col-md-12 rounded-md search">
            <form class="d-flex flex-wrap gap-2 search-bar" action="{{ route('plates.search') }}" method="GET">
                <!-- All Options -->
                <div class="options d-flex flex-wrap gap-2 w-100">
                    <!-- Main Options -->
                    <select class="form-control search-option" id="emirate_id" name="emirate_id">
                        <option value="">{{ __('message.Select_Emirate') }}</option>
                        @foreach(\App\Models\Emirate::all() as $emirate)
                        <option value="{{ $emirate->id }}">{{ $emirate->name }}</option>
                        @endforeach
                    </select>

                    <select class="form-control search-option" id="code_id" name="code_id">
                        <option value="">{{ __('message.Select_Code') }}</option>
                        <!-- Codes will be populated here dynamically -->
                    </select>

                    <select class="form-control search-option" name="length">
                        <option value="">{{ __('message.All_Digit') }}</option>

                        <option value="1">1 Digit</option>
                        <option value="2">2 Digit</option>
                        <option value="3">3 Digit</option>
                        <option value="4">4 Digit</option>
                        <option value="5">5 Digit</option>

                    </select>

                    <!-- <input type="length" class="form-control search-option" name="number" placeholder="Plate Number"> -->

                    <!-- More Options -->
                    <input type="number" class="form-control search-option extra d-none" name="max_price"
                        placeholder="{{ __('message.Maximum_Price') }}">
                    <input type="number" class="form-control search-option extra d-none" name="min_price"
                        placeholder="{{ __('message.Minimum_Price') }}">
                    <input type="number" class="form-control search-option extra d-none" name="start_with"
                        placeholder="{{ __('message.Start_With') }}: ex:123">
                    <input type="number" class="form-control search-option extra d-none" name="end_with"
                        placeholder="{{ __('message.End_With') }}: ex:000">

                    <!-- Search Button -->
                    <button class="search-btn" type="submit">{{ __('message.Search') }}</button>
                </div>
            </form>
            <p class="toggle-options">+ {{ __('message.more_options') }}</p>
        </div>
        <!-- End Search Form -->
    </div>

    <div class="container my-4 border border-dark-subtle rounded-3">



        <div class="p-3">
            <!-- <h1 class="text-secondary fs-3">Similar</h1> -->
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
                                <p class="text-success fs-4 text-center fw-semibold pb-4">{{ $plate->price_digits }}</p>
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
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Plate Details -->



@endsection

@push('scripts')
<script>
    document.querySelector(".toggle-options").addEventListener("click", function() {
        const extraOptions = document.querySelectorAll(".extra");
        const isHidden = extraOptions[0].classList.contains("d-none");

        extraOptions.forEach(opt => {
            opt.classList.toggle("d-none");
        });

        this.textContent = isHidden ? "- {{ __('message.less_options') }}" : "+ {{ __('message.more_options') }}";
    });
    document.getElementById('emirate_id').addEventListener('change', function() {
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
