<div class="mt-5 col-md-12 rounded-md search">
    <form class="d-flex flex-wrap gap-2 search-bar" action="<?php echo e(route('plates.search')); ?>" method="GET">
        <!-- All Options -->
        <div class="options d-flex flex-wrap gap-2 w-100">
            <!-- Main Options -->
            <select class="form-control search-option" id="emirate_id" name="emirate_id">
                <option value=""><?php echo e(__('message.Select_Emirate')); ?></option>
                <?php $__currentLoopData = \App\Models\Emirate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($emirate->id); ?>"><?php echo e($emirate->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select class="form-control search-option" id="code_id" name="code_id">
                <option value=""><?php echo e(__('message.Select_Code')); ?></option>
                <!-- Codes will be populated here dynamically -->
            </select>

            <select class="form-control search-option" name="length">
                <option value=""><?php echo e(__('message.All_Digit')); ?></option>

                <option value="1">1 <?php echo e(__('message.Digits')); ?></option>
                <option value="2">2 <?php echo e(__('message.Digits')); ?></option>
                <option value="3">3 <?php echo e(__('message.Digits')); ?></option>
                <option value="4">4 <?php echo e(__('message.Digits')); ?></option>
                <option value="5">5 <?php echo e(__('message.Digits')); ?></option>

            </select>

            <!-- <input type="length" class="form-control search-option" name="number" placeholder="Plate Number"> -->

            <!-- NEW: Format Dropdown -->
            <select class="form-control search-option extra d-none" name="format">
                <option value=""><?php echo e(__('message.Select_Format')); ?></option>
                <option value="repeat_2"><?php echo e(__('message.Contains_Digit_Repeated_2_Times')); ?></option>
                <option value="repeat_3"><?php echo e(__('message.Contains_Digit_Repeated_3_Times')); ?></option>
                <option value="repeat_4"><?php echo e(__('message.Contains_Digit_Repeated_4_Times')); ?></option>
                <option value="x_any_any_any_x"><?php echo e(__('message.X???X_5_Digits')); ?></option>
                <option value="x_y_z_y_x"><?php echo e(__('message.XYZYX_5_Digits')); ?></option>
                <option value="x_x_z_x_x"><?php echo e(__('message.XXZXX_5_Digits')); ?></option>
                <option value="any_x_x_x_any"><?php echo e(__('message.?XXX?_5_Digits')); ?></option>
                <option value="any_any_x_x_x"><?php echo e(__('message.??xxx_5_Digits')); ?></option>
                <option value="x_x_x_any_any"><?php echo e(__('message.xxx??_5_Digits')); ?></option>
                <option value="x_x_x_x_x"><?php echo e(__('message.xxxxx_5_Digits')); ?></option>
                <option value="x_any_any_x"><?php echo e(__('message.x??x_4_Digits')); ?></option>
                <option value="x_y_y_x"><?php echo e(__('message.x_y_y_x_4_Digits')); ?></option>
                <option value="any_x_x_any"><?php echo e(__('message.?_x_x_?_4_Digits')); ?></option>
                <option value="x_y_y_y"><?php echo e(__('message.x_y_y_y_4_Digits')); ?></option>
                <option value="x_x_x_y"><?php echo e(__('message.x_x_x_y_4_Digits')); ?></option>
                <option value="x_y_z"><?php echo e(__('message.x_y_z_3_Digits')); ?></option>
                <option value="x_y_y"><?php echo e(__('message.x_y_y_3_Digits')); ?></option>
                <option value="x_x_y"><?php echo e(__('message.x_x_y_3_Digits')); ?></option>
                <option value="x_x_x"><?php echo e(__('message.x_x_x_3_Digits')); ?></option>
                
                
            </select>


            <!-- More Options -->
            <input type="number" class="form-control search-option extra d-none" name="max_price"
                placeholder="<?php echo e(__('message.Maximum_Price')); ?>">
            <input type="number" class="form-control search-option extra d-none" name="min_price"
                placeholder="<?php echo e(__('message.Minimum_Price')); ?>">
            <input type="number" class="form-control search-option extra d-none" name="start_with"
                placeholder="<?php echo e(__('message.Start_With')); ?>: ex:123">
            <input type="number" class="form-control search-option extra d-none" name="end_with"
                placeholder="<?php echo e(__('message.End_With')); ?>: ex:000">

            <!-- Search Button -->
            <button class="search-btn d-flex align-items-center gap-2" type="submit"><i
                    class="bx bx-search "></i><span><?php echo e(__('message.Search')); ?></span></button>
        </div>
    </form>
    <p class="toggle-options">+ <?php echo e(__('message.more_options')); ?></p>
</div><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/front/search-form.blade.php ENDPATH**/ ?>