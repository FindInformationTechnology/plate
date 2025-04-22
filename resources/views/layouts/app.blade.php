<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title> {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset ('assets/img/favicon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/bootstrap.min.css')}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fontawesome/css/all.min.css')}}">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fancybox/fancybox.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/select2/css/select2.min.css')}}">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/bootstrap-datetimepicker.min.css')}}">

    <!-- Aos CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/aos/aos.css')}}">

    <!-- Fearther CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/feather.css')}}">

    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/boxicons/css/boxicons.min.css')}}">

    <!-- Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/owl.carousel.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/style.css')}}">

</head>

<body class="home-two">

    <div class="main-wrapper">

        @if(Route::currentRouteName() == 'home')
        <!-- Hero Sec Main -->
            <div class="hero-sec-main">
        @endif
        <!-- Header -->

        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')
    

    </div>

    <!-- scrollToTop start -->
    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;"></path>
        </svg>
    </div>
    <!-- scrollToTop end -->


    <!-- jQuery -->
    <script src="{{ asset ('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset ('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- counterup JS -->
    <script src="{{ asset ('assets/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset ('assets/js/jquery.counterup.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset ('assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Aos -->
    <script src="{{ asset ('assets/plugins/aos/aos.js') }}"></script>

    <!-- Top JS -->
    <script src="{{ asset ('assets/js/backToTop.js') }}"></script>

    <!-- Fancybox JS -->
    <script src="{{ asset ('assets/plugins/fancybox/fancybox.umd.js') }}"></script>

    <!-- Datepicker Core JS -->
    <script src="{{ asset ('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset ('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Owl Carousel JS -->
    <script src="{{ asset ('assets/js/owl.carousel.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset ('assets/js/script.js') }}"></script>

</body>

</html>