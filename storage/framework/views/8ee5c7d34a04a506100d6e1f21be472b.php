<div>
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow">

<h2 class="text-xl font-bold mb-4 text-center">
    <?php echo e($step === 1 ? 'Login' : 'Enter OTP'); ?>

</h2>


<!--[if BLOCK]><![endif]--><?php if($step === 1): ?>

    <div class="space-y-4">

        <input
            type="text"
            wire:model.defer="identifier"
            placeholder="Enter phone or email"
            class="w-full border rounded px-3 py-2"
        >

        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['identifier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

        <button
            wire:click="sendOtp"
            class="w-full bg-blue-600 text-white py-2 rounded"
        >
            Continue
        </button>

    </div>

<?php endif; ?><!--[if ENDBLOCK]><![endif]-->


<!--[if BLOCK]><![endif]--><?php if($step === 2): ?>

    <div class="space-y-4">

        <input
            type="text"
            wire:model.defer="otp"
            placeholder="Enter OTP"
            class="w-full border rounded px-3 py-2 text-center tracking-widest"
        >

        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

        <button
            wire:click="verifyOtp"
            class="w-full bg-green-600 text-white py-2 rounded"
        >
            Verify & Login
        </button>

        <button
            wire:click="resendOtp"
            class="text-sm text-blue-500 underline"
        >
            Resend OTP
        </button>

    </div>

<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div>
</div>
<?php /**PATH C:\Users\dell\Desktop\plate\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>