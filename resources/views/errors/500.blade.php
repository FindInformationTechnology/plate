@extends('layouts.app')

@section('title', '500 - Internal Server Error | Plate UAE')
@section('meta_description', 'Something went wrong on our end. Please try again later.')

@section('content')
    <div class="error-page-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 text-center">
                    <!-- Error Image/Icon -->
                    <div class="error-image mb-4">
                        <img src="{{ asset('assets/img/500.png') }}" alt="500 Error" class="img-fluid"
                            style="max-width: 300px;">
                    </div>

                    <!-- Error Content -->
                    <div class="error-content">
                        <h1 class="display-4 fw-bold text-primary mb-3">500</h1>
                        <h2 class="h3 mb-3">
                            {{ app()->getLocale() == 'ar' ? 'خطأ داخلي في الخادم' : 'Internal Server Error' }}</h2>
                        <p class="lead text-muted mb-4">
                            {{ app()->getLocale() == 'ar' ? 'عذراً، حدث خطأ ما في الخادم. يرجى المحاولة مرة أخرى لاحقاً.' : 'Oops! Something went wrong on our end. Please try again later.' }}
                        </p>

                        <!-- Navigation Links -->
                        <div class="navigation-links mb-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                                <i class="bx bx-home"></i> {{ __('message.Home') }}
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="bx bx-phone"></i> {{ __('message.Contact_Us') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .error-page-container {
            min-height: 60vh;
            background: linear-gradient(135deg, #f8d7da 0%, #dc3545 100%);
            color: #842029;
        }

        .error-content h1,
        .error-content h2 {
            color: #842029;
        }

        .error-image img {
            opacity: 0.8;
        }

        .navigation-links .btn {
            margin-bottom: 10px;
        }
    </style>
@endsection