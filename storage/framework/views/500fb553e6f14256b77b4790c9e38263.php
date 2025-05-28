<?php $__env->startSection('content'); ?>


<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="<?php echo e(route('home')); ?>" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> <?php echo e(__('message.Back_To_Home')); ?></a>
                </div>
                <h1><?php echo e(__('message.Forgot_Password')); ?></h1>
                <p class="account-subtitle"><?php echo e(__('message.Enter_your_email_and_we_will_send_you_a_link_to_reset_your_password')); ?>.</p>
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('password.email')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Email_Address')); ?> <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="">
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
                    <!-- <a href="<?php echo e(route('password.email')); ?>" class="btn btn-outline-light w-100 btn-size">Save Changes</a> -->
            
                    <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1"><?php echo e(__('message.Send')); ?></button>

                </form>
            </div>
        </div>
    </div>
</div>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>