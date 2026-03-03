@extends('layouts.app')

@section('title', __('message.Search_Results') . ' - ' . config('app.name'))
@section('meta_description', __('message.Search_Meta_Description'))

@section('content')



    <!-- Plate Details -->

    <section class="plate-details">
          <div class="container">
            @include('front.search-form')
        </div>
        <div class="container my-4">

            <div class="p-3">
                <h1 class="text-secondary fs-3 mb-4 text-center">{{ __('message.Search_Results') }}</h1>
                <!-- <h1 class="text-secondary fs-3">Similar</h1> -->
                <div class="pt-5 d-grid">
                    <div class="row">
                        @forelse($plates as $plate)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="listing-item plate-card position-relative">
                                    <!-- <div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div> -->
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="text-left">
                                            <!-- <i class="bx bx-heart fs-4"></i> -->
                                        </div>
                                    </div>
                                    <div class="position-relative plate ">
                                        <div class="w-100 my-4">
                                            <img src="{{ $plate->emirate->image_url }}" alt="car-plate" class="w-100"
                                                loading="lazy">
                                        </div>
                                        @if ($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak')
                                                                <span class="position-absolute {{ $plate->emirate->slug }}-icon fw-semibold">{{
                                            $plate->code->name }}</span>
                                                                <h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal">{{
                                            $plate->number }}</h2>
                                        @else
                                            <div class=" {{ $plate->emirate->slug }}-plate position-absolute d-flex
                                                                                    justify-content-around align-items-center">
                                                <span class="fw-medium">{{ $plate->code->name }}</span>
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

                 {{ $plates->links('pagination::bootstrap-4') }}
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