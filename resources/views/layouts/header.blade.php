<!-- Header -->
<header class="header header-two">
    @if(Route::currentRouteName() == 'home')
    <div class="header-two-top">
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
    </div>
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
                    <img src="{{  asset ('assets/img/logo-2.svg')}}" class="img-fluid" alt="Logo">
                </a>
                <a href="{{ route('home')}}" class="navbar-brand logo-small">
                    <img src="{{  asset ('assets/img/logo-small.png')}}" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ route ('home') }}" class="menu-logo">
                        <img src="{{  asset ('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                </div>
                <ul class="main-nav">
                    <li><a href="{{ route('home')}}">Home</a></li>
                    <li><a href="{{ route('home')}}">Plates</a></li>
                    
                    
                    <li><a href="contact-us.html">Contact</a></li>
                    <li class="login-link">
                        <a href="{{ route('register') }}">Sign Up</a>
                    </li>
                    <li class="login-link">
                        <a href="{{ route('login') }}">Sign In</a>
                    </li>
                </ul>
            </div>
            <ul class="nav header-navbar-rht">
                <li class="nav-item">
                    <a class="nav-link login-link" href="{{ route('login') }}"><span><i class="bx bx-user me-2"></i></span>Sign In / </a>
                    <a class="nav-link login-link ms-1" href="{{ route('register') }}">Register </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link header-reg" href="listing-list.html"><span><i class="bx bx-plus-circle"></i></span>Add Listing</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<!-- /Header -->