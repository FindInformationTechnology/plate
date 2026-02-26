<?php $__env->startSection('content'); ?>



<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="<?php echo e(route('home')); ?>" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> <?php echo e(__('message.Back_To_Home')); ?></a>
                </div>
                <h1><?php echo e(__('message.Reset_Password')); ?></h1>
                <p class="account-subtitle"><?php echo e(__('message.Your_new_password_must_be_different_from_previous_used_passwords')); ?></p>
                <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('password.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">

                    <!-- Email Address -->
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Email_Address')); ?> <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $request->email)); ?>" required autofocus>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.New_Password')); ?> <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control pass-input" placeholder="">
                            <span class="fas fa-eye-slash toggle-password"></span>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Confirm_Password')); ?> <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password_confirmation" class="form-control pass-input-two" placeholder="">
                            <span class="fas fa-eye-slash toggle-password-two"></span>
                        </div>
                    </div>
                    <button class="btn btn-outline-light w-100 btn-size"><?php echo e(__('message.Save_Changes')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>






<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>