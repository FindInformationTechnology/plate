<?php $__env->startSection('content'); ?>

<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="<?php echo e(route('home')); ?>" class="btn sign-up"><span><i
                                class="fe feather-corner-down-left" aria-hidden="true"></i></span> <?php echo e(__('message.Back_To_Home')); ?></a>
                </div>
                <h1><?php echo e(__('message.Sign_Up')); ?></h1>
                <p class="account-subtitle"><?php echo e(__('message.We_will_send_a_confirmation_code_to_your_email')); ?>.</p>

                <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form method="post" action="<?php echo e(route('register')); ?>" id="registerForm">
                    <?php echo csrf_field(); ?>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Name')); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                            placeholder="<?php echo e(__('message.Enter_your_full_name')); ?>" required>
                    </div>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Email')); ?> <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control"
                            placeholder="<?php echo e(__('message.Enter_your_email')); ?>" required>
                    </div>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Phone_Number')); ?> <span
                                class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control"
                            placeholder="<?php echo e(__('message.Enter_your_phone_number')); ?>" required>
                    </div>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Password')); ?> <span
                                class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control pass-input"
                                placeholder="<?php echo e(__('message.Create_password')); ?>" required>
                            <span class="fas fa-eye-slash toggle-password"></span>
                        </div>
                    </div>
                    <div class="input-block">
                        <label class="form-label"><?php echo e(__('message.Confirm_Password')); ?> <span
                                class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password_confirmation" class="form-control pass-input"
                                placeholder="<?php echo e(__('message.Confirm_password')); ?>" required>
                            <span class="fas fa-eye-slash toggle-password"></span>
                        </div>
                    </div>

                    <div class="input-block">
                       
                        <div class="pass-group">
                            <!-- Add hidden reCAPTCHA input field -->
                            <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">

                        </div>
                    </div>



                    <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1"><?php echo e(__('message.Sign_Up')); ?></button>

                    <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or"><?php echo e(__('message.Or_Create_an_account_with_your_email')); ?></span>
                    </div>
                    <!-- Social Login -->
                    <div class="social-login">
                        <a href="<?php echo e(route('auth.google')); ?>"
                            class="d-flex align-items-center justify-content-center input-block btn google-login w-100">
                            <span><img src="<?php echo e(asset('assets/img/icons/google.svg')); ?>" class="img-fluid"
                                    alt="Google"></span><?php echo e(__('message.Sign_up_with_Google')); ?>

                        </a>
                    </div>
                    <!-- <div class="social-login">
                        <a href="<?php echo e(route('auth.apple')); ?>" class="d-flex align-items-center justify-content-center input-block btn apple-login w-100">
                            <span><img src="<?php echo e(asset('assets/img/icons/apple.svg')); ?>" class="img-fluid" alt="Apple"></span>Sign up with Apple
                        </a>
                    </div> -->
                    <!-- <div class="social-login">
                        <a href="<?php echo e(route('auth.facebook')); ?>" class="d-flex align-items-center justify-content-center input-block btn google-login w-100">
                            <span><img src="<?php echo e(asset('assets/img/icons/facebook.svg')); ?>" class="img-fluid" alt="Facebook"></span>Sign up with Facebook
                        </a>
                    </div> -->
                    <!-- /Social Login -->

                    <div class="text-center dont-have"><?php echo e(__('message.Already_have_an_Account')); ?>? <a
                            href="<?php echo e(route('login')); ?>"><?php echo e(__('message.Sign_In')); ?></a></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add reCAPTCHA v3 script at the end of the body -->
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(config('services.recaptcha.site_key')); ?>"></script>
<script>
    grecaptcha.ready(function() {
        // Execute reCAPTCHA with action 'register'
        grecaptcha.execute("<?php echo e(config('services.recaptcha.site_key')); ?>", {
                action: 'register'
            })
            .then(function(token) {
                // Add the token to the hidden field
                document.getElementById('recaptchaResponse').value = token;
            });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/auth/register.blade.php ENDPATH**/ ?>