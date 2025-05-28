<?php $__env->startSection('content'); ?>

<div class="content dashboard-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card user-card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <h5><?php echo e(__('message.My_Plates')); ?> <span class="text-muted">(<?php echo e($plates->count()); ?>)</span></h5>
                            </div>
                            <div class="col-sm-7 text-sm-end">
                                <div class="booking-select d-flex justify-content-end align-items-center">
                                    <div class="search-group me-3">
                                        <input type="search" class="form-control" placeholder="<?php echo e(__('message.Search_plates')); ?>...">
                                    </div>
                                    <a href="<?php echo e(route('user.plates.create')); ?>" class="btn btn-primary"><i class="feather-plus-circle me-1"></i> <?php echo e(__('message.Add_Plate')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive dashboard-table dashboard-table-info">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('message.Plate_Details')); ?></th>
                                        <th><?php echo e(__('message.Emirate')); ?></th>
                                        <th><?php echo e(__('message.Code')); ?></th>
                                        <th><?php echo e(__('message.Price')); ?></th>
                                        <th><?php echo e(__('message.Status')); ?></th>
                                        <th><?php echo e(__('message.Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="table-avatar">
                                                <!-- <a href="#" class="avatar avatar-lg flex-shrink-0">
                                                    <img class="avatar-img" src="<?php echo e($plate->image_url); ?>" alt="Plate Image">
                                                </a> -->
                                                <div class="table-head-name flex-grow-1">
                                                    <a href="#"><?php echo e($plate->code->name); ?> <?php echo e($plate->number); ?></a>
                                                    <p><?php echo e(__('message.Listed')); ?>: <?php echo e($plate->created_at->diffForHumans()); ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6><?php echo e($plate->emirate->name); ?></h6>
                                        </td>
                                        <td>
                                            <h6><?php echo e($plate->code->name); ?></h6>
                                        </td>
                                        <td>
                                            <h5 class="text-success"><?php echo e($plate->price_digits); ?></h5>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input toggle-sold" type="checkbox" role="switch"
                                                        id="soldToggle<?php echo e($plate->id); ?>" data-id="<?php echo e($plate->id); ?>"
                                                        <?php echo e($plate->is_sold ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="soldToggle<?php echo e($plate->id); ?>">
                                                        <span class="status-label"><?php echo e($plate->is_sold ? __('message.Sold') : __('message.Not_Sold')); ?></span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input toggle-visibility" type="checkbox" role="switch"
                                                        id="visibilityToggle<?php echo e($plate->id); ?>" data-id="<?php echo e($plate->id); ?>"
                                                        <?php echo e($plate->is_visible ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="visibilityToggle<?php echo e($plate->id); ?>">
                                                        <span class="visibility-label"><?php echo e($plate->is_visible ? __('message.Visible') : __('message.Hidden')); ?></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="<?php echo e(route('user.plates.edit', $plate->id)); ?>" class="btn btn-sm btn-primary me-2">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger delete-plate" data-id="<?php echo e($plate->id); ?>">
                                                    <i class="feather-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="feather-tag fs-1 text-muted mb-3"></i>
                                                <h6><?php echo e(__('message.No_plates_listed_yet')); ?></h6>
                                                <p class="text-muted"><?php echo e(__('message.Start_listing_your_plates')); ?></p>
                                                <a href="<?php echo e(route('user.plates.create')); ?>" class="btn btn-primary"><?php echo e(__('message.Add_New_Plate')); ?></a>
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
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Delete plate functionality
        $('.delete-plate').on('click', function() {
            let button = $(this);
            let plateId = button.data('id');

            // Show confirmation dialog
            Swal.fire({
                title: "<?php echo e(__('message.Are_you_sure')); ?>?",
                text: "<?php echo e(__('message.You_wont_be_able_to_revert_this')); ?>!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#127384',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('message.Yes_delete_it')); ?>!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX call to delete plate
                    $.ajax({
                        url: "<?php echo e(route('user.plates.ajax-destroy')); ?>",
                        type: "POST",
                        data: {
                            id: plateId,
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success: function(response) {
                            // Remove the plate row from the DOM
                            button.closest('tr').fadeOut(300, function() {
                                $(this).remove();

                                // Check if there are no more plates
                                if ($('tbody tr').length === 0) {
                                    $('tbody').html(`
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="feather-tag fs-1 text-muted mb-3"></i>
                                                    <h6><?php echo e(__('message.No_plates_listed_yet')); ?></h6>
                                                    <p class="text-muted"><?php echo e(__('message.Start_listing_your_plates')); ?></p>
                                                    <a href="<?php echo e(route('user.plates.create')); ?>" class="btn btn-primary"><?php echo e(__('message.Add_New_Plate')); ?></a>
                                                </div>
                                            </td>
                                        </tr>
                                    `);
                                }
                            });

                            // Show success message
                            toastr.success(response.message || "<?php echo e(__('message.Plate_deleted_successfully')); ?>");
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "<?php echo e(__('message.Error_deleting_plate')); ?>");
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });

        // Toggle sold status
        $('.toggle-sold').on('change', function() {
            let checkbox = $(this);
            let plateId = checkbox.data('id');
            let isSold = checkbox.prop('checked') ? 1 : 0;
            let label = checkbox.closest('.form-check').find('.status-label');

            // AJAX call to update sold status
            $.ajax({
                url: "<?php echo e(route('user.plates.update-sold')); ?>",
                type: "POST",
                data: {
                    id: plateId,
                    is_sold: isSold,
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    // Update label text
                    label.text(isSold ? "<?php echo e(__('message.Sold')); ?>" : "<?php echo e(__('message.Not_Sold')); ?>");

                    // Show success message
                    toastr.success(response.message || "<?php echo e(__('message.Plate_status_updated')); ?>");
                },
                error: function(xhr) {
                    // Revert checkbox state on error
                    checkbox.prop('checked', !isSold);
                    label.text(!isSold ? "<?php echo e(__('message.Sold')); ?>" : "<?php echo e(__('message.Not_Sold')); ?>");

                    // Show error message
                    toastr.error(xhr.responseJSON?.message || "<?php echo e(__('message.Error_updating_plate_status')); ?>");
                    console.log(xhr.responseText);
                }
            });
        });

        // Toggle visibility status
        $('.toggle-visibility').on('change', function() {
            let checkbox = $(this);
            let plateId = checkbox.data('id');
            let isVisible = checkbox.prop('checked') ? 1 : 0;
            let label = checkbox.closest('.form-check').find('.visibility-label');

            // AJAX call to update visibility status
            $.ajax({
                url: "<?php echo e(route('user.plates.update-visibility')); ?>",
                type: "POST",
                data: {
                    id: plateId,
                    is_visible: isVisible,
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    // Update label text
                    label.text(isVisible ? "<?php echo e(__('message.Visible')); ?>" : "<?php echo e(__('message.Hidden')); ?>");

                    // Show success message
                    toastr.success(response.message || "<?php echo e(__('message.Visibility_updated')); ?>");
                },
                error: function(xhr) {
                    // Revert checkbox state on error
                    checkbox.prop('checked', !isVisible);
                    label.text(!isVisible ? "<?php echo e(__('message.Visible')); ?>" : "<?php echo e(__('message.Hidden')); ?>");

                    // Show error message
                    toastr.error(xhr.responseJSON?.message || "<?php echo e(__('message.Error_updating_visibility')); ?>");
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/user/plate/index.blade.php ENDPATH**/ ?>