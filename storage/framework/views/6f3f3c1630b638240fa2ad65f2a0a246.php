

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
                    <h1 class="position-absolute <?php echo e($plate->emirate->slug); ?>-icon fw-semibold main-shadow"><?php echo e($plate->code->name); ?></h1>
                    <h2 class="position-absolute <?php echo e($plate->emirate->slug); ?>-number fw-normal main-shadow"><?php echo e($plate->number); ?></h2>
                    <?php else: ?>
                    <div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex justify-content-around
                        align-items-center">
                        <h1 class="fw-medium main-shadow"><?php echo e($plate->code->name); ?></h1>
                        <h2 class="fw-medium main-shadow"><?php echo e($plate->number); ?></h2>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-between align-items-center pb-2">
                    <div>
                        <h1 class="price py-2 fs-1 fw-normal">
                            <?php echo e($plate->price_digits); ?>

                        </h1>
                        <p class="text-secondary fs-6 mb-2">
                            <i class="fa fa-eye me-1" aria-hidden="true"></i> <?php echo e($plate->views_count); ?> <?php echo e(__('message.Views')); ?>

                        </p>
                    
                        <div class="alert alert-warning mt-2">
                            <ul class="icons list-unstyled mb-0">
                                <li class="mb-1">
                                    <i class="fa fa-credit-card me-2" aria-hidden="true"></i>
                                    <?php echo e(app()->getLocale() == 'ar' ? 'لا تقم بتحويل المال مباشرة' : 'Do not transfer money directly'); ?>

                                </li>
                                <li>
                                    <i class="fa fa-handshake me-2" aria-hidden="true"></i>
                                    <?php echo e(app()->getLocale() == 'ar' ? 'قابل البائع شخصيا' : 'Meet the seller in person'); ?>

                                </li>
                            </ul>
                        </div>
                    </div>

                  
                    <!-- <div>
                        <i class="bx bx-heart fs-2"></i>
                    </div> -->
                </div>
                <div class="d-flex align-items-center gap-3 mt-2 text-center contact-button">
                    <a href="tel:<?php echo e($plate->user->phone_number ?? ''); ?>"
                        class="contact d-flex align-items-center justify-content-center gap-2 py-2 flex-grow-1 rounded-2"
                        target="_blank"><i class="bx bx-phone fs-5"></i>
                        <p><?php echo e($plate->user->phone_number); ?></p>
                    </a>
                    <a href="https://wa.me/<?php echo e($plate->user->whatsapp_number ?? ''); ?>"
                        class="whatsapp d-flex align-items-center justify-content-center gap-2 py-2 flex-grow-1 rounded-2"
                        target="_blank"><i class="bx bxl-whatsapp fs-5"></i>
                        <p><?php echo e($plate->user->whatsapp_number ?? ''); ?></p>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-secondary fs-3"><?php echo e(__('message.Related_By_Emirate')); ?></h1>
            <div class="pt-3 d-grid">
                <div class="row">
                    <?php $__currentLoopData = $relatedByEmirate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-12">
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
                                <h1 class="position-absolute <?php echo e($plate->emirate->slug); ?>-icon fw-semibold main-shadow"><?php echo e($plate->code->name); ?></h1>
                                <h2 class="position-absolute <?php echo e($plate->emirate->slug); ?>-number fw-normal main-shadow"><?php echo e($plate->number); ?></h2>
                                <?php else: ?>
                                <div class=" <?php echo e($plate->emirate->slug); ?>-plate position-absolute d-flex
                                    justify-content-around align-items-center">
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
    </div>
    
</section>

<!-- Plate Details -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/front/show.blade.php ENDPATH**/ ?>