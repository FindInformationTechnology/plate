

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
                            <h1><?php echo e(__('message.Premium_UAE_Plates')); ?>

                                <span><?php echo e(__('message.At_Your_Fingertips')); ?>.</span>
                            </h1>
                            <p><?php echo e(__('message.Find_Buy_Sell_Exclusive_Number_Plates')); ?>

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


<section class="yacht-offer-sec">
			<!-- <div class="sec-bg">
				<img src="<?php echo e(asset ('assets/img/bg/sec-bg-wave.png')); ?>" class="wave-bottom" alt="Bg">
			</div> -->
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
                            <div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex justify-content-between align-items-center">
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



<!-- Yacht Categories -->
<section class="yacht-category-sec">





    <!-- Then continue with your existing section header for regular plates -->


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
						<div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex justify-content-between align-items-center">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Website\Github\plate\resources\views/front/index.blade.php ENDPATH**/ ?>