

<?php $__env->startSection('title', __('message.Browse_Plates') . ' - ' . config('app.name')); ?>
<?php $__env->startSection('meta_description', __('message.Plates_Meta_Description')); ?>
<?php $__env->startSection('keywords', 'browse UAE plates, search license plates, Dubai car plates, Abu Dhabi number plates'); ?>
<?php $__env->startSection('og_title', __('message.Browse_Plates') . ' - ' . config('app.name')); ?>
<?php $__env->startSection('og_description', __('message.Plates_Meta_Description')); ?>

<?php $__env->startSection('content'); ?>


    <!-- Breadscrumb Section -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12 col-12">
                    <h1 class="breadcrumb-title"><?php echo e(__('message.Plates')); ?></h1>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('message.Home')); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('message.Plates')); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadscrumb Section -->

    <!-- Plate Details -->

    <section class="plate-details">

        <div class="container">
            <?php echo $__env->make('front.search-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>


        <div class="container my-4 ">



            <div>
                <!-- <h1 class="text-secondary fs-3">Similar</h1> -->
                <div class="pt-3 d-grid">
                    <div class="row">
                        <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="listing-item plate-card position-relative">
                                    <?php if($plate->is_featured): ?>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <div class="text-left py-1 px-3 featured-color text-white rounded-2">
                                                <?php echo e(__('message.Featured')); ?></div>
                                        </div>
                                    <?php else: ?>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <!-- <div class="text-left py-1 px-3  text-white rounded-2"><?php echo e(__('message.New')); ?></div> -->
                                        </div>
                                    <?php endif; ?>
                                    <div class="position-relative plate ">
                                        <div class="w-100 my-4">
                                            <img src="<?php echo e($plate->emirate->image_url); ?>" alt="car-plate" class="w-100"
                                                loading="lazy">
                                        </div>
                                        <?php if($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak'): ?>
                                                                <span
                                                                    class="position-absolute <?php echo e($plate->emirate->slug); ?>-icon fw-semibold main-shadow"><?php echo e($plate->code->name); ?></span>
                                                                <h2 class="position-absolute <?php echo e($plate->emirate->slug); ?>-number fw-normal main-shadow">
                                                                    <?php echo e($plate->number); ?></h2>
                                        <?php else: ?>
                                            <div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex
                                                justify-content-around align-items-center">
                                                <span class="fw-medium main-shadow"><?php echo e($plate->code->name); ?></span>
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
                                            <p><?php echo e(__('message.Contact')); ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- <?php echo e($plates->links()); ?> -->
                <?php echo e($plates->links('pagination::bootstrap-4')); ?>

            </div>
        </div>
    </section>

    <!-- Plate Details -->



<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.querySelector(".toggle-options").addEventListener("click", function () {
            const extraOptions = document.querySelectorAll(".extra");
            const isHidden = extraOptions[0].classList.contains("d-none");

            extraOptions.forEach(opt => {
                opt.classList.toggle("d-none");
            });

            this.textContent = isHidden ? "- <?php echo e(__('message.less_options')); ?>" : "+ <?php echo e(__('message.more_options')); ?>";
        });

        document.getElementById('emirate_id').addEventListener('change', function () {
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
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\Desktop\plate\resources\views/front/plates.blade.php ENDPATH**/ ?>