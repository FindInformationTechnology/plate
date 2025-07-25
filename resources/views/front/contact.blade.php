@extends('layouts.app')

@section('content')

<!-- Banner Section -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">{{ __('message.Contact_Us') }}</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">{{ __('message.Home') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('message.Contact_Us') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<!-- Contact Form + Info -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <!-- Form -->
        <div>
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">{{ __('message.Send_Us_Message') }}</h2>
            <form method="POST" class="space-y-5">
                @csrf
                <input type="text" name="name" placeholder="{{ __('message.Your_Name') }}" class="form-control rounded-md" required>
                <input type="email" name="email" placeholder="{{ __('message.Your_Email') }}" class="form-control rounded-md" required>
                <textarea name="message" rows="5" placeholder="{{ __('message.Your_Message') }}" class="form-control rounded-md resize-none" required></textarea>
                <button type="submit" class="bg-[#ac1e23] text-white px-6 py-2 rounded hover:bg-red-700">
                    {{ __('message.Send_Message') }}
                </button>
            </form>
        </div>

        <!-- Info -->
        <div class="space-y-6 text-lg text-gray-700">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">{{ __('message.Contact_Details') }}</h2>
            <div class="flex items-start gap-3">
                <i class='bx bx-map text-2xl text-[#ac1e23]'></i>
                <div>
                    <p class="font-semibold">{{ __('message.Address') }}</p>
                    <p>{{ __('message.Location') }}</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <i class='bx bx-phone text-2xl text-[#ac1e23]'></i>
                <div>
                    <p class="font-semibold">{{ __('message.Phone') }}</p>
                    <p>+971  050 551 5131</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <i class='bx bx-envelope text-2xl text-[#ac1e23]'></i>
                <div>
                    <p class="font-semibold">{{ __('message.Email') }}</p>
                    <p>info@plate35.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="w-full h-[400px]">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.729477826438!2d55.270782!3d25.204849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f434c3c36b715%3A0x4b3df2c9c1a1b76a!2sDubai%20Mall!5e0!3m2!1sen!2sae!4v1719777098254"
        width="100%"
        height="100%"
        style="border:0;"
        allowfullscreen=""
        loading="lazy">
    </iframe>
</section>

<!-- Quick Contact CTA -->
<section class="bg-[#ff696e41] text-white py-16 text-center">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold mb-4">{{ __('message.Quick_Help') }}</h2>
        <p class="text-lg mb-6">{{ __('message.Contact_Us_Subtitle') }}</p>
        <a href="tel:+971 050 551 5131" class="bg-white text-[#ac1e23] px-6 py-3 rounded shadow hover:bg-gray-200 transition">
            {{ __('message.Call_Us_Now') }}
        </a>
    </div>
</section>

@endsection
