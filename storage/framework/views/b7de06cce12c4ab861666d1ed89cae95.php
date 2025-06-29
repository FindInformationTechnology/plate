<?php $__env->startSection('content'); ?>

<style>
    .featured-plates-slider .owl-nav {
        position: absolute;
        top: -50px;
        right: 0;
    }

    .featured-plates-slider .owl-nav button {
        width: 30px;
        height: 30px;
        background-color: #f5f5f5 !important;
        border-radius: 50%;
        margin-left: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .featured-plates-slider .owl-nav button:hover {
        background-color: #28a745 !important;
        color: white;
    }

    .featured-plates-slider .item {
        padding: 10px;
    }
</style>


<!-- Banner -->
<section class="banner-section banner-sec-two banner-slider">
    <div class="banner-img-slider owl-carousel" style="direction: ltr;">
        <!-- <div class="slider-img">
            <img src="assets/img/owl-2.jpg" alt="Img" loading="lazy">
        </div> -->
        <div class="slider-img">
            <img src="assets/img/owl-1.jpg" alt="Img" loading="lazy">
        </div>
        <div class="slider-img">
            <img src="assets/img/owl-3.jpg" alt="Img" loading="lazy">
        </div>
    </div>
    <div class="container">
        <div class="home-banner">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="hero-sec-contents">
                        <div class="banner-title">
                            <h1 class="text-[35px] md:text-[65px]"><?php echo e(__('message.Premium_UAE_Plates')); ?>

                                <span><?php echo e(__('message.At_Your_Fingertips')); ?>.</span>
                            </h1>
                            <p class="text-[16px] md:!text-[25px]"><?php echo e(__('message.Find_Buy_Sell_Exclusive_Number_Plates')); ?>

                            </p>
                        </div>

                    </div>

                </div>

                <!-- Search Form -->
                <div class="mt-5 col-md-12 rounded-md search">
                    <form class="d-flex flex-wrap gap-2 search-bar" action="<?php echo e(route('plates.search')); ?>" method="GET">
                        <!-- All Options -->
                        <div class="options d-flex flex-wrap gap-2 w-100">
                            <!-- Main Options -->
                            <select class="form-control search-option" id="emirate_id" name="emirate_id">
                                <option value=""><?php echo e(__('message.Select_Emirate')); ?></option>
                                <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($emirate->id); ?>"><?php echo e($emirate->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <select class="form-control search-option" id="code_id" name="code_id">
                                <option value=""><?php echo e(__('message.Select_Code')); ?></option>
                                <!-- Codes will be populated here dynamically -->
                            </select>

                            <select class="form-control search-option" name="length">
                                <option value=""><?php echo e(__('message.All_Digit')); ?></option>

                                <option value="1">1 <?php echo e(__('message.Digits')); ?></option>
                                <option value="2">2 <?php echo e(__('message.Digits')); ?></option>
                                <option value="3">3 <?php echo e(__('message.Digits')); ?></option>
                                <option value="4">4 <?php echo e(__('message.Digits')); ?></option>
                                <option value="5">5 <?php echo e(__('message.Digits')); ?></option>

                            </select>

                            <!-- <input type="length" class="form-control search-option" name="number" placeholder="Plate Number"> -->

                            <!-- More Options -->
                            <input type="number" class="form-control search-option extra d-none" name="max_price" placeholder="<?php echo e(__('message.Maximum_Price')); ?>">
                            <input type="number" class="form-control search-option extra d-none" name="min_price" placeholder="<?php echo e(__('message.Minimum_Price')); ?>">
                            <input type="number" class="form-control search-option extra d-none" name="start_with" placeholder="<?php echo e(__('message.Start_With')); ?>: ex:123">
                            <input type="number" class="form-control search-option extra d-none" name="end_with" placeholder="<?php echo e(__('message.End_With')); ?>: ex:000">

                            <!-- Search Button -->
                            <button class="search-btn d-flex align-items-center gap-2" type="submit"><i class="bx bx-search "></i><span><?php echo e(__('message.Search')); ?></span></button>
                        </div>
                    </form>
                    <p class="toggle-options">+ <?php echo e(__('message.more_options')); ?></p>
                </div>
                <!-- End Search Form -->


            </div>
        </div>

    </div>
</section>
<!-- /Banner -->


<section class=" yacht-category-sec">
    <div class="sec-bg">
        <img src="<?php echo e(asset ('assets/img/bg/sec-bg-wave.png')); ?>" class="wave-bottom" alt="Bg">
    </div>
    <!-- After the yacht-category-sec opening and before the regular plates display -->
    <div class="container">
        <div class="section-header-two">
            <h2><?php echo e(__('message.Featured_Plates')); ?></h2>
            <!-- <p><?php echo e(__('message.Most_Popular_Plates')); ?></p> -->
        </div>


        <div class="row yacht-category-lists mb-5">
            <div class="featured-plates-slider owl-carousel" style="direction: ltr;">
                <?php $__currentLoopData = $featuredPlates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <div class="listing-item plate-card position-relative">
                        <div class="py-1 px-3 bg-success text-white rounded-2 position-absolute" style="top: 10px; left: 10px;">
                            <?php echo e(__('message.Featured')); ?>

                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="text-left"><i class="bx bx-heart fs-4"></i></div>
                        </div>
                        <div class="position-relative plate">
                            <div class="w-100 my-4">
                                <img src="<?php echo e($plate->emirate->image_url); ?>" alt="<?php echo e($plate->emirate->name); ?>" class="w-100" loading="lazy">
                            </div>
                            <?php if($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak'): ?>
                            <h1 class="position-absolute <?php echo e($plate->emirate->slug); ?>-icon fw-semibold main-shadow"><?php echo e($plate->code->name); ?></h1>
                            <h2 class="position-absolute <?php echo e($plate->emirate->slug); ?>-number fw-normal main-shadow"><?php echo e($plate->number); ?></h2>
                            <?php else: ?>
                            <div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex justify-content-around align-items-center">
                                <h1 class="fw-medium main-shadow"><?php echo e($plate->code->name); ?></h1>
                                <h2 class="fw-medium main-shadow"><?php echo e($plate->number); ?></h2>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p class=" fs-4 text-center fw-normal pb-4 price"><?php echo e($plate->price_digits); ?></p>
                        </div>
                        <div class="border-top">
                            <a href="<?php echo e(route('plate.show', $plate->id)); ?>" class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2 nav-link">
                                <i class="bx bx-phone"></i>
                                <p><?php echo e(__('message.Contact')); ?></p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<section class="yacht-offer-sec relative bg-slate-50 py-16">

    <img src="assets/img/footer-left.png"
        alt="<?php echo e(__('message.tire_mark')); ?>"
        class="absolute top-0 left-0 w-40 opacity-20 pointer-events-none select-none" />

    <div class="container mx-auto px-4 text-center">
        <div class="section-header-two">
            <h2 class="text-2xl font-bold mb-6"><?php echo e(__('message.Why_Choose_Us')); ?></h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-6 rounded-2xl border hover:shadow-lg transition duration-300 text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-white text-primary flex items-center justify-center rounded-full">
                    <i class="bx bx-shield-quarter text-3xl"></i>
                </div>
                <h4 class="font-semibold text-lg mb-2"><?php echo e(__('message.Trusted')); ?></h4>
                <p class="text-gray-600 text-sm"><?php echo e(__('message.Secure_transactions')); ?></p>
            </div>

            <div class="p-6 rounded-2xl border hover:shadow-lg transition duration-300 text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-white text-primary flex items-center justify-center rounded-full">
                    <i class="bx bxs-star text-3xl"></i>
                </div>
                <h4 class="font-semibold text-lg mb-2"><?php echo e(__('message.Top_Tier_Plates')); ?></h4>
                <p class="text-gray-600 text-sm"><?php echo e(__('message.Access_unique_plates')); ?></p>
            </div>

            <div class="p-6 rounded-2xl border hover:shadow-lg transition duration-300 text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-white text-primary flex items-center justify-center rounded-full">
                    <i class="bx bx-headphone text-3xl"></i>
                </div>
                <h4 class="font-semibold text-lg mb-2"><?php echo e(__('message.Live_Support')); ?></h4>
                <p class="text-gray-600 text-sm"><?php echo e(__('message.Help_anytime')); ?></p>
            </div>
        </div>

    </div>
</section>




<!-- Yacht Categories -->
<section class="yacht-category-sec">

    <div class="container">

        <div class="section-header-two">
            <h2><?php echo e(__('message.Latest_Plates')); ?></h2>
            <p><?php echo e(__('message.Recently_Added_Plates')); ?></p>
        </div>
        <div class="row yacht-category-lists">
            <?php $__empty_1 = true; $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="listing-item plate-card position-relative">
                    <!-- <div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div> -->
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="text-left"><i class="bx bx-heart fs-4"></i></div>
                    </div>
                    <div class="position-relative plate ">
                        <div class="w-100 my-4">
                            <img src="<?php echo e($plate->emirate->image_url); ?>" alt="car-plate" class="w-100"
                                loading="lazy">
                        </div>
                        <?php if($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak'): ?>
                        <h1 class="position-absolute <?php echo e($plate->emirate->slug); ?>-icon fw-semibold main-shadow"><?php echo e($plate->code->name); ?></h1>
                        <h2 class="position-absolute <?php echo e($plate->emirate->slug); ?>-number fw-normal main-shadow"><?php echo e($plate->number); ?></h2>
                        <?php else: ?>
                        <div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex justify-content-around align-items-center
                         
                        ">
                            <h1 class="fw-medium main-shadow"><?php echo e($plate->code->name); ?></h1>
                            <h2 class="fw-medium main-shadow"><?php echo e($plate->number); ?></h2>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="price fs-4 text-center fw-normal pb-4"><?php echo e($plate->price_digits); ?></p>
                    </div>
                    <div class="border-top">
                        <a href="<?php echo e(route('plate.show', $plate->id)); ?>"
                            class="d-flex justify-content-center align-items-center gap-2 py-2 text-black w-100 rounded-2 nav-link"><i
                                class="bx bx-phone"></i>
                            <p>Contact</p>
                        </a>
                    </div>
                </div>
            </div>



            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


            <div class="col-12 text-center py-5">
                <h3><?php echo e(__('message.No_Plates_Found')); ?></h3>
                <p><?php echo e(__('message.Try_Different_Search')); ?></p>
            </div>
            <?php endif; ?>


            <div class="col-md-12">
                <div class="view-more-btn text-center">

                    <a href="<?php echo e(route('plates')); ?>" class="btn btn-secondary"><?php echo e(__('message.View_More_Plates')); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="works" class="yacht-offer-sec py-16 bg-slate-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4"><?php echo e(__('message.🔍 How It Works')); ?></h1>
            <span class="text-gray-600 max-w-2xl block mx-auto">

<?php echo e(__('message.From Browsing to Ownership — A Seamless Experience Discover how simple it is to find and purchase your ideal plate through our streamlined process:')); ?>            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-11 pt-10">
            <!-- Box 1 -->
            <div class="relative p-8 text-white bg-[#ac1e23] rounded shadow-[0_4px_16px_#919eb1] hover:text-[#ac1e23] overflow-hidden group after:content-[''] after:absolute after:h-full after:w-0 after:top-0 after:left-0 after:bg-white after:duration-500 hover:after:w-full">
                <div class="absolute -top-24 -left-8 text-[150px] font-bold text-white group-hover:!text-[#AC1E23] transition-all duration-300 select-none z-10">01</div>
                <div class="flex items-center mt-20 text-lg relative z-10">
                    <h3 class="text-xl font-semibold text-white group-hover:!text-[#ac1e23]"><?php echo e(__('message.🚗 Find Your Perfect Plate')); ?></h3>
                </div>
                <p class="text-md leading-6 m-4 text-white relative group-hover:!text-[#ac1e23] z-10">
                    <?php echo e(__('message.Easily explore thousands of available plates using smart filters — search by emirate, code, price, or custom sorting. In just seconds, you’ll discover the plate that matches your identity and style.')); ?>

                </p>
                <div class="absolute bottom-5 end-5 h-1 w-1/4 rounded-lg group-hover:!bg-[#ac1e23] bg-white duration-300 z-10"></div>
            </div>

            <!-- Box 2 -->
            <div class="relative p-8 text-[#AC1E23] bg-white rounded shadow-[0_4px_16px_#919eb1] hover:text-white overflow-hidden group after:content-[''] after:absolute after:h-full after:w-0 after:top-0 after:left-0 after:bg-[#ac1e23] after:duration-500 hover:after:w-full">
                <div class="absolute -top-24 -left-8 text-[150px] font-bold text-[#AC1E23] group-hover:text-white transition-all duration-300 select-none z-10">02</div>
                <div class="flex items-center mt-20 text-lg relative z-10">
                    <h3 class="text-xl font-semibold group-hover:!text-white"><?php echo e(__('message.Connect Directly with the Seller')); ?></h3>
                </div>
                <p class="text-md leading-6 m-4 relative group-hover:text-white z-10">
                    <?php echo e(__('message.Call or chat with the seller instantly via WhatsApp. Ask questions, negotiate the price, and get all the details — no middlemen, just smooth and secure communication.')); ?>

                </p>
                <div class="absolute bottom-5 end-5 h-1 w-1/4 rounded-lg group-hover:!bg-white bg-black duration-300 z-10"></div>
            </div>

            <!-- Box 3 -->
            <div class="relative p-8 text-[#AC1E23] bg-white rounded shadow-[0_4px_16px_#919eb1] overflow-hidden group after:content-[''] after:absolute after:h-full after:w-0 after:top-0 after:left-0 after:bg-[#ac1e23] after:duration-500 hover:after:w-full">
                <div class="absolute -top-24 -left-8 text-[150px] font-bold text-[#AC1E23] group-hover:!text-white transition-all duration-300 select-none z-10">03</div>
                <div class="flex items-center mt-20 text-lg relative z-10">
                    <h3 class="text-xl font-semibold group-hover:!text-white"><?php echo e(__('message.Meet, Confirm & Finalize Safely')); ?></h3>
                </div>
                <p class="text-md leading-6 m-4 relative z-10 group-hover:!text-white">
                    <?php echo e(__('message.Once you agree on the deal, make sure to meet the seller in person and verify everything before making any payment. We help ensure your transaction is transparent and secure from start to finish.')); ?>

                </p>
                <div class="absolute bottom-5 end-5 h-1 w-1/4 rounded-lg group-hover:!bg-white bg-black duration-300 z-10"></div>
            </div>
        </div>
    </div>
</section>


<section
    class="yacht-offer-sec bg-cover bg-fixed py-24 relative before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-slate-800/60"
    style="background-image: url('https://www.motorverso.com/wp-content/uploads/2019/03/CarReg-0010.jpg');">

    <!-- المحتوى -->
    <div class="relative z-10 container mx-auto px-4 text-center text-white">
        <h2 class="text-white text-2xl font-bold mb-4"><?php echo e(__('message.Stay_Updated')); ?></h2>
        <p class="text-white mb-6"><?php echo e(__('message.Subscribe_notification')); ?></p>

        <div class="flex justify-center">
            <div class="relative w-full md:w-1/2">
                <input
                    type="email"
                    placeholder="<?php echo e(__('message.Your_email_address')); ?>"
                    class="p-3 pr-12 rounded-md text-black w-full border outline-none">
                <button
                    type="submit"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#ac1e23] text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                    <i class='bx bx-send text-xl'></i>
                </button>
            </div>
        </div>
    </div>
</section>




<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.querySelector(".toggle-options").addEventListener("click", function() {
        const extraOptions = document.querySelectorAll(".extra");
        const isHidden = extraOptions[0].classList.contains("d-none");

        extraOptions.forEach(opt => {
            opt.classList.toggle("d-none");
        });

        this.textContent = isHidden ? "- <?php echo e(__('message.less_options')); ?>" : "+ <?php echo e(__('message.more_options')); ?>";
    });
    document.getElementById('emirate_id').addEventListener('change', function() {
        var emirateId = this.value;
        var codeSelect = document.getElementById('code_id');

        // Clear existing options
        codeSelect.innerHTML = '<option value=""><?php echo e(__("message.Select_Code")); ?></option>';

        if (emirateId) {
            // Make AJAX request to fetch codes
            fetch('/getCodes/' + emirateId) // Define this route in your web.php
                .then(response => response.json())
                .then(data => {
                    data.forEach(code => {
                        var option = document.createElement('option');
                        option.value = code.id;
                        option.textContent = code.name;
                        codeSelect.appendChild(option);
                    });
                });
        }
    });

    $('.featured-plates-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/front/index.blade.php ENDPATH**/ ?>