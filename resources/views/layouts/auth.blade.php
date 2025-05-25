<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>999 | Plate</title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Fearther CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    
    <style>
        .fa-eye-slash:before {
 
    float: inline-end;
    padding-left: 20px;
        }

    </style>
    @endif
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <!-- Header -->
        <!-- <header class="log-header">
            <a href="">
                <h1>999 | Plate</h1>
            </a>
        </header> -->
        <!-- /Header -->

        @yield('content')


        <!-- Footer -->
        <footer class="log-footer">
            <div class="container-fluid">
                <!-- Copyright -->
                <div class="copyright">
                    <div class="copyright-text">
                        <p>© 2025 999 | Plate. All Rights Reserved.</p>
                    </div>
                </div>
                <!-- /Copyright -->
            </div>
        </footer>
        <!-- /Footer -->
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>