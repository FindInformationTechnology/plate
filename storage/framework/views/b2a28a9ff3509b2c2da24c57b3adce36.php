<?php $__env->startSection('title', __('message.Sign_In') . ' - ' . config('app.name')); ?>

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
                    <!-- <p class="account-subtitle"><?php echo e(__('message.We_will_send_a_confirmation_code_to_your_email')); ?>.</p> -->
                    <form action="<?php echo e(route('admin.login')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="input-block">
                            <label class="form-label"><?php echo e(__('message.Email')); ?> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" placeholder="">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="input-block">
                            <label class="form-label"><?php echo e(__('message.Password')); ?> <span
                                    class="text-danger">*</span></label>
                            <div class="pass-group">
                                <input type="password" name="password" class="form-control pass-input" placeholder="">
                                <span class="fas fa-eye-slash toggle-password"></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <!-- <div class="input-block">
                            <a class="forgot-link" href="<?php echo e(route('password.request')); ?>"><?php echo e(__('message.Forgot_Password')); ?> ?</a>
                        </div> -->
                       

                        <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1"><?php echo e(__('message.Sign_In')); ?></button>
                       
                       
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\Desktop\plate\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>