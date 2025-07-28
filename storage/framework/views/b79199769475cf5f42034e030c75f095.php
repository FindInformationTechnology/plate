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
                                    <div class="table-responsive plates-table-container" id="table-container">
                                        <div class="scroll-indicator d-none">
                                            <small class="text-muted">
                                                <i class="fas fa-hand-point-right"></i>
                                                <?php echo e(__('message.Scroll_Right_To_See_More')); ?>

                                            </small>
                                        </div>
                                        <table class="table table-bordered plates-table" id="plates-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="plate-number-col">
                                                        <div class="th-content">
                                                            <?php echo e(__('message.Plate_number')); ?> 
                                                            <span class="text-danger">*</span>
                                                        </div>
                                                    </th>
                                                    <th class="city-col">
                                                        <div class="th-content">
                                                            <?php echo e(__('message.City')); ?> 
                                                            <span class="text-danger">*</span>
                                                        </div>
                                                    </th>
                                                    <th class="code-col">
                                                        <div class="th-content">
                                                            <?php echo e(__('message.Code')); ?> 
                                                            <span class="text-danger">*</span>
                                                        </div>
                                                    </th>
                                                    <th class="price-col">
                                                        <div class="th-content">
                                                            <?php echo e(__('message.Price')); ?> 
                                                            <small class="d-block text-muted">(<?php echo e(__('message.Optional')); ?>)</small>
                                                        </div>
                                                    </th>
                                                    <!-- <th class="status-col">
                                                        <div class="th-content">
                                                            <?php echo e(__('message.Print_sold?')); ?>

                                                        </div>
                                                    </th> -->
                                                    <th class="action-col">
                                                        <div class="th-content">
                                                            <?php echo e(__('message.Action')); ?>

                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="plates-tbody">
                                                <tr class="plate-row" data-row="0">
                                                    <td class="plate-number-cell">
                                                        <input type="text" name="plates[0][number]" class="form-control form-control-responsive" 
                                                            placeholder="<?php echo e(__('message.Plate_Number')); ?>" value="<?php echo e(old('plates.0.number')); ?>" required>
                                                    </td>
                                                    <td class="city-cell">
                                                        <select class="form-select form-select-responsive emirate-select" name="plates[0][emirate_id]" data-row="0" required>
                                                            <option value=""><?php echo e(__('message.City')); ?></option>
                                                            <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($emirate->id); ?>" <?php echo e(old('plates.0.emirate_id') == $emirate->id ? 'selected' : ''); ?>><?php echo e($emirate->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </td>
                                                    <td class="code-cell">
                                                        <div class="position-relative">
                                                            <select class="form-select form-select-responsive code-select" name="plates[0][code_id]" data-row="0" required>
                                                                <option value=""><?php echo e(__('message.Code')); ?></option>
                                                            </select>
                                                            <div class="spinner-border spinner-border-sm text-primary position-absolute code-loading d-none" data-row="0" role="status">
                                                                <span class="visually-hidden"><?php echo e(__('message.Loading')); ?>...</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="price-cell">
                                                        <input type="text" name="plates[0][price]" class="form-control form-control-responsive" 
                                                            placeholder="<?php echo e(__('message.Price_Optional')); ?>" value="<?php echo e(old('plates.0.price')); ?>">
                                                    </td>
                                                    <!-- <td class="status-cell text-center">
                                                        <span class="badge bg-success badge-responsive"><?php echo e(__('message.Avail.')); ?></span>
                                                    </td> -->
                                                    <td class="action-cell text-center">
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-row d-none btn-responsive">
                                                            <i class="fas fa-trash"></i>
                                                            <span class="d-none d-lg-inline ms-1"><?php echo e(__('message.Remove')); ?></span>
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

<?php $__env->startPush('styles'); ?>
<style>
/* Enhanced Responsive Table Styles */
.plates-table-container {
    min-height: 400px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    background: white;
    padding: 1rem;
    margin-bottom: 1rem;
}

.plates-table {
    margin-bottom: 0;
    font-size: 0.95rem;
    min-width: 900px; /* Ensures horizontal scroll on very small screens */
}

/* Column width optimization */
.plates-table .plate-number-col { width: 18%; min-width: 140px; }
.plates-table .city-col { width: 20%; min-width: 160px; }
.plates-table .code-col { width: 18%; min-width: 140px; }
.plates-table .price-col { width: 16%; min-width: 120px; }
.plates-table .status-col { width: 12%; min-width: 100px; }
.plates-table .action-col { width: 16%; min-width: 120px; }

/* Header styling */
.th-content {
    font-weight: 600;
    font-size: 0.9rem;
    line-height: 1.3;
    padding: 0.5rem 0;
}

.th-content small {
    font-size: 0.75rem;
    font-weight: 400;
    margin-top: 2px;
}

/* Cell styling */
.city-cell {
    min-width: 100px !important;
    /* max-width: 100px !important; */
    padding-left: 5px !important;
    padding-right: 5px !important;
}

.plates-table td {
    padding: 0.75rem 0.5rem;
    vertical-align: middle;
    border-color: #e9ecef;
}

/* Responsive form controls */
.form-control-responsive,
.form-select-responsive {
    font-size: 0.9rem;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    border: 1px solid #ced4da;
    transition: all 0.2s ease;
}

.form-control-responsive:focus,
.form-select-responsive:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    border-color: #80bdff;
}

/* Badge responsive */
.badge-responsive {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
    border-radius: 4px;
}

/* Button responsive */
.btn-responsive {
    font-size: 0.85rem;
    padding: 0.4rem 0.8rem;
    border-radius: 4px;
    white-space: nowrap;
}

