<?php $__env->startSection('content'); ?>
<section class="section product-details add-listing">
    <div class="container">

        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('user.plates.update', $plate->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row" id="info">
                <div class="col-lg-12 col-md-12">
                    <div class="heading-lising">
                        <h4><?php echo e(__('message.Edit_Plate')); ?></h4>
                        <p><?php echo e(__('message.Update_your_plate_information_below')); ?></p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('message.Plate_number')); ?> <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="number" class="form-control"
                                            placeholder="<?php echo e(__('message.Ex_58565')); ?>" value="<?php echo e($plate->number); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('message.City')); ?> <span
                                                class="text-danger">*</span></label>
                                        <select class="select" name="emirate_id" id="emirate_id" required>
                                            <option value=""><?php echo e(__('message.Select_Emirate')); ?></option>
                                            <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($emirate->id); ?>" <?php echo e($plate->emirate_id == $emirate->id ?
                                                'selected' : ''); ?>><?php echo e($emirate->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('message.Code')); ?> <span
                                                class="text-danger">*</span></label>
                                        <select class="select" name="code_id" id="code_id" required>
                                            <option value=""><?php echo e(__('message.Select_Code')); ?></option>
                                            <?php $__currentLoopData = \App\Models\Code::where('emirate_id',
                                            $plate->emirate_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($code->id); ?>" <?php echo e($plate->code_id == $code->id ? 'selected'
                                                : ''); ?>><?php echo e($code->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="spinner-border text-primary d-none" id="code-loading" role="status">
                                            <span class="visually-hidden"><?php echo e(__('message.Loading')); ?>...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('message.Price')); ?> <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control"
                                            placeholder="<?php echo e(__('message.Ex_1200')); ?>" value="<?php echo e($plate->price); ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('message.Status')); ?></label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="soldToggle"
                                                name="is_sold" <?php echo e($plate->is_sold ? 'checked' : ''); ?>>
                                            <label class="form-check-label"
                                                for="soldToggle"><?php echo e(__('message.Sold')); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('message.Visibility')); ?></label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="visibilityToggle" name="is_visible" <?php echo e($plate->is_visible ? 'checked'
                                                : ''); ?>>
                                            <label class="form-check-label"
                                                for="visibilityToggle"><?php echo e(__('message.Visible')); ?></label>
                                        </div>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="booking-info-btns d-flex justify-content-end">
                <a href="<?php echo e(route('user.plates')); ?>" class="btn btn-secondary me-2"><?php echo e(__('message.Cancel')); ?></a>
                <button class="btn btn-primary continue-book-btn"
                    type="submit"><?php echo e(__('message.Update_Plate')); ?></button>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        // When emirate selection changes
        $('#emirate_id').on('change', function() {
            const emirateId = $(this).val();
            const codeSelect = $('#code_id');
            const loadingSpinner = $('#code-loading');

            // Clear current options
            codeSelect.empty().append('<option value=""><?php echo e(__("message.Loading_codes")); ?>...</option>');

            if (emirateId) {
                // Show loading spinner
                loadingSpinner.removeClass('d-none');

                // Fetch codes for the selected emirate
                $.ajax({
                    url: "<?php echo e(route('user.api.codes.by.emirate')); ?>",
                    type: "GET",
                    data: {
                        emirate_id: emirateId
                    },
                    success: function(response) {
                        // Clear the loading option
                        codeSelect.empty();

                        // Add a default option
                        codeSelect.append('<option value=""><?php echo e(__("message.Select_Code")); ?></option>');

                        // Add options for each code
                        $.each(response.codes, function(key, code) {
                            codeSelect.append('<option value="' + code.id + '">' + code.name + '</option>');
                        });

                        // Hide loading spinner
                        loadingSpinner.addClass('d-none');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading codes:", error);
                        codeSelect.empty().append('<option value=""><?php echo e(__("message.Error_loading_codes")); ?></option>');
                        loadingSpinner.addClass('d-none');
                    }
                });
            } else {
                // If no emirate is selected, show default message
                codeSelect.empty().append('<option value=""><?php echo e(__("message.Select_Emirate_First")); ?></option>');
            }
        });

        // Handle the remove image checkbox
        $('#removeImage').on('change', function() {
            if ($(this).is(':checked')) {
                $('input[name="image"]').prop('disabled', true);
                $('.upload-div').addClass('disabled');
            } else {
                $('input[name="image"]').prop('disabled', false);
                $('.upload-div').removeClass('disabled');
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/user/plate/edit.blade.php ENDPATH**/ ?>