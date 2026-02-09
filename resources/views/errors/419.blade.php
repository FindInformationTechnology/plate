@extends('layouts.app')

@section('title', '419 - Page Expired | Plate UAE')

@section('content')
    <div class="error-page-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 text-center">
                    <!-- Error Icon -->
                    <div class="error-icon mb-4">
                        <i class="bx bx-refresh text-primary" style="font-size: 100px;"></i>
                    </div>

                    <!-- Error Content -->
                    <div class="error-content">
                        <h1 class="display-4 fw-bold text-primary mb-3">419</h1>
                        <h2 class="h3 mb-3">{{ app()->getLocale() == 'ar' ? 'انتهت صلاحية الصفحة' : 'Page Expired' }}</h2>
                        <p class="lead text-muted mb-4">
                            {{ app()->getLocale() == 'ar' ? 'عذراً، انتهت صلاحية الجلسة. يرجى تحديث الصفحة والمحاولة مرة أخرى.' : 'Sorry, your session has expired. Please refresh the page and try again.' }}
                        </p>

                        <!-- Navigation Links -->
                        <div class="navigation-links mb-4">
                            <button onclick="window.location.reload()" class="btn btn-primary btn-lg me-3">
                                <i class="bx bx-refresh"></i>
                                {{ app()->getLocale() == 'ar' ? 'تحديث الصفحة' : 'Refresh Page' }}
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="bx bx-home"></i> {{ __('message.Home') }}
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
            display: flex;
            align-items: center;
        }
    </style>
@endsection