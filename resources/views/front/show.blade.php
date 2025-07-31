@extends('layouts.app')

@push('styles')
<style>
/* Reduce text size for plate code and number on this page only */
.plate h1 {
    font-size: 0.9em !important;
}

.plate h2 {
    font-size: 0.8em !important;
}
</style>
@endpush

@section('content')


<!-- Plate Details -->

<section class="plate-details container d-flex align-items-center gap-5">
    <div class="container">
        <div class="my-5 p-4 bg-white shadow-lg rounded" style="background-color: #e7eaef">
            <div class="w-100">
                <div class="position-relative plate big-plate">
                    <div class="w-100">
                        <img src="{{ $plate->emirate->image_url }}" alt="car-plate" class="w-100" loading="lazy">
                    </div>
                    @if ($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak')
                    <h1 class="position-absolute {{ $plate->emirate->slug }}-icon fw-semibold main-shadow">{{
                        $plate->code->name }}</h1>
                    <h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal main-shadow">{{ $plate->number }}</h2>
                    @else
                    <div class=" {{ $plate->emirate->slug }}-plate position-absolute d-flex justify-content-around
                        align-items-center">
                        <h1 class="fw-medium main-shadow">{{ $plate->code->name }}</h1>
                        <h2 class="fw-medium main-shadow">{{ $plate->number }}</h2>
                    </div>
                    @endif
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-between align-items-center pb-2">
                    <div>
                        <h1 class="price py-2 fs-1 fw-normal">
                            {{ $plate->price_digits }}
                        </h1>
                        <p class="text-secondary fs-6 mb-2">
                            <i class="fa fa-eye me-1" aria-hidden="true"></i> {{ $plate->views_count }} {{ __('message.Views') }}
                        </p>
                    
                        <div class="alert alert-warning mt-2">
                            <ul class="icons list-unstyled mb-0">
                                <li class="mb-1">
                                    <i class="fa fa-credit-card me-2" aria-hidden="true"></i>
                                    {{ app()->getLocale() == 'ar' ? 'لا تقم بتحويل المال مباشرة' : 'Do not transfer money directly' }}
                                </li>
                                <li>
                                    <i class="fa fa-handshake me-2" aria-hidden="true"></i>
                                    {{ app()->getLocale() == 'ar' ? 'قابل البائع شخصيا' : 'Meet the seller in person' }}
                                </li>
                            </ul>
                        </div>
                    </div>

                  
                    <!-- <div>
                        <i class="bx bx-heart fs-2"></i>
                    </div> -->
                </div>
                <div class="d-flex flex-column flex-md-row align-items-center gap-3 mt-2 text-center contact-button">
                    <a href="tel:{{ $plate->user->phone_number ?? '' }}"
                        class="contact d-flex align-items-center justify-content-center gap-2 py-2 w-100 flex-md-grow-1 rounded-2"
                        target="_blank"><i class="bx bx-phone fs-5"></i>
                        <p>{{ $plate->user->phone_number }}</p>
                    </a>
                    @isset($plate->user->whatsapp_number)
                    <a href="https://wa.me/{{ $plate->user->whatsapp_number ?? '' }}"
                        class="whatsapp d-flex align-items-center justify-content-center gap-2 py-2 w-100 flex-md-grow-1 rounded-2"
                        target="_blank"><i class="bx bxl-whatsapp fs-5"></i>
                        <p>{{ $plate->user->whatsapp_number ?? '' }}</p>
                    </a>
                    @endisset
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-secondary fs-3">{{ __('message.Related_By_Emirate') }}</h1>
            <div class="pt-3 d-grid">
                <div class="row">
                    @foreach($relatedByEmirate as $plate)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="listing-item plate-card position-relative">
                            <!-- <div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div> -->
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="text-left"><i class="bx bx-heart fs-4"></i></div>
                            </div>
                            <div class="position-relative plate">
                                <div class="w-100 my-4">
                                    <img src="{{ $plate->emirate->image_url }}" alt="car-plate" class="w-100"
                                        loading="lazy">
                                </div>
                                @if ($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak')
                                <h1 class="position-absolute {{ $plate->emirate->slug }}-icon fw-semibold main-shadow">{{
                                    $plate->code->name }}</h1>
                                <h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal main-shadow">{{
                                    $plate->number }}</h2>
                                @else
                                <div class=" {{ $plate->emirate->slug }}-plate position-absolute d-flex
                                    justify-content-around align-items-center">
                                    <h1 class="fw-medium main-shadow">{{ $plate->code->name }}</h1>
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
                                        class="bx bx-phone text-[20px]"></i>
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
