@extends('layouts.app')

@section('title', $plate->emirate->name . ' ' . $plate->code->name . ' ' . $plate->number . ' - ' . config('app.name'))
@section('meta_description', __('message.Buy') . ' ' . $plate->emirate->name . ' ' . __('message.plate') . ' ' . $plate->code->name . ' ' . $plate->number . ' ' . __('message.for') . ' ' . $plate->price_digits . '. ' . __('message.Home_Meta_Description'))

@push('styles')
    <style>
        /* Reduce text size for plate code and number on this page only */
        .plate h1 {
            /* font-size: 0.9em !important; */
        }

        .plate h2 {
            /* font-size: 0.8em !important; */
        }

        /* Custom width utility for md+ screens */
        @media (min-width: 768px) {
            .w-md-50 {
                width: 50% !important;
            }
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
                                        <span class="position-absolute {{ $plate->emirate->slug }}-icon fw-semibold main-shadow">{{
                            $plate->code->name }}</span>
                                        <h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal main-shadow">
                                            {{ $plate->number }}</h2>
                        @else
                            <div class=" {{ $plate->emirate->slug }}-plate position-absolute d-flex justify-content-around
                                align-items-center ltr-content">
                                <span class="fw-medium main-shadow">{{ $plate->code->name }}</span>
                                <h2 class="fw-medium main-shadow">{{ $plate->number }}</h2>
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <!-- Price & Details Section -->
                    <div class="mb-4">
                        <!-- Price Display -->
                        <div class="my-3 d-flex justify-content-between align-items-center">
                            <div class="price mb-0 fw-bold text-dark" style="font-size: 1.3rem; letter-spacing: -0.5px;">
                                {{ $plate->price_digits }}
                            </div>
                            <p class="mb-0 d-flex align-items-center gap-2" style="opacity: 0.6;">
                                <i class="fa fa-eye " aria-hidden="true"></i>
                                <span class="fw-medium">{{ $plate->views_count }}</span>
                                <span>{{ __('message.Views') }}</span>
                            </p>
                        </div>

                        <!-- Safety Tips Box -->
                        <div class="bg-light border border-secondary border-opacity-25 rounded-3 p-3 mt-3">
                            <div class="d-flex align-items-start gap-2 mb-2">
                                <i class="fa fa-shield-alt text-primary mt-1"></i>
                                <h6 class="mb-0 fw-semibold text-dark">
                                    {{ app()->getLocale() == 'ar' ? 'نصائح السلامة' : 'Safety Tips' }}</h6>
                            </div>
                            <ul class="list-unstyled mb-0 ms-4">
                                <li class="mb-2 text-secondary small d-flex align-items-start gap-2">
                                    <i class="fa fa-check-circle text-success mt-1" style="font-size: 0.875rem;"></i>
                                    <span>{{ app()->getLocale() == 'ar' ? 'لا تقم بتحويل المال مباشرة' : 'Do not transfer money directly' }}</span>
                                </li>
                                <li class="text-secondary small d-flex align-items-start gap-2">
                                    <i class="fa fa-check-circle text-success mt-1" style="font-size: 0.875rem;"></i>
                                    <span>{{ app()->getLocale() == 'ar' ? 'قابل البائع شخصيا' : 'Meet the seller in person' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Buttons -->
                    <div class="d-flex flex-column flex-md-row gap-3">
                        @isset($plate->user->phone_number)
                            <a href="tel:{{ $plate->user->phone_number ?? '' }}"
                                class="btn btn-outline-dark d-flex align-items-center justify-content-center gap-2 py-3 w-100 @if(!isset($plate->user->whatsapp_number)) w-md-50 @endif rounded-3 fw-medium"
                                style="border-width: 2px;">
                                <i class="bx bx-phone fs-5"></i>
                                <span class="dir-ltr">{{ $plate->user->phone_number }}</span>
                            </a>
                        @endisset
                        @isset($plate->user->whatsapp_number)
                            <a href="https://wa.me/{{ $plate->user->whatsapp_number ?? '' }}"
                                class="btn btn-success d-flex align-items-center justify-content-center gap-2 py-3 w-100 rounded-3 @if(!isset($plate->user->phone_number)) w-md-50 @endif fw-medium"
                                target="_blank">
                                <i class="bx bxl-whatsapp fs-5"></i>
                                <span class="dir-ltr">{{ $plate->user->whatsapp_number ?? '' }}</span>
                            </a>
                        @endisset
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="yacht-offer-sec relative bg-slate-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="section-header-two">
                <h2 class="text-2xl font-bold mb-6">{{ __('message.Related_By_Emirate') }}</h2>
            </div>
            <div class="pt-3 d-grid">
                <div class="row">
                    @foreach($relatedByEmirate as $plate)
                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
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
                                                        <span class="position-absolute {{ $plate->emirate->slug }}-icon fw-semibold main-shadow">{{
                                        $plate->code->name }}</span>
                                                        <h2 class="position-absolute {{ $plate->emirate->slug }}-number fw-normal main-shadow">{{
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

    </section>

    <!-- Plate Details -->


@endsection