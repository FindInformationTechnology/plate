

<?php $__env->startSection('title', $plate->emirate->name . ' ' . $plate->code->name . ' ' . $plate->number . ' - ' . config('app.name')); ?>
<?php $__env->startSection('meta_description', __('message.Buy') . ' ' . $plate->emirate->name . ' ' . __('message.plate') . ' ' . $plate->code->name . ' ' . $plate->number . ' ' . __('message.for') . ' ' . $plate->price_digits . '. ' . __('message.Home_Meta_Description')); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        /* Reduce text size for plate code and number on this page only */
        .plate h1 {
            /* font-size: 0.9em !important; */
        }

        .plate h2 {
            /* font-size: 0.8em !important; */
        }

        /* Custom width utility for md+ screens */
        @media (min-width: 768px) {
            .w-md-50 {
                width: 50% !important;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


    <!-- Plate Details -->

    <section class="plate-details container d-flex align-items-center gap-5">
        <div class="container">
            <div class="my-5 p-4 bg-white shadow-lg rounded" style="background-color: #e7eaef">
                <div class="w-100">
                    <div class="position-relative plate big-plate">
                        <div class="w-100">
                            <img src="<?php echo e($plate->emirate->image_url); ?>" alt="car-plate" class="w-100" loading="lazy">
                        </div>
                        <?php if($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak'): ?>
                                        <span class="position-absolute <?php echo e($plate->emirate->slug); ?>-icon fw-semibold main-shadow"><?php echo e($plate->code->name); ?></span>
                                        <h2 class="position-absolute <?php echo e($plate->emirate->slug); ?>-number fw-normal main-shadow">
                                            <?php echo e($plate->number); ?></h2>
                        <?php else: ?>
                            <div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex justify-content-around
                                align-items-center ltr-content">
                                <span class="fw-medium main-shadow"><?php echo e($plate->code->name); ?></span>
                                <h2 class="fw-medium main-shadow"><?php echo e($plate->number); ?></h2>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div>
                    <!-- Price & Details Section -->
                    <div class="mb-4">
                        <!-- Price Display -->
                        <div class="my-3 d-flex justify-content-between align-items-center">
                            <div class="price mb-0 fw-bold text-dark" style="font-size: 1.3rem; letter-spacing: -0.5px;">
                                <?php echo e($plate->price_digits); ?>

                            </div>
                            <p class="mb-0 d-flex align-items-center gap-2" style="opacity: 0.6;">
                                <i class="fa fa-eye " aria-hidden="true"></i>
                                <span class="fw-medium"><?php echo e($plate->views_count); ?></span>
                                <span><?php echo e(__('message.Views')); ?></span>
                            </p>
                        </div>

                        <!-- Safety Tips Box -->
                        <div class="bg-light border border-secondary border-opacity-25 rounded-3 p-3 mt-3">
                            <div class="d-flex align-items-start gap-2 mb-2">
                                <i class="fa fa-shield-alt text-primary mt-1"></i>
                                <h6 class="mb-0 fw-semibold text-dark">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'نصائح السلامة' : 'Safety Tips'); ?></h6>
                            </div>
                            <ul class="list-unstyled mb-0 ms-4">
                                <li class="mb-2 text-secondary small d-flex align-items-start gap-2">
                                    <i class="fa fa-check-circle text-success mt-1" style="font-size: 0.875rem;"></i>
                                    <span><?php echo e(app()->getLocale() == 'ar' ? 'لا تقم بتحويل المال مباشرة' : 'Do not transfer money directly'); ?></span>
                                </li>
                                <li class="text-secondary small d-flex align-items-start gap-2">
                                    <i class="fa fa-check-circle text-success mt-1" style="font-size: 0.875rem;"></i>
                                    <span><?php echo e(app()->getLocale() == 'ar' ? 'قابل البائع شخصيا' : 'Meet the seller in person'); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Buttons -->
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <?php if(isset($plate->user->phone_number)): ?>
                            <a href="tel:<?php echo e($plate->user->phone_number ?? ''); ?>"
                                class="btn btn-outline-dark d-flex align-items-center justify-content-center gap-2 py-3 w-100 <?php if(!isset($plate->user->whatsapp_number)): ?> w-md-50 <?php endif; ?> rounded-3 fw-medium"
                                style="border-width: 2px; direction: ltr;">
                                <i class="bx bx-phone fs-5"></i>
                                <span class="dir-ltr"><?php echo e($plate->user->phone_number); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if(isset($plate->user->whatsapp_number)): ?>
                            <a href="https://wa.me/<?php echo e($plate->user->whatsapp_number ?? ''); ?>"
                                class="btn btn-success d-flex align-items-center justify-content-center gap-2 py-3 w-100 rounded-3 <?php if(!isset($plate->user->phone_number)): ?> w-md-50 <?php endif; ?> fw-medium"
                                style="border-width: 2px; direction: ltr;" target="_blank">
                                <i class="bx bxl-whatsapp fs-5"></i>
                                <span class="dir-ltr"><?php echo e($plate->user->whatsapp_number ?? ''); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="yacht-offer-sec relative bg-slate-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="section-header-two">
                <h2 class="text-2xl font-bold mb-6"><?php echo e(__('message.Related_By_Emirate')); ?></h2>
            </div>
            <div class="pt-3 d-grid">
                <div class="row">
                    <?php $__currentLoopData = $relatedByEmirate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="listing-item plate-card position-relative">
                                <!-- <div class="py-1 px-3 bg-alt rounded-2 position-absolute status">Status</div> -->
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="text-left"><i class="bx bx-heart fs-4"></i></div>
                                </div>
                                <div class="position-relative plate">
                                    <div class="w-100 my-4">
                                        <img src="<?php echo e($plate->emirate->image_url); ?>" alt="car-plate" class="w-100"
                                            loading="lazy">
                                    </div>
                                    <?php if($plate->emirate->slug != 'ajman' && $plate->emirate->slug != 'rak'): ?>
                                                        <span class="position-absolute <?php echo e($plate->emirate->slug); ?>-icon fw-semibold main-shadow"><?php echo e($plate->code->name); ?></span>
                                                        <h2 class="position-absolute <?php echo e($plate->emirate->slug); ?>-number fw-normal main-shadow"><?php echo e($plate->number); ?></h2>
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
                                            class="bx bx-phone text-[20px]"></i>
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

    <!-- Plate Details -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/front/show.blade.php ENDPATH**/ ?>