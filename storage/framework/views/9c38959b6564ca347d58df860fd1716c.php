<?php $__env->startSection('content'); ?>



<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <div class="sign-group">
                    <a href="<?php echo e(route('home')); ?>" class="btn sign-up"><span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span> Back To Home</a>
                </div>
                <h1>Reset Password</h1>
                <p class="account-subtitle">Your new password must be different from previous used passwords.</p>
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
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
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
                        <label class="form-label">New Password <span class="text-danger">*</span></label>
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
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password_confirmation" class="form-control pass-input-two" placeholder="">
                            <span class="fas fa-eye-slash toggle-password-two"></span>
                        </div>
                    </div>
                    <button class="btn btn-outline-light w-100 btn-size">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>






<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u465294331/domains/plate35.com/public_html/resources/views/auth/reset-password.blade.php ENDPATH**/ ?>