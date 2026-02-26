<?php $__env->startSection('title', '404 - Page Not Found | Plate UAE'); ?>
<?php $__env->startSection('meta_description', 'The page you are looking for could not be found. Browse our collection of premium UAE license plates or use our search to find what you need.'); ?>

<?php $__env->startSection('content'); ?>
<div class="error-page-container py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <!-- Error Image/Icon -->
                <div class="error-image mb-4">
                    <img src="<?php echo e(asset('assets/img/404.png')); ?>" alt="404 Error" class="img-fluid" style="max-width: 300px;">
                </div>

                <!-- Error Content -->
                <div class="error-content">
                    <h1 class="display-4 fw-bold text-primary mb-3">404</h1>
                    <h2 class="h3 mb-3"><?php echo e(__('message.Page_Not_Found')); ?></h2>
                    <p class="lead text-muted mb-4">
                        <?php echo e(__('message.Page_Not_Found_Description')); ?>

                    </p>

                    <!-- Search Form -->
                    <div class="search-section mb-5">
                        <h4 class="mb-3"><?php echo e(__('message.Search_For_Plates')); ?></h4>
                        <form action="<?php echo e(route('plates.search')); ?>" method="GET" class="d-flex justify-content-center">
                            <div class="input-group" style="max-width: 400px;">
                                <select class="form-select" name="emirate_id">
                                    <option value=""><?php echo e(__('message.Select_Emirate')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($emirate->id); ?>"><?php echo e($emirate->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button class="btn btn-primary" type="submit">
                                    <i class="bx bx-search"></i> <?php echo e(__('message.Search')); ?>

                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Navigation Links -->
                    <div class="navigation-links mb-4">
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary btn-lg me-3">
                            <i class="bx bx-home"></i> <?php echo e(__('message.Home')); ?>

                        </a>
                        <a href="<?php echo e(route('plates')); ?>" class="btn btn-outline-primary btn-lg me-3">
                            <i class="bx bx-grid"></i> <?php echo e(__('message.Browse_Plates')); ?>

                        </a>
                        <a href="<?php echo e(route('contact')); ?>" class="btn btn-outline-secondary btn-lg">
                            <i class="bx bx-phone"></i> <?php echo e(__('message.Contact_Us')); ?>

                        </a>
                    </div>

                    <!-- Popular Categories -->
                    <div class="popular-categories">
                        <h5 class="mb-3"><?php echo e(__('message.Popular_Categories')); ?></h5>
                        <div class="row">
                            <?php $__currentLoopData = \App\Models\Emirate::take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-md-3 mb-2">
                                <a href="<?php echo e(route('plates.search', ['emirate_id' => $emirate->id])); ?>" 
                                   class="btn btn-outline-light btn-sm w-100">
                                    <?php echo e($emirate->name); ?> <?php echo e(__('message.Plates')); ?>

                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.error-page-container {
    min-height: 60vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.error-image img {
    opacity: 0.8;
}

.navigation-links .btn {
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .input-group {
        flex-direction: column;
    }
    .input-group .form-select,
    .input-group .btn {
        border-radius: 0.375rem !important;
        margin-bottom: 10px;
    }
}
</style>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\Desktop\plate\resources\views/errors/404.blade.php ENDPATH**/ ?>