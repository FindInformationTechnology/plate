<div class="settings-info">
    <div class="settings-sub-heading">
        <h4><?php echo e(__('message.Profile')); ?></h4>
    </div>

    <?php if(session('profile_success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('profile_success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('password_success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('password_success')); ?>

    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Profile Information Form -->
    <form action="<?php echo e(route('user.profile.update')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Basic Info -->
        <div class="profile-info-grid">
            <div class="profile-info-header">
                <h5><?php echo e(__('message.Basic_Information')); ?></h5>
                <p><?php echo e(__('message.Information_about_user')); ?></p>
            </div>
            <div class="profile-inner">
                <div class="profile-info-pic">
                    <div class="profile-info-img">
                        <img src="<?php echo e(auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('assets/img/profiles/avatar-15.jpg')); ?>"
                            alt="Profile">
                        <div class="profile-edit-info">
                            <label for="profile_photo" style="cursor: pointer;">
                                <i class="feather-edit"></i>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" style="display: none;">
                        </div>
                    </div>
                    <div class="profile-info-content">
                        <h6><?php echo e(__('message.Profile_picture')); ?></h6>
                        <p><?php echo e(__('message.PNG_JPEG_under_15_MB')); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-form-group">
                            <label><?php echo e(__('message.Fullname')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(auth()->user()->name); ?>"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label><?php echo e(__('message.Email')); ?> <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?php echo e(auth()->user()->email); ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label><?php echo e(__('message.Phone_Number')); ?> <span class="text-danger">*</span></label>
                            <input  type="text" name="phone" class="form-control " style="direction: ltr;"
                                value="<?php echo e(auth()->user()->phone_number ?? ''); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-form-group">
                            <label><?php echo e(__('message.Whatsapp')); ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="whatsapp" style="direction: ltr;"
                                value="<?php echo e(auth()->user()->whatsapp_number ?? ''); ?>"
                                placeholder="<?php echo e(__('message.Enter_WhatsApp_Number')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Basic Info -->

        <!-- Profile Submit -->
        <div class="profile-submit-btn">
            <button type="reset" class="btn btn-secondary"><?php echo e(__('message.Cancel')); ?></button>
            <button type="submit" class="btn btn-primary"><?php echo e(__('message.Save_Profile_Changes')); ?></button>
        </div>
        <!-- /Profile Submit -->
    </form>
    <!-- /Profile Information Form -->

    <!-- Password Change Form -->
    <form action="<?php echo e(route('user.password.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Password Info -->
        <div class="profile-info-grid mt-4">
            <div class="profile-info-header">
                <h5><?php echo e(__('message.Password_Settings')); ?></h5>
                <p><?php echo e(__('message.Change_your_password')); ?></p>
            </div>
            <div class="profile-inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label><?php echo e(__('message.Current_Password')); ?> <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label><?php echo e(__('message.New_Password')); ?> <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label><?php echo e(__('message.Confirm_New_Password')); ?> <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Password Info -->

        <!-- Password Submit -->
        <div class="profile-submit-btn">
            <button type="reset" class="btn btn-secondary"><?php echo e(__('message.Cancel')); ?></button>
            <button type="submit" class="btn btn-primary"><?php echo e(__('message.Update_Password')); ?></button>
        </div>
        <!-- /Password Submit -->
    </form>
    <!-- /Password Change Form -->
</div><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/partials/settings/_profile.blade.php ENDPATH**/ ?>