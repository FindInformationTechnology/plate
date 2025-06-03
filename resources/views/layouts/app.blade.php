<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title> {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset ('assets/img/favicon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/bootstrap.min.css')}}" as="style">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fontawesome/css/fontawesome.min.css')}}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fontawesome/css/all.min.css')}}" media="print" onload="this.media='all'">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fancybox/fancybox.css')}}" media="print" onload="this.media='all'">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/select2/css/select2.min.css')}}">

    <!-- Datepicker CSS -->
    <!-- <link rel="stylesheet" href="{{ asset ('assets/css/bootstrap-datetimepicker.min.css')}}"> -->

    <!-- Aos CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/aos/aos.css')}}">

    <!-- Fearther CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/feather.css')}}">

    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/boxicons/css/boxicons.min.css')}}">

    <!-- Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/owl.carousel.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/style.css')}}" as="style">

    <link rel="stylesheet" href="{{ asset ('assets/css/edition.css') }}">

    <!-- <link rel="stylesheet" href="{{ asset ('assets/css/addition-styles.css') }}"> -->



    <style>
        .hero-sec-main .header-two {
            background-color: #FFF;
        }

        .hero-sec-main .header-two.header-fixed {
            background-color: #FFF;
        }

        .dashboard-section {
            background: none;
            box-shadow: none;
        }

        .header .header-navbar-rht .has-arrow .dropdown-toggle .user-text {
            color: #FFF;
        }

        .header .main-menu-wrapper .main-nav>li a i {
            float: left;
            margin-right: 10px;
        }

        .navbar .fa-globe:before {
            color: #AC1E23;
        }
    </style>

    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">

    <style>
        .fa-eye-slash:before {

            float: inline-end;
            padding-left: 20px;
        }

        .header .main-menu-wrapper .main-nav>li a i {

            margin-left: 10px;
        }
    </style>
    @endif


</head>

<div id="page-transition-overlay" class="hidden">
    <img src="{{ asset('assets/img/logo-b.png') }}" alt="Logo" />
</div>

<body class="home-two">

    <div class="main-wrapper">

        @if(Route::currentRouteName() == 'home')
        <!-- Hero Sec Main -->
        <div class="hero-sec-main">
            @endif


            @include('layouts.header')

            @auth
            <!-- Dashboard Menu -->
            @if(!Route::currentRouteName() == 'home')
            @include('partials._dashboard_menu')
            @endif
            <!-- /Dashboard Menu -->
            @endauth

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
        <script src="{{ asset ('assets/js/bootstrap.bundle.min.js') }}" defer></script>

        <!-- counterup JS -->
        <script src="{{ asset ('assets/js/jquery.waypoints.js') }}" defer></script>
        <script src="{{ asset ('assets/js/jquery.counterup.min.js') }}" defer></script>

        <!-- Select2 JS -->
        <script src="{{ asset ('assets/plugins/select2/js/select2.min.js') }}" defer></script>

        <!-- Aos -->
        <script src="{{ asset ('assets/plugins/aos/aos.js') }}" defer></script>

        <!-- Top JS -->
        <script src="{{ asset ('assets/js/backToTop.js') }}" defer></script>

        <!-- Fancybox JS -->
        <script src="{{ asset ('assets/plugins/fancybox/fancybox.umd.js') }}" defer></script>

        <!-- Datepicker Core JS -->
        <script src="{{ asset ('assets/plugins/moment/moment.min.js') }}" defer></script>
        <script src="{{ asset ('assets/js/bootstrap-datetimepicker.min.js') }}" defer></script>

        <!-- Owl Carousel JS -->
        <script src="{{ asset ('assets/js/owl.carousel.min.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{ asset ('assets/js/script.js') }}" defer></script>


        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            // Add this to your main layout file
            document.addEventListener('DOMContentLoaded', function() {
                // Check if user is already logged in but gets a 419 error
                if (document.referrer.includes('419')) {
                    // Redirect to dashboard or home page
                    window.location.href = '{{ route("home") }}';
                }
            });

            // page loader
            const links = document.querySelectorAll(".nav-link:not([data-bs-toggle])");
            const overlay = document.getElementById("page-transition-overlay");

            links.forEach(link => {
                        link.addEventListener("click", function(e) {
                                e.preventDefault();
                                // Only apply to links with actual URLs, not javascript:void(0)
                                if (this.getAttribute("href") && !this.getAttribute("href").includes("javascript:")) {
                                    e.preventDefault();
                                    const href = this.getAttribute("href");

                                    overlay.classList.remove("hidden");
                                    overlay.classList.add("show");

                                    setTimeout(() => {
                                        overlay.classList.add("start-grow");
                                    }, 200);

                                    setTimeout(() => {
                                        overlay.classList.add("hide-logo");
                                    }, 1000);

                                    setTimeout(() => {
                                        window.location.href = href;
                                    }, 1000);

                                });
                        });
        </script>


        <script>
            // Configure toastr options
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Display flash messages from session
            @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
            @endif

            @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
            @endif

            @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
            @endif

            @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
            @endif
        </script>



        @stack('scripts')

</body>

</html>