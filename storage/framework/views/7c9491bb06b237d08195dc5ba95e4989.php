<?php $__env->startSection('title', '403 - Access Denied | Plate UAE'); ?>

<?php $__env->startSection('content'); ?>
    <div class="error-page-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 text-center">
                    <!-- Error Icon -->
                    <div class="error-icon mb-4">
                        <i class="bx bx-lock-alt text-danger" style="font-size: 100px;"></i>
                    </div>

                    <!-- Error Content -->
                    <div class="error-content">
                        <h1 class="display-4 fw-bold text-danger mb-3">403</h1>
                        <h2 class="h3 mb-3"><?php echo e(app()->getLocale() == 'ar' ? 'وصول مرفوض' : 'Access Denied'); ?></h2>
                        <p class="lead text-muted mb-4">
                            <?php echo e(app()->getLocale() == 'ar' ? 'عذراً، ليس لديك صلاحية للوصول إلى هذه الصفحة.' : 'Sorry, you do not have permission to access this page.'); ?>

                        </p>

                        <!-- Navigation Links -->
                        <div class="navigation-links mb-4">
                            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary btn-lg me-3">
                                <i class="bx bx-home"></i> <?php echo e(__('message.Home')); ?>

                            </a>
                            <a href="<?php echo e(route('contact')); ?>" class="btn btn-outline-secondary btn-lg">
                                <i class="bx bx-phone"></i> <?php echo e(__('message.Contact_Us')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .error-page-container {
            min-height: 60vh;
            display: flex;
            align-items: center;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\Desktop\plate\resources\views/errors/403.blade.php ENDPATH**/ ?>