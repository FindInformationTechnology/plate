<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RW30DCWP1K"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-RW30DCWP1K');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- SEO Meta Tags -->
    <title><?php echo $__env->yieldContent('title', config('app.name') . ' - Premium UAE License Plates'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', __('message.Home_Meta_Description')); ?>">
    <meta name="keywords"
        content="UAE license plates, Dubai number plates, Abu Dhabi plates, car plates, vehicle registration, premium plates, <?php echo $__env->yieldContent('keywords', ''); ?>">
    <meta name="author" content="<?php echo e(config('app.name')); ?>">
    <meta name="robots" content="<?php echo $__env->yieldContent('robots', 'index, follow'); ?>">
    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', request()->url()); ?>">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', config('app.name') . ' - Premium UAE License Plates'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', __('message.Home_Meta_Description')); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('assets/img/og-image.jpg')); ?>">
    <meta property="og:url" content="<?php echo $__env->yieldContent('og_url', request()->url()); ?>">
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
    <meta property="og:locale" content="<?php echo e(app()->getLocale() == 'ar' ? 'ar_AE' : 'en_US'); ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', config('app.name') . ' - Premium UAE License Plates'); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description', __('message.Home_Meta_Description')); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('twitter_image', asset('assets/img/og-image.jpg')); ?>">

    <!-- Language Alternatives -->
    <link rel="alternate" hreflang="en" href="<?php echo e(url('/')); ?>">
    <link rel="alternate" hreflang="ar" href="<?php echo e(url('/lang/ar')); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo e(url('/')); ?>">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AutoPartsStore",
        "name": "<?php echo e(config('app.name')); ?>",
        "description": "<?php echo e(__('message.Home_Meta_Description')); ?>",
        "url": "<?php echo e(url('/')); ?>",
        "logo": "<?php echo e(asset('assets/img/logo.webp')); ?>",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "AE",
            "addressRegion": "Dubai"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "url": "<?php echo e(route('contact')); ?>"
        },
        "sameAs": [
            "<?php echo $__env->yieldContent('social_links', ''); ?>"
        ]
    }
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WZ8WB8CV');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon and Touch Icons -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon-16x16.png')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('/site.webmanifest')); ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" as="style">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome/css/fontawesome.min.css')); ?>" media="print"
        onload="this.media='all'">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome/css/all.min.css')); ?>" media="print"
        onload="this.media='all'">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fancybox/fancybox.css')); ?>" media="print"
        onload="this.media='all'">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>">

    <!-- Datepicker CSS -->
    <!-- <link rel="stylesheet" href="<?php echo e(asset ('assets/css/bootstrap-datetimepicker.min.css')); ?>"> -->

    <!-- Aos CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/aos/aos.css')); ?>">

    <!-- Fearther CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/feather.css')); ?>">

    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/boxicons/css/boxicons.min.css')); ?>">

    <!-- Owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.carousel.min.css')); ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" as="style">

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- <link rel="stylesheet" href="<?php echo e(asset ('assets/css/addition-styles.css')); ?>"> -->

    <?php echo $__env->yieldPushContent('styles'); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->getLocale() === 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">

        <style>
            .fa-eye-slash:before {

                float: inline-end;
                padding-left: 20px;
            }

            .header .main-menu-wrapper .main-nav>li a i {

                margin-left: 10px;
            }
        </style>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


</head>



<div id="page-transition-overlay" class="hidden">
    <img src="<?php echo e(asset('assets/img/logo-b.png')); ?>" alt="Logo" />
</div>

<body class="home-two">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ8WB8CV" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->



    <div class="main-wrapper">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::currentRouteName() == 'home'): ?>
            <!-- Hero Sec Main -->
            <div class="hero-sec-main">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasRole('user')): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty(auth()->user()->phone) || empty(auth()->user()->whatsapp)): ?>
                        <?php echo $__env->make('partials._alert_compliation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Dashboard Menu -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!Route::currentRouteName() == 'home'): ?>
                    <?php echo $__env->make('partials._dashboard_menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <!-- /Dashboard Menu -->
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>

            <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


        </div>

        <!-- scrollToTop start -->
        <div class="progress-wrap active-progress">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                    style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;">
                </path>
            </svg>
        </div>
        <!-- scrollToTop end -->


        <!-- jQuery -->
        <script src="<?php echo e(asset('assets/js/jquery-3.7.1.min.js')); ?>"></script>

        <!-- Bootstrap Core JS -->
        <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>" defer></script>

        <!-- counterup JS -->
        <script src="<?php echo e(asset('assets/js/jquery.waypoints.js')); ?>" defer></script>
        <script src="<?php echo e(asset('assets/js/jquery.counterup.min.js')); ?>" defer></script>

        <!-- Select2 JS -->
        <script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>" defer></script>

        <!-- Aos -->
        <script src="<?php echo e(asset('assets/plugins/aos/aos.js')); ?>" defer></script>

        <!-- Top JS -->
        <script src="<?php echo e(asset('assets/js/backToTop.js')); ?>" defer></script>

        <!-- Fancybox JS -->
        <script src="<?php echo e(asset('assets/plugins/fancybox/fancybox.umd.js')); ?>" defer></script>

        <!-- Datepicker Core JS -->
        <script src="<?php echo e(asset('assets/plugins/moment/moment.min.js')); ?>" defer></script>
        <script src="<?php echo e(asset('assets/js/bootstrap-datetimepicker.min.js')); ?>" defer></script>

        <!-- Owl Carousel JS -->
        <script src="<?php echo e(asset('assets/js/owl.carousel.min.js')); ?>"></script>

        <!-- Custom JS -->
        <script src="<?php echo e(asset('assets/js/script.js')); ?>" defer></script>


        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            // Add this to your main layout file
            document.addEventListener('DOMContentLoaded', function () {
                // Check if user is already logged in but gets a 419 error
                if (document.referrer.includes('419')) {
                    // Redirect to dashboard or home page
                    window.location.href = '<?php echo e(route("home")); ?>';
                }
            });

            // page loader
            const links = document.querySelectorAll(".nav-link:not([data-bs-toggle])");
            const overlay = document.getElementById("page-transition-overlay");

            links.forEach(link => {
                link.addEventListener("click", function (e) {
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
                    }

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
            <?php if(Session::has('success')): ?>
                toastr.success("<?php echo e(Session::get('success')); ?>");
            <?php endif; ?>

            <?php if(Session::has('error')): ?>
                toastr.error("<?php echo e(Session::get('error')); ?>");
            <?php endif; ?>

            <?php if(Session::has('info')): ?>
                toastr.info("<?php echo e(Session::get('info')); ?>");
            <?php endif; ?>

            <?php if(Session::has('warning')): ?>
                toastr.warning("<?php echo e(Session::get('warning')); ?>");
            <?php endif; ?>
        </script>



        <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\Users\dell\Desktop\plate\resources\views/layouts/app.blade.php ENDPATH**/ ?>