/* Loading spinner positioning */
.code-loading {
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    z-index: 10;
}

/* Mobile specific styles */
@media (max-width: 768px) {
    .plates-table-container {
        padding: 0.75rem;
        margin: 0 -0.5rem 1rem -0.5rem;
    }
    
    .plates-table {
        font-size: 0.85rem;
        min-width: 800px;
    }
    
    .th-content {
        font-size: 0.8rem;
        padding: 0.4rem 0;
    }
    
    .plates-table td {
        padding: 0.6rem 0.4rem;
    }
    
    .form-control-responsive,
    .form-select-responsive {
        font-size: 0.85rem;
        padding: 0.45rem 0.6rem;
    }
    
    .badge-responsive {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }
    
    .btn-responsive {
        font-size: 0.8rem;
        padding: 0.35rem 0.6rem;
    }
}

@media (max-width: 576px) {
    .plates-table-container {
        margin: 0 -1rem 1rem -1rem;
        border-radius: 0;
        padding: 0.5rem;
    }
    
    .plates-table {
        font-size: 0.8rem;
        min-width: 750px;
    }
    
    .th-content {
        font-size: 0.75rem;
    }
    
    .plates-table td {
        padding: 0.5rem 0.3rem;
    }
    
    .form-control-responsive,
    .form-select-responsive {
        font-size: 0.8rem;
        padding: 0.4rem 0.5rem;
    }
    
    /* Optimize column widths for very small screens */
    .plates-table .plate-number-col { min-width: 120px; }
    .plates-table .city-col { min-width: 140px; }
    .plates-table .code-col { min-width: 120px; }
    .plates-table .price-col { min-width: 100px; }
    .plates-table .status-col { min-width: 80px; }
    .plates-table .action-col { min-width: 100px; }
}

/* Enhanced horizontal scroll indicators */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* RTL Support */
[dir="rtl"] .plates-table {
    text-align: right;
}

[dir="rtl"] .form-control-responsive,
[dir="rtl"] .form-select-responsive {
    text-align: right;
}

[dir="rtl"] .code-loading {
    right: auto;
    left: 10px;
}

/* Improved focus states for accessibility */
.plates-table tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.plates-table .plate-row:focus-within {
    background-color: rgba(0, 123, 255, 0.08);
    box-shadow: inset 2px 0 0 #007bff;
}

/* Scroll indicator */
.scroll-indicator {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.9);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    z-index: 10;
    border: 1px solid #e9ecef;
}

.scroll-indicator i {
    animation: pointRight 1s ease-in-out infinite;
}

@keyframes pointRight {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(5px); }
}

[dir="rtl"] .scroll-indicator {
    right: auto;
    left: 10px;
}

[dir="rtl"] .scroll-indicator i {
    transform: scaleX(-1);
}

/* Print styles */
@media print {
    .plates-table-container {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .action-col,
    .action-cell,
    .scroll-indicator {
        display: none;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        let rowCount = 1;

        // Check if table needs horizontal scroll and show indicator
        function checkScrollIndicator() {
            const container = $('#table-container')[0];
            const indicator = $('.scroll-indicator');
            
            if (container && container.scrollWidth > container.clientWidth) {
                indicator.removeClass('d-none');
                
                // Hide indicator after user scrolls
                container.addEventListener('scroll', function() {
                    if (container.scrollLeft > 20) {
                        indicator.addClass('d-none');
                    }
                }, { once: true });
            } else {
                indicator.addClass('d-none');
            }
        }

        // Initial check
        setTimeout(checkScrollIndicator, 100);

        // Recheck on window resize
        $(window).on('resize', checkScrollIndicator);

        // Add new row functionality
        $('#add-row').on('click', function() {
            const newRow = createNewRow(rowCount);
            $('#plates-tbody').append(newRow);
            updateRemoveButtons();
            rowCount++;
            
            // Recheck scroll indicator after adding row
            setTimeout(checkScrollIndicator, 50);
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
                    <td class="plate-number-cell">
                        <input type="text" name="plates[${index}][number]" class="form-control form-control-responsive" 
                            placeholder="<?php echo e(__('message.Plate_Number')); ?>" required>
                    </td>
                    <td class="city-cell">
                        <select class="form-select form-select-responsive emirate-select" name="plates[${index}][emirate_id]" data-row="${index}" required>
                            <option value=""><?php echo e(__('message.City')); ?></option>
                            <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emirate->id); ?>"><?php echo e($emirate->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td class="code-cell">
                        <div class="position-relative">
                            <select class="form-select form-select-responsive code-select" name="plates[${index}][code_id]" data-row="${index}" required>
                                <option value=""><?php echo e(__('message.Code')); ?></option>
                            </select>
                            <div class="spinner-border spinner-border-sm text-primary position-absolute code-loading d-none" data-row="${index}" role="status">
                                <span class="visually-hidden"><?php echo e(__('message.Loading')); ?>...</span>
                            </div>
                        </div>
                    </td>
                    <td class="price-cell">
                        <input type="text" name="plates[${index}][price]" class="form-control form-control-responsive" 
                            placeholder="<?php echo e(__('message.Price_Optional')); ?>">
                    </td>
                    <td class="status-cell text-center">
                        <span class="badge bg-success badge-responsive"><?php echo e(__('message.Avail.')); ?></span>
                    </td>
                    <td class="action-cell text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row btn-responsive">
                            <i class="fas fa-trash"></i>
                            <span class="d-none d-lg-inline ms-1"><?php echo e(__('message.Remove')); ?></span>
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