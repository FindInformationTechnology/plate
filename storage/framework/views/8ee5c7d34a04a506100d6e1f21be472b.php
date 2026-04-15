<div>
    <div class="login-wrapper">
        <div class="loginbox">
            <div class="login-auth">
                <div class="login-auth-wrap">
                    <div class="sign-group">
                        <a href="<?php echo e(route('home')); ?>" class="btn sign-up"><span><i class="fe feather-corner-down-left"
                                    aria-hidden="true"></i></span> <?php echo e(__('message.Back_To_Home')); ?></a>
                    </div>
                    <h1><?php echo e(__('message.Sign_In')); ?></h1>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step === 1): ?>
                        <p class="account-subtitle"><?php echo e(__('message.We_will_send_a_confirmation_code_to_your_email')); ?>.</p>

                        <div>
                            <div class="input-block">
                                <label class="form-label"><?php echo e(__('message.Email_or_Phone')); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="identifier" class="form-control"
                                    placeholder="" autocomplete="username">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['identifier'];
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

                            <button type="button" wire:click="sendOtp"
                                class="btn btn-outline-light w-100 btn-size mt-1"><?php echo e(__('message.Sign_In')); ?></button>

                            <div class="text-center dont-have mt-3"><?php echo e(__('message.Dont_have_an_account_yet')); ?>? <a
                                    href="<?php echo e(route('register')); ?>"><?php echo e(__('message.Register')); ?></a></div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step === 2): ?>
                        <p class="account-subtitle"><?php echo e(__('message.Enter_Verification_Code')); ?></p>

                        <div>
                            <div class="input-block">
                                <label class="form-label"><?php echo e(__('message.Enter_Verification_Code')); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="otp" class="form-control text-center"
                                    placeholder="______" inputmode="numeric" autocomplete="one-time-code" maxlength="6"
                                    style="font-size:1.15rem; letter-spacing:0.35rem;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['otp'];
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

                            <div class="input-block d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <a href="#" class="forgot-link m-0" wire:click.prevent="$set('step', 1)"><i
                                        class="fe feather-arrow-left" aria-hidden="true"></i>
                                    <?php echo e(__('message.Back')); ?></a>
                                <a href="#" class="forgot-link m-0" wire:click.prevent="resendOtp"><?php echo e(__('message.Resend_Code')); ?></a>
                            </div>

                            <button type="button" wire:click="verifyOtp"
                                class="btn btn-outline-light w-100 btn-size mt-1"><?php echo e(__('message.Verify_Now')); ?></button>

                            <div class="text-center dont-have mt-3"><?php echo e(__('message.Dont_have_an_account_yet')); ?>? <a
                                    href="<?php echo e(route('register')); ?>"><?php echo e(__('message.Register')); ?></a></div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\dell\Desktop\plate\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>