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
        <form action="<?php echo e(route('user.plates.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row" id="info">
                <div class="col-lg-12 col-md-12">
                    <div class="heading-lising">
                        <h4><?php echo e(__('message.Basic_Info')); ?></h4>
                        <p class="text-muted"><?php echo e(__('message.Note')); ?>: <?php echo e(__('message.you_may_use')); ?> <strong>x, y</strong> <?php echo e(__('message.and')); ?> <strong>z</strong> <?php echo e(__('message.characters_to_hide_some_numbers')); ?></p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="plates-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th><?php echo e(__('message.Plate_number')); ?> <span class="text-danger">*</span></th>
                                                    <th><?php echo e(__('message.City')); ?> <span class="text-danger">*</span></th>
                                                    <th><?php echo e(__('message.Code')); ?> <span class="text-danger">*</span></th>
                                                    <th><?php echo e(__('message.Price')); ?> <small>(<?php echo e(__('message.Optional')); ?>)</small></th>
                                                    <th width="80"><?php echo e(__('message.Print_sold?')); ?></th>
                                                    <th width="60"><?php echo e(__('message.Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="plates-tbody">
                                                <tr class="plate-row" data-row="0">
                                                    <td>
                                                        <input type="text" name="plates[0][number]" class="form-control" 
                                                            placeholder="<?php echo e(__('message.Plate_Number')); ?>" value="<?php echo e(old('plates.0.number')); ?>" required>
                                                    </td>
                                                    <td>
                                                        <select class="form-select emirate-select" name="plates[0][emirate_id]" data-row="0" required>
                                                            <option value=""><?php echo e(__('message.City')); ?></option>
                                                            <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($emirate->id); ?>"><?php echo e($emirate->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select code-select" name="plates[0][code_id]" data-row="0" required>
                                                            <option value=""><?php echo e(__('message.Code')); ?></option>
                                                        </select>
                                                        <div class="spinner-border spinner-border-sm text-primary d-none code-loading" data-row="0" role="status">
                                                            <span class="visually-hidden"><?php echo e(__('message.Loading')); ?>...</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="plates[0][price]" class="form-control" 
                                                            placeholder="<?php echo e(__('message.Price_Optional')); ?>">
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-success"><?php echo e(__('message.Avail.')); ?></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-row d-none">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="button" class="btn btn-outline-primary" id="add-row">
                                            <i class="fas fa-plus me-2"></i><?php echo e(__('message.Add_Another_Plate')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="booking-info-btns d-flex justify-content-end">
                <a href="<?php echo e(route('user.plates')); ?>" class="btn btn-secondary"><?php echo e(__('message.Cancel')); ?></a>
                <button class="btn btn-primary continue-book-btn" type="submit"><?php echo e(__('message.Save_All_Plates')); ?></button>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        let rowCount = 1;

        // Add new row functionality
        $('#add-row').on('click', function() {
            const newRow = createNewRow(rowCount);
            $('#plates-tbody').append(newRow);
            updateRemoveButtons();
            rowCount++;
        });

        // Remove row functionality
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.plate-row').remove();
            updateRemoveButtons();
        });

        // Emirate change functionality
        $(document).on('change', '.emirate-select', function() {
            const emirateId = $(this).val();
            const row = $(this).data('row');
            const codeSelect = $(`.code-select[data-row="${row}"]`);
            const loadingSpinner = $(`.code-loading[data-row="${row}"]`);

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
                loadingSpinner.addClass('d-none');
            }
        });

        function createNewRow(index) {
            return `
                <tr class="plate-row" data-row="${index}">
                    <td>
                        <input type="text" name="plates[${index}][number]" class="form-control" 
                            placeholder="<?php echo e(__('message.Plate_Number')); ?>" required>
                    </td>
                    <td>
                        <select class="form-select emirate-select" name="plates[${index}][emirate_id]" data-row="${index}" required>
                            <option value=""><?php echo e(__('message.City')); ?></option>
                            <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emirate->id); ?>"><?php echo e($emirate->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-select code-select" name="plates[${index}][code_id]" data-row="${index}" required>
                            <option value=""><?php echo e(__('message.Code')); ?></option>
                        </select>
                        <div class="spinner-border spinner-border-sm text-primary d-none code-loading" data-row="${index}" role="status">
                            <span class="visually-hidden"><?php echo e(__('message.Loading')); ?>...</span>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="plates[${index}][price]" class="form-control" 
                            placeholder="<?php echo e(__('message.Price_Optional')); ?>">
                    </td>
                    <td class="text-center">
                        <span class="badge bg-success"><?php echo e(__('message.Avail.')); ?></span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        }

        function updateRemoveButtons() {
            const rows = $('.plate-row');
            if (rows.length === 1) {
                // Hide remove button for the last remaining row
                rows.find('.remove-row').addClass('d-none');
            } else {
                // Show remove buttons for all rows when there are multiple
                rows.find('.remove-row').removeClass('d-none');
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/user/plate/create.blade.php ENDPATH**/ ?>