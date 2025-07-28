

<?php $__env->startSection('title', __('message.Verify_Phone_Number') . ' - ' . config('app.name')); ?>
<?php $__env->startSection('meta_description', __('message.Verify_Phone_Meta_Description')); ?>

<?php $__env->startSection('content'); ?>
<section class="section product-details">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card verification-card">
                    <!-- Header -->
                    <div class="card-header text-center bg-transparent border-0 pt-4">
                        <div class="verification-icon mb-3">
                            <i class="bx bx-phone text-primary"></i>
                        </div>
                        <h4 class="mb-2"><?php echo e(__('message.Verify_Phone_Number')); ?></h4>

                        <?php if(isset($autoSent) && $autoSent): ?>
                        <div class="alert alert-success alert-sm mb-3">
                            <i class="bx bx-check-circle me-2"></i>
                            <?php echo e(__('message.Verification_Code_Sent_Automatically')); ?>

                        </div>
                        <p class="text-muted mb-0">
                            <?php echo e(__('message.Code_Sent_To')); ?> <strong><?php echo e($phoneNumber); ?></strong>
                        </p>
                        <?php else: ?>
                        <p class="text-muted mb-0">
                            <?php echo e(__('message.Enter_Code_Or_Request_New')); ?>

                            <strong><?php echo e($phoneNumber); ?></strong>
                        </p>
                        <?php endif; ?>
                    </div>

                    <div class="card-body px-4 pb-4">
                        <!-- Dynamic Message Container -->
                        <div id="messageContainer" class="mb-3" style="display: none;">
                            <div class="alert alert-dismissible fade show" role="alert" id="messageAlert">
                                <span id="messageText"></span>
                                <button type="button" class="btn-close" onclick="hideMessage()"></button>
                            </div>
                        </div>

                        <?php if($isBlocked): ?>
                        <!-- Blocked State -->
                        <div class="alert alert-danger text-center">
                            <i class="bx bx-error-circle me-2"></i>
                            <?php echo e(__('message.Too_Many_Verification_Attempts')); ?>

                            <br>
                            <small><?php echo e(__('message.Contact_Support_To_Unlock')); ?></small>
                        </div>
                        <?php else: ?>
                        <!-- Verification Form -->
                        <form id="verificationForm" method="POST" action="<?php echo e(route('phone.verify.confirm')); ?>">
                            <?php echo csrf_field(); ?>

                            <!-- OTP Input -->
                            <div class="otp-input-group mb-4">
                                <label class="form-label text-center w-100 mb-3 fw-semibold">
                                    <?php echo e(__('message.Enter_Verification_Code')); ?>

                                </label>
                                <div class="otp-inputs d-flex justify-content-center gap-2 mb-3" dir="ltr">
                                    <?php for($i = 0; $i < 6; $i++): ?> 
                                    <input type="text" 
                                           class="otp-digit form-control text-center"
                                           maxlength="1" 
                                           inputmode="numeric" 
                                           pattern="[0-9]" 
                                           data-index="<?php echo e($i); ?>"
                                           autocomplete="off"
                                           <?php echo e($i === 0 ? 'autofocus' : ''); ?>>
                                    <?php endfor; ?>
                                </div>
                                <input type="hidden" name="code" id="completeCode">
                                <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger text-center small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg" id="verifyButton" disabled>
                                    <span class="btn-text"><?php echo e(__('message.Verify_Phone')); ?></span>
                                    <span class="btn-loading d-none">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        <?php echo e(__('message.Verifying')); ?>...
                                    </span>
                                </button>
                            </div>
                        </form>

                        <!-- Resend Section -->
                        <div class="resend-section text-center">
                            <p class="text-muted mb-3"><?php echo e(__('message.Didnt_Receive_Code')); ?></p>

                            <?php if($canResend): ?>
                            <form method="POST" action="<?php echo e(route('phone.verify.send')); ?>" id="resendForm">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-primary" id="resendButton">
                                    <span class="btn-text">
                                        <i class="bx bx-refresh me-1"></i>
                                        <?php echo e(__('message.Resend_Code')); ?>

                                    </span>
                                    <span class="btn-loading d-none">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        <?php echo e(__('message.Sending')); ?>...
                                    </span>
                                </button>
                            </form>
                            <?php else: ?>
                            <button class="btn btn-outline-secondary" disabled id="resendTimer">
                                <i class="bx bx-time me-1"></i>
                                <span id="timerText"><?php echo e(__('message.Resend_Available_In')); ?> <span
                                        id="countdown">60</span>s</span>
                            </button>
                            <?php endif; ?>
                        </div>

                        <?php endif; ?>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-transparent border-0">
                        <!-- Help Section -->
                        <div class="help-section">
                            <div class="row text-center g-2">
                                <div class="col-6">
                                    <a href="<?php echo e(route('user.profile')); ?>" class="btn btn-link btn-sm w-100">
                                        <i class="bx bx-edit me-1"></i>
                                        <span class="d-none d-sm-inline"><?php echo e(__('message.Change_Phone_Number')); ?></span>
                                        <span class="d-sm-none"><?php echo e(__('message.Change_Phone')); ?></span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="<?php echo e(route('contact')); ?>" class="btn btn-link btn-sm w-100">
                                        <i class="bx bx-help-circle me-1"></i>
                                        <?php echo e(__('message.Need_Help')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php if(config('app.debug')): ?>
                        <!-- Skip Option (Development Only) -->
                        <div class="dev-section mt-3 text-center">
                            <small class="">Development Mode:</small>
                            <form method="POST" action="<?php echo e(route('phone.verify.skip')); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-link btn-sm text-warning">
                                    Skip Verification
                                </button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Phone Verification Styling */
.verification-card {
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

.verification-icon {
    width: 70px;
    height: 70px;
    background: rgba(172, 30, 35, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2.5rem;
}

/* OTP Input Styling */
.otp-inputs {
    max-width: 320px;
    margin: 0 auto;
}

.otp-digit {
    width: 45px;
    height: 50px;
    font-size: 1.25rem;
    font-weight: 600;
    border: 2px solid #e0e6ed;
    border-radius: 8px;
    transition: all 0.3s ease;
    background-color: #fff;
}

.otp-digit:focus {
    border-color: var(--main-color, #AC1E23);
    box-shadow: 0 0 0 3px rgba(172, 30, 35, 0.1);
    outline: none;
    background-color: #fff;
}

.otp-digit.filled {
    background-color: rgba(172, 30, 35, 0.05);
    border-color: var(--main-color, #AC1E23);
    color: var(--main-color, #AC1E23);
}

.otp-digit.error {
    border-color: #dc3545;
    background-color: rgba(220, 53, 69, 0.05);
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Button Styling */
.btn-primary {
    background-color: var(--main-color, #AC1E23);
    border-color: var(--main-color, #AC1E23);
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #8a1a1f;
    border-color: #8a1a1f;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(172, 30, 35, 0.3);
}

.btn-primary:disabled {
    opacity: 0.6;
    transform: none;
    box-shadow: none;
}

.btn-outline-primary {
    border-color: var(--main-color, #AC1E23);
    color: var(--main-color, #AC1E23);
}

.btn-outline-primary:hover {
    background-color: var(--main-color, #AC1E23);
    border-color: var(--main-color, #AC1E23);
}

/* Alert Styling */
.alert {
    border-radius: 8px;
    border: none;
}

.alert-success {
    background-color: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

/* Help Section */
.help-section {
    padding: 1rem 0;
    border-top: 1px solid #e9ecef;
}

.help-section .btn-link {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.3s ease;
    padding: 0.5rem;
}

.help-section .btn-link:hover {
    color: var(--main-color, #AC1E23);
}

/* RTL Support for Arabic */
[dir="rtl"] .otp-inputs {
    direction: ltr; /* Keep OTP inputs LTR for consistency */
}

[dir="rtl"] .me-1,
[dir="rtl"] .me-2 {
    margin-right: 0 !important;
    margin-left: 0.25rem !important;
}

[dir="rtl"] .text-center {
    text-align: center !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .verification-card {
        margin: 1rem 0.5rem;
        border-radius: 12px;
    }
    
    .card-header,
    .card-body,
    .card-footer {
        padding: 1.5rem 1rem;
    }

    .otp-digit {
        width: 40px;
        height: 45px;
        font-size: 1.1rem;
    }

    .otp-inputs {
        gap: 0.75rem !important;
        max-width: 280px;
    }
    
    .verification-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
    
    .btn-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .verification-card {
        margin: 0.5rem 0;
    }
    
    .card-header,
    .card-body,
    .card-footer {
        padding: 1rem 0.75rem;
    }

    .otp-digit {
        width: 35px;
        height: 40px;
        font-size: 1rem;
    }

    .otp-inputs {
        gap: 0.5rem !important;
        max-width: 240px;
    }
    
    h4 {
        font-size: 1.25rem;
    }
    
    .help-section .btn-link {
        font-size: 0.875rem;
        padding: 0.375rem;
    }
}

/* Loading States */
.btn-loading {
    display: flex;
    align-items: center;
    justify-content: center;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}

/* Focus Enhancement */
.form-control:focus {
    border-color: var(--main-color, #AC1E23);
    box-shadow: 0 0 0 0.2rem rgba(172, 30, 35, 0.25);
}

/* Animation for Success */
.otp-digit.success {
    border-color: #198754;
    background-color: rgba(25, 135, 84, 0.05);
    animation: bounce 0.5s ease-in-out;
}

@keyframes bounce {
    0%, 20%, 60%, 100% { transform: translateY(0); }
    40% { transform: translateY(-5px); }
    80% { transform: translateY(-3px); }
}

/* Print Styles */
@media print {
    .btn,
    .help-section,
    .dev-section {
        display: none !important;
    }
    
    .verification-card {
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .otp-digit {
        border-width: 3px;
    }
    
    .otp-digit:focus {
        border-width: 4px;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .otp-digit,
    .btn-primary,
    .help-section .btn-link {
        transition: none;
    }
    
    .otp-digit.error {
        animation: none;
        border-color: #dc3545;
    }
    
    .otp-digit.success {
        animation: none;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-digit');
    const completeCodeInput = document.getElementById('completeCode');
    const verifyButton = document.getElementById('verifyButton');
    const verificationForm = document.getElementById('verificationForm');
    const resendForm = document.getElementById('resendForm');

    // OTP Input Handling
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;

            // Only allow digits
            if (!/^\d$/.test(value) && value !== '') {
                e.target.value = '';
                return;
            }

            // Add filled class and move to next input
            if (value) {
                e.target.classList.add('filled');
                e.target.classList.remove('error');
                
                // Move to next input
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            } else {
                e.target.classList.remove('filled');
            }

            updateCompleteCode();
        });

        input.addEventListener('keydown', function(e) {
            // Handle backspace
            if (e.key === 'Backspace') {
                if (!e.target.value && index > 0) {
                    // Move to previous input and clear it
                    otpInputs[index - 1].focus();
                    otpInputs[index - 1].value = '';
                    otpInputs[index - 1].classList.remove('filled');
                    updateCompleteCode();
                } else if (e.target.value) {
                    // Clear current input
                    e.target.value = '';
                    e.target.classList.remove('filled');
                    updateCompleteCode();
                }
                e.preventDefault();
            }

            // Handle paste
            if ((e.ctrlKey || e.metaKey) && e.key === 'v') {
                e.preventDefault();
                navigator.clipboard.readText().then(text => {
                    const digits = text.replace(/\D/g, '').substring(0, 6);
                    fillOtpInputs(digits);
                }).catch(err => {
                    console.log('Could not read clipboard: ', err);
                });
            }

            // Handle arrow keys for navigation
            if (e.key === 'ArrowLeft' && index > 0) {
                otpInputs[index - 1].focus();
                e.preventDefault();
            } else if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
                e.preventDefault();
            }
        });

        // Handle focus events
        input.addEventListener('focus', function() {
            // Select all text when focusing
            setTimeout(() => {
                this.select();
            }, 10);
        });
    });

    function updateCompleteCode() {
        const code = Array.from(otpInputs).map(input => input.value).join('');
        completeCodeInput.value = code;
        verifyButton.disabled = code.length !== 6;

        // Remove error styling from all inputs
        otpInputs.forEach(input => input.classList.remove('error'));
    }

    function fillOtpInputs(digits) {
        otpInputs.forEach((input, index) => {
            if (digits[index]) {
                input.value = digits[index];
                input.classList.add('filled');
                input.classList.remove('error');
            } else {
                input.value = '';
                input.classList.remove('filled');
            }
        });
        updateCompleteCode();
        
        // Focus last filled input or first empty input
        const lastFilledIndex = digits.length - 1;
        if (lastFilledIndex < otpInputs.length - 1) {
            otpInputs[lastFilledIndex + 1].focus();
        }
    }

    // Form Submissions
    if (verificationForm) {
        verificationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (completeCodeInput.value.length !== 6) {
                return;
            }

            const submitBtn = verifyButton;
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            submitBtn.disabled = true;
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');

            // Submit form
            fetch(verificationForm.action, {
                method: 'POST',
                body: new FormData(verificationForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect) {
                    // Add success animation before redirect
                    otpInputs.forEach(input => {
                        input.classList.add('success');
                        input.classList.remove('error');
                    });
                    
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 500);
                } else if (data.message) {
                    showMessage(data.message, 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Add error animation
                otpInputs.forEach(input => {
                    input.classList.add('error');
                    input.classList.remove('filled', 'success');
                });
                
                showMessage('<?php echo e(__("message.Verification_Failed")); ?>', 'danger');
                
                // Clear inputs and focus first input
                otpInputs.forEach(input => input.value = '');
                updateCompleteCode();
                otpInputs[0].focus();
            })
            .finally(() => {
                submitBtn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoading.classList.add('d-none');
            });
        });
    }

    if (resendForm) {
        resendForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const resendBtn = document.getElementById('resendButton');
            const btnText = resendBtn.querySelector('.btn-text');
            const btnLoading = resendBtn.querySelector('.btn-loading');

            resendBtn.disabled = true;
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');

            fetch(resendForm.action, {
                method: 'POST',
                body: new FormData(resendForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.message) {
                    showMessage(data.message, 'success');
                    
                    // Clear OTP inputs for new code
                    otpInputs.forEach(input => {
                        input.value = '';
                        input.classList.remove('filled', 'error', 'success');
                    });
                    updateCompleteCode();
                    otpInputs[0].focus();
                    
                    startResendTimer();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('<?php echo e(__("message.Failed_To_Send_SMS")); ?>', 'danger');
            })
            .finally(() => {
                resendBtn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoading.classList.add('d-none');
            });
        });
    }

    function showMessage(message, type) {
        const messageContainer = document.getElementById('messageContainer');
        const messageAlert = document.getElementById('messageAlert');
        const messageText = document.getElementById('messageText');

        // Check if all elements exist
        if (!messageContainer || !messageAlert || !messageText) {
            console.error('Message elements not found');
            alert(message); // Fallback to alert
            return;
        }

        messageText.textContent = message;
        messageAlert.classList.remove('alert-success', 'alert-danger', 'alert-info', 'alert-warning');
        messageAlert.classList.add(`alert-${type}`);
        messageContainer.style.display = 'block';

        // Auto-hide after 5 seconds
        setTimeout(() => {
            hideMessage();
        }, 5000);
    }

    function hideMessage() {
        const messageContainer = document.getElementById('messageContainer');
        if (messageContainer) {
            messageContainer.style.display = 'none';
        }
    }

    function startResendTimer() {
        const timerButton = document.getElementById('resendTimer');
        const countdown = document.getElementById('countdown');

        // Check if timer elements exist
        if (!timerButton || !countdown) {
            return;
        }

        let seconds = 60;

        const timer = setInterval(() => {
            seconds--;
            if (countdown) {
                countdown.textContent = seconds;
            }

            if (seconds <= 0) {
                clearInterval(timer);
                location.reload(); // Refresh to show resend button
            }
        }, 1000);
    }

    // Auto-start timer if resend is not available
    <?php if(!$canResend): ?>
    startResendTimer();
    <?php endif; ?>

    // Auto-focus first input on page load
    if (otpInputs[0]) {
        otpInputs[0].focus();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/auth/verify-phone.blade.php ENDPATH**/ ?>