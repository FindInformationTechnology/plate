<!-- Header -->
<header class="header header-two">
    <?php if(Route::currentRouteName() == 'home'): ?>
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
    <?php endif; ?>
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

                <?php if(Route::currentRouteName() == 'home'): ?>
                <a href="<?php echo e(route('home')); ?>" class="navbar-brand logo">
                    <img src="<?php echo e(asset ('assets/img/logo-b.png')); ?>" width="145" class="img-fluid" alt="Logo">
                </a>
                <a href="<?php echo e(route('home')); ?>" class="navbar-brand logo-small">
                    <img src="<?php echo e(asset ('assets/img/logo-b.png')); ?>" class="img-fluid" width="145" alt="Logo">
                </a>
                <?php else: ?>
                <a href="<?php echo e(route('home')); ?>" class="navbar-brand logo">
                    <img src="<?php echo e(asset ('assets/img/logo-b.png')); ?>" width="145" class="img-fluid" alt="Logo">
                </a>
                <a href="<?php echo e(route('home')); ?>" class="navbar-brand logo-small">
                    <img src="<?php echo e(asset ('assets/img/logo-b.png')); ?>" class="img-fluid" width="145" alt="Logo">
                </a>
                <?php endif; ?>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <!-- <a href="<?php echo e(route ('home')); ?>" class="menu-logo">
                        <img src="<?php echo e(asset ('assets/img/logo-b.png')); ?>" class="img-fluid" alt="Logo">
                    </a> -->
                    <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                </div>
                <ul class="main-nav">
                    <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('message.Home')); ?></a></li>
                    <li><a href="<?php echo e(route('plates')); ?>"><?php echo e(__('message.Plates')); ?></a></li>


                    <!-- <li><a href="#">Contact</a></li> -->



                    <?php if(auth()->guard()->guest()): ?>
                    <!-- <li class="login-link">
                        <a href="<?php echo e(route('register')); ?>"><?php echo e(__('message.Sign_Up')); ?></a>
                    </li> -->
                    <li class="login-link">
                        <a href="<?php echo e(route('login')); ?>"><?php echo e(__('message.Sign_In')); ?></a>
                    </li>

                    <?php endif; ?>

                    <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->hasRole('user')): ?>
                    <li class="nav-item">
                        <a class="nav-link header-reg" href="<?php echo e(route('user.plates')); ?>">
                            </span><?php echo e(__('message.My_Plates')); ?></a>
                    </li>

                    <?php endif; ?>
                    <?php if(auth()->user()->hasRole('admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link header-reg" href="<?php echo e(route('admin.dashboard')); ?>">
                            <!-- <span><i class="bx bx-plus-circle"></i></span> -->
                            <?php echo e(__('message.Dashboard_Admin')); ?></a>
                    </li>

                   

                    <li class="nav-item">
                        <a class="nav-link header-reg" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form-admin').submit()">
                            <!-- <i class="feather-power"></i>  -->
                            <?php echo e(__('message.Logout')); ?>


                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-none" id="logout-form-admin">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>



                    <!-- user menu -->
                    <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->hasRole('user')): ?>
                    <li class="nav-item d-md-none">
                        <a class="nav-link header-reg" href="<?php echo e(route('user.dashboard')); ?>">
                            <span><i class="bx bx-plus-circle"></i></span>
                            <?php echo e(__('message.My_Dashboard')); ?> </a>
                    </li>

                    <li class="nav-item d-md-none">
                        <a class="nav-link header-reg" href="<?php echo e(route('user.profile')); ?>">
                            <span><i class="bx bx-user"></i></span><?php echo e(__('message.Profile')); ?>

                        </a>
                    </li>
                   

                    <li class="nav-item d-md-none">
                        <a class="nav-link header-reg" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form-admin').submit()">
                            <i class="bx bx-power-off"></i>
                            <?php echo e(__('message.Logout')); ?>


                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-none" id="logout-form-admin">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>

                    <!-- Language Switcher -->
                    <li class="nav-item dropdown d-md-none">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fa fa-globe "></i> <?php echo e(__('message.Language')); ?></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" style="color: #2F2F2F;"
                                    href="<?php echo e(route('change.language', 'en')); ?>">
                                    <?php echo e(__('message.English')); ?>

                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" style="color: #2F2F2F;"
                                    href="<?php echo e(route('change.language', 'ar')); ?>">
                                    <?php echo e(__('message.Arabic')); ?>

                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- /Language Switcher -->

                </ul>
            </div>


            <ul class="nav header-navbar-rht">



                <!-- Add language switcher for right side as well -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0);" id="language-dropdown" data-bs-toggle="dropdown">
                        <i class="fa fa-globe"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?php echo e(route('change.language', 'en')); ?>">
                            <?php echo e(__('message.English')); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('change.language', 'ar')); ?>">
                            <?php echo e(__('message.Arabic')); ?>

                        </a>
                    </div>
                </li>

                <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item">
                    <a class="nav-link login-link" href="<?php echo e(route('login')); ?>"><span><i class="bx bx-user me-2"></i></span><?php echo e(__('message.Sign_In')); ?>  </a>
                    <?php if(Route::has('register') ): ?>
                    <!-- <a class="nav-link login-link ms-1" href="<?php echo e(route('register')); ?>"><?php echo e(__('message.Register')); ?> </a> -->
                    <?php endif; ?>


                </li>


                <?php endif; ?>


                <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->hasRole('user')): ?>


                <!-- Notifications -->
                <li class="nav-item dropdown logged-item noti-nav noti-wrapper">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="bell-icon"><img src="<?php echo e(asset ('assets/img/icons/bell-icon.svg')); ?>" alt="Bell"></span>
                        <span class="badge badge-pill"></span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title"><?php echo e(__('message.Notifications')); ?></span>
                            <a href="javascript:void(0)" class="clear-noti"> <?php echo e(__('message.Clear_All')); ?> </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-lg flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="<?php echo e(asset('assets/img/profiles/avatar-01.jpg')); ?>">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Jonathan Doe </span> <?php echo e(__('message.has_booked')); ?> <span class="noti-title"><?php echo e(__('message.your_service')); ?></span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#"><?php echo e(__('message.View_all_Notifications')); ?></a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow logged-item">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="<?php echo e(asset ('assets/img/profiles/avatar-14.jpg')); ?>" alt="Profile">
                        </span>
                        <?php if(Route::currentRouteName() == 'home'): ?>
                        <span class="user-text" style="color: #fff;"><?php echo e(auth()->user()->name); ?></span>
                        <?php else: ?>
                        <span class="user-text" style="color: black;"><?php echo e(auth()->user()->name); ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?php echo e(route('user.dashboard')); ?>">
                            <i class="feather-settings"></i> <?php echo e(__('message.Dashboard')); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>">
                            <i class="feather-user-check"></i> <?php echo e(__('message.Profile')); ?>

                        </a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit()">
                            <i class="feather-power"></i> <?php echo e(__('message.Logout')); ?>


                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-none" id="logout-form">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
                <!-- /User Menu -->
                <?php endif; ?>

                <?php endif; ?>

            </ul>
        </nav>
    </div>
</header>
<!-- /Header --><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/layouts/header.blade.php ENDPATH**/ ?>