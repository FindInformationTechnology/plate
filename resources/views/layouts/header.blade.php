<!-- Header -->
<header class="header header-two">
    @if(Route::currentRouteName() == 'home')
    <!-- <div class="header-two-top">
        <div class="container">
            <div class="header-top-items">
                <ul class="header-address">
                    <li><span><i class="bx bxs-phone"></i></span>(+088) 123 456 7890</li>
                    <li><span><i class="bx bx-map"></i></span>5617 Glassford Street New York, NY 10000, USA</li>
                </ul>
                <div class="header-top-right d-flex align-items-center">
                    <div class="header-top-flag-drops d-flex align-items-center">
                        <div class="header-top-drpodowns me-3">
                            <div class="dropdown header-dropdown country-flag">
                                <a class="dropdown-toggle nav-tog" data-bs-toggle="dropdown" href="javascript:void(0);">
                                    <img src="assets/img/flags/us.png" alt="Img">English
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <img src="assets/img/flags/fr.png" alt="Img">French
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <img src="assets/img/flags/es.png" alt="Img">Spanish
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <img src="assets/img/flags/de.png" alt="Img">German
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="header-top-drpodowns">
                            <div class="dropdown header-dropdown country-flag">
                                <a class="dropdown-toggle nav-tog" data-bs-toggle="dropdown" href="javascript:void(0);">
                                    <i class="bx bx-globe me-2"></i>USD
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        Euro
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        INR
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-top-social-links">
                        <ul>
                            <li>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-behance"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    @endif
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home')}}" class="navbar-brand logo">
                    <img src="{{  asset ('assets/img/logo.png')}}" class="img-fluid" alt="Logo">
                </a>
                <a href="{{ route('home')}}" class="navbar-brand logo-small">
                    <img src="{{  asset ('assets/img/logo-small.png')}}" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ route ('home') }}" class="menu-logo">
                        <img src="{{  asset ('assets/img/logo.png')}}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                </div>
                <ul class="main-nav">
                    <li><a href="{{ route('home')}}">Home</a></li>
                    <li><a href="{{ route('plates')}}">Plates</a></li>


                    <li><a href="#">Contact</a></li>

                   

                    @guest
                    <li class="login-link">
                        <a href="{{ route('register') }}">Sign Up</a>
                    </li>
                    <li class="login-link">
                        <a href="{{ route('login') }}">Sign In</a>
                    </li>

                    @endguest

                    @auth
                    @if(auth()->user()->hasRole('user'))
                    <li class="nav-item">
                        <a class="nav-link header-reg" href="{{ route('user.plates') }}">
                            </span>My Plates</a>
                    </li>

                    @endif
                    @if(auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link header-reg" href="{{ route('admin.dashboard') }}">
                            <span><i class="bx bx-plus-circle"></i></span>Dashboard Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link header-reg" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form-admin').submit()">
                            <i class="feather-power"></i> Logout

                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form-admin">
                            @csrf
                        </form>
                    </li>
                    @endif
                    @endauth

                     <!-- Language Switcher -->
                     <li class="nav-item dropdown d-md-none"">
                        <a class="nav-link dropdown-toggle" href="#"> <i class="fa fa-globe"></i></a>
                        <ul class="dropdown-menu"  >
                            <li>
                                <a class="dropdown-item" style="color: #2F2F2F;"
                                 href="{{ route('change.language', 'en') }}">
                                    English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" style="color: #2F2F2F;"
                                 href="{{ route('change.language', 'ar') }}">
                                    العربية
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- /Language Switcher -->
                </ul>
            </div>


            <ul class="nav header-navbar-rht">

               
               
                <!-- Add language switcher for right side as well -->
                <li class="nav-item dropdown d-none d-md-block">
                    <a class="nav-link" href="javascript:void(0);" id="language-dropdown" data-bs-toggle="dropdown">
                        <i class="fa fa-globe"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('change.language', 'en') }}">
                            English
                        </a>
                        <a class="dropdown-item" href="{{ route('change.language', 'ar') }}">
                            العربية
                        </a>
                    </div>
                </li>

                @guest
                <li class="nav-item">
                    <a class="nav-link login-link" href="{{ route('login') }}"><span><i class="bx bx-user me-2"></i></span>Sign In / </a>
                    @if(Route::has('register') )
                    <a class="nav-link login-link ms-1" href="{{ route('register') }}">Register </a>
                    @endif

                    
                </li>


                @endguest


                @auth
                @if(auth()->user()->hasRole('user'))
                <!-- Notifications -->
                <li class="nav-item dropdown logged-item noti-nav noti-wrapper">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="bell-icon"><img src="{{ asset ('assets/img/icons/bell-icon.svg') }}" alt="Bell"></span>
                        <span class="badge badge-pill"></span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-lg flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="{{ asset('assets/img/profiles/avatar-01.jpg')}}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Jonathan Doe </span> has booked <span class="noti-title">your service</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow logged-item">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{  asset ('assets/img/profiles/avatar-14.jpg') }}" alt="Profile">
                        </span>
                        @if (Route::currentRouteName() == 'home')
                        <span class="user-text" style="color: #fff;">{{ auth()->user()->name }}</span>
                        @else
                        <span class="user-text" style="color: black;">{{ auth()->user()->name }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                            <i class="feather-settings"></i> Dashboard
                        </a>
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                            <i class="feather-user-check"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit()">
                            <i class="feather-power"></i> Logout

                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- /User Menu -->
                @endif

                @endauth

            </ul>
        </nav>
    </div>
</header>
<!-- /Header -->