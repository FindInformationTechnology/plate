<?php $__env->startSection('content'); ?>


<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="<?php echo e(route('home')); ?>" class="btn sign-up"><span><i class="fe feather-corner-down-left"
                                aria-hidden="true"></i></span> <?php echo e(__('message.Back_To_Home')); ?></a>
                </div>
                <h1><?php echo e(__('message.Sign_In')); ?></h1>
                <p class="account-subtitle"><?php echo e(__('message.We_will_send_a_confirmation_code_to_your_email')); ?>.</p>
                <form action="<?php echo e(route('login')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Email_or_Phone')); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="login" class="form-control" placeholder="">
                        <?php $__errorArgs = ['login'];
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
                        <label class="form-label"><?php echo e(__('message.Password')); ?> <span
                                class="text-danger">*</span></label>
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
                        <a class="forgot-link" href="<?php echo e(route('password.request')); ?>"><?php echo e(__('message.Forgot_Password')); ?> ?</a>
                    </div>
                    <div class="input-block m-0">
                        <label class="custom_check d-inline-flex"><span><?php echo e(__('message.Remember_me')); ?></span>
                            <input type="checkbox" name="remeber">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1"><?php echo e(__('message.Sign_In')); ?></button>
                    <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or-log"><?php echo e(__('message.Or_log_in_with_your_email')); ?></span>
                    </div>
                    <!-- Social Login -->
                    <div class="social-login">
                        <a href="#"
                            class="d-flex align-items-center justify-content-center input-block btn google-login w-100"><span><img
                                    src="assets/img/icons/google.svg" class="img-fluid" alt="Google"></span><?php echo e(__('message.Log_in_with_Google')); ?></a>
                    </div>
                    <!-- <div class="social-login">
                        <a href="#"
                            class="d-flex align-items-center justify-content-center input-block btn google-login w-100"><span><img
                                    src="assets/img/icons/facebook.svg" class="img-fluid" alt="Facebook"></span><?php echo e(__('message.Log_in_with_Facebook')); ?></a>
                    </div> -->
                    <!-- /Social Login -->
                    <div class="text-center dont-have"><?php echo e(__('message.Dont_have_an_account_yet')); ?>? <a
                            href="<?php echo e(route ('register')); ?>"><?php echo e(__('message.Register')); ?></a></div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Website\Github\plate\resources\views/auth/login.blade.php ENDPATH**/ ?>