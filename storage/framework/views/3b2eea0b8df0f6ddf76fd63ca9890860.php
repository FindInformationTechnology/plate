<?php $__env->startSection('content'); ?>

<!-- Page Content -->
<div class="content dashboard-content">
    <div class="container">
        <div class="row">
            <!-- User Stats -->
            <div class="col-lg-12 mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-light-primary">
                                        <i class="feather-tag text-primary fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo e($myPlatesCount ?? 0); ?></h5>
                                        <p class="mb-0"><?php echo e(__('message.My_Plates')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-light-success">
                                        <i class="feather-check-circle text-success fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo e($soldPlatesCount ?? 0); ?></h5>
                                        <p class="mb-0"><?php echo e(__('message.Sold_Plates')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-light-warning">
                                        <i class="feather-eye text-warning fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo e($viewsCount ?? 0); ?></h5>
                                        <p class="mb-0"><?php echo e(__('message.Total_Views')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /User Stats -->

            <!-- My Recent Plates -->
            <div class="col-lg-8 d-flex">
                <div class="card user-card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <h5><?php echo e(__('message.My_Recent_Plates')); ?></h5>
                            </div>
                            <div class="col-sm-7 text-sm-end">
                                <div class="booking-select">
                                    <select class="form-control select">
                                        <option><?php echo e(__('message.All_Plates')); ?></option>
                                        <option><?php echo e(__('message.Available')); ?></option>
                                        <option><?php echo e(__('message.Sold')); ?></option>
                                    </select>
                                    <a href="<?php echo e(route('user.plates')); ?>"
                                        class="view-link"><?php echo e(__('message.View_all_Plates')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive dashboard-table dashboard-table-info">
                            <table class="table">
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $recentPlates ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="table-avatar">

                                                <!-- <img class="avatar-img" src="<?php echo e($plate->image_url); ?>" alt="Plate Image"> -->

                                                <div class="table-head-name flex-grow-1">
                                                    <a href="">
                                                        <?php echo e($plate->emirate->name); ?> - <?php echo e($plate->code->name); ?> <?php echo e($plate->number); ?></a>
                                                    <p><?php echo e(__('message.Listed')); ?>: <?php echo e($plate->created_at->diffForHumans()); ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6><?php echo e(__('message.Emirate')); ?></h6>
                                            <p><?php echo e($plate->emirate->name); ?></p>
                                        </td>
                                        <td>
                                            <h6><?php echo e(__('message.Code')); ?></h6>
                                            <p><?php echo e($plate->code->name); ?></p>
                                        </td>
                                        <td>
                                            <h6><?php echo e(__('message.Price')); ?></h6>
                                            <h5 class="text-success"><?php echo e($plate->price_digits); ?></h5>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-<?php echo e($plate->is_sold ? 'danger' : 'success'); ?>">
                                                <?php echo e($plate->is_sold ? __('message.Sold') : __('message.Available')); ?>

                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="feather-tag fs-1 text-muted mb-3"></i>
                                                <h6><?php echo e(__('message.No_plates_listed_yet')); ?></h6>
                                                <p class="text-muted"><?php echo e(__('message.Start_listing_your_plates')); ?></p>
                                                <a href="<?php echo e(route('user.plates.create')); ?>"
                                                    class="btn btn-primary"><?php echo e(__('message.Add_New_Plate')); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /My Recent Plates -->

            <!-- Market Insights -->
            <div class="col-lg-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5><?php echo e(__('message.Market_Insights')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="popular-emirates mb-4">
                            <h6 class="mb-3"><?php echo e(__('message.Popular_Emirates')); ?></h6>
                            <?php $__currentLoopData = $popularEmirates ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo e($emirate->name); ?></span>
                                <span class="text-success"><?php echo e($emirate->plates_count); ?> <?php echo e(__('message.plates')); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="price-range">
                            <h6 class="mb-3"><?php echo e(__('message.Price_Range')); ?></h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo e(__('message.Average_Price')); ?></span>
                                <span class="text-success"><?php echo e($averagePrice ?? 'N/A'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo e(__('message.Highest_Price')); ?></span>
                                <span class="text-success"><?php echo e($highestPrice ?? 'N/A'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo e(__('message.Lowest_Price')); ?></span>
                                <span class="text-success"><?php echo e($lowestPrice ?? 'N/A'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Market Insights -->
        </div>
        <!-- /Dashboard -->
    </div>
</div>
<!-- /Page Content -->

<!-- Footer -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/user/dashboard.blade.php ENDPATH**/ ?>