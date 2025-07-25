@extends('layouts.auth')

@section('title', __('message.Verify_Phone_Number') . ' - ' . config('app.name'))
@section('meta_description', __('message.Verify_Phone_Meta_Description'))

@section('content')
<div class="phone-verification-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="verification-card">
                    <!-- Header -->
                    <div class="verification-header text-center mb-4">
                        <div class="verification-icon mb-3">
                            <i class="bx bx-phone text-primary" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="h3 mb-2">{{ __('message.Verify_Phone_Number') }}</h2>
                        
                        @if(isset($autoSent) && $autoSent)
                            <div class="alert alert-success alert-sm mb-3">
                                <i class="bx bx-check-circle me-2"></i>
                                {{ __('message.Verification_Code_Sent_Automatically') }}
                            </div>
                            <p class="text-muted mb-0">
                                {{ __('message.Code_Sent_To') }} <strong>{{ $phoneNumber }}</strong>
                            </p>
                        @else
                            <p class="text-muted mb-0">
                                {{ __('message.Enter_Code_Or_Request_New') }}
                                <strong>{{ $phoneNumber }}</strong>
                            </p>
                        @endif
                    </div>

                    <!-- Dynamic Message Container -->
                    <div id="messageContainer" class="mb-3" style="display: none;">
                        <div class="alert alert-dismissible fade show" role="alert" id="messageAlert">
                            <span id="messageText"></span>
                            <button type="button" class="btn-close" onclick="hideMessage()"></button>
                        </div>
                    </div>

                    @if($isBlocked)
                            <!-- Blocked State -->
                            <div class="alert alert-danger text-center">
                                <i class="bx bx-error-circle me-2"></i>
                                {{ __('message.Too_Many_Verification_Attempts') }}
                                <br>
                                <small>{{ __('message.Contact_Support_To_Unlock') }}</small>
                            </div>
                        @else
                            <!-- Verification Form -->
                            <form id="verificationForm" method="POST" action="{{ route('phone.verify.confirm') }}">
                                @csrf
                                
                                <!-- OTP Input -->
                                <div class="otp-input-group mb-4">
                                    <label class="form-label text-center w-100 mb-3">
                                        {{ __('message.Enter_Verification_Code') }}
                                    </label>
                                    <div class="otp-inputs d-flex justify-content-center gap-2 mb-3">
                                        @for($i = 0; $i < 6; $i++)
                                            <input type="text" 
                                                   class="otp-digit form-control text-center" 
                                                   maxlength="1" 
                                                   inputmode="numeric"
                                                   pattern="[0-9]"
                                                   data-index="{{ $i }}"
                                                   {{ $i === 0 ? 'autofocus' : '' }}>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="code" id="completeCode">
                                    @error('code')
                                        <div class="text-danger text-center small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100" id="verifyButton" disabled>
                                        <span class="btn-text">{{ __('message.Verify_Phone') }}</span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm me-2"></span>
                                            {{ __('message.Verifying') }}...
                                        </span>
                                    </button>
                                </div>
                            </form>

                            <!-- Resend Section -->
                            <div class="resend-section text-center">
                                <p class="text-muted mb-2">{{ __('message.Didnt_Receive_Code') }}</p>
                                
                                @if($canResend)
                                    <form method="POST" action="{{ route('phone.verify.send') }}" id="resendForm">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary" id="resendButton">
                                            <span class="btn-text">
                                                <i class="bx bx-refresh me-1"></i>
                                                {{ __('message.Resend_Code') }}
                                            </span>
                                            <span class="btn-loading d-none">
                                                <span class="spinner-border spinner-border-sm me-2"></span>
                                                {{ __('message.Sending') }}...
                                            </span>
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-outline-secondary" disabled id="resendTimer">
                                        <i class="bx bx-time me-1"></i>
                                        <span id="timerText">{{ __('message.Resend_Available_In') }} <span id="countdown">60</span>s</span>
                                    </button>
                                @endif
                            </div>

                            <!-- Help Section -->
                            <div class="help-section mt-4 pt-4 border-top">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <a href="{{ route('user.profile') }}" class="btn btn-link btn-sm">
                                            <i class="bx bx-edit me-1"></i>
                                            {{ __('message.Change_Phone_Number') }}
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('contact') }}" class="btn btn-link btn-sm">
                                            <i class="bx bx-help-circle me-1"></i>
                                            {{ __('message.Need_Help') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @if(config('app.debug'))
                                <!-- Skip Option (Development Only) -->
                                <div class="dev-section mt-3 text-center">
                                    <small class="text-muted">Development Mode:</small>
                                    <form method="POST" action="{{ route('phone.verify.skip') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-sm text-warning">
                                            Skip Verification
                                        </button>
                                    </form>
                                </div>
                            @endif
                     
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.phone-verification-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

.verification-card {
    background: white;
    border-radius: 20px;
    padding: 3rem 2rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border: none;
}

.verification-icon {
    width: 80px;
    height: 80px;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.otp-inputs {
    max-width: 300px;
    margin: 0 auto;
}

.otp-digit {
    width: 45px;
    height: 55px;
    font-size: 1.5rem;
    font-weight: bold;
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.otp-digit:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

.otp-digit.filled {
    background-color: #f8f9ff;
    border-color: #667eea;
}

.otp-digit.error {
    border-color: #dc3545;
    background-color: #fff5f5;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.btn-primary:disabled {
    opacity: 0.6;
    transform: none;
}

.resend-section {
    padding: 1rem 0;
}

.help-section a {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.3s ease;
}

.help-section a:hover {
    color: #667eea;
}

@media (max-width: 768px) {
    .verification-card {
        margin: 1rem;
        padding: 2rem 1.5rem;
    }
    
    .otp-digit {
        width: 40px;
        height: 50px;
        font-size: 1.25rem;
    }
    
    .otp-inputs {
        gap: 0.5rem;
    }
}

/* RTL Support */
[dir="rtl"] .otp-inputs {
    direction: ltr; /* Keep OTP input LTR for consistency */
}
</style>

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
            
            // Add filled class
            if (value) {
                e.target.classList.add('filled');
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
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpInputs[index - 1].focus();
                otpInputs[index - 1].value = '';
                otpInputs[index - 1].classList.remove('filled');
                updateCompleteCode();
            }
            
            // Handle paste
            if (e.key === 'v' && e.ctrlKey) {
                e.preventDefault();
                navigator.clipboard.readText().then(text => {
                    const digits = text.replace(/\D/g, '').substring(0, 6);
                    fillOtpInputs(digits);
                });
            }
        });
    });
    
    function updateCompleteCode() {
        const code = Array.from(otpInputs).map(input => input.value).join('');
        completeCodeInput.value = code;
        verifyButton.disabled = code.length !== 6;
        
        // Remove error styling
        otpInputs.forEach(input => input.classList.remove('error'));
    }
    
    function fillOtpInputs(digits) {
        otpInputs.forEach((input, index) => {
            if (digits[index]) {
                input.value = digits[index];
                input.classList.add('filled');
            } else {
                input.value = '';
                input.classList.remove('filled');
            }
        });
        updateCompleteCode();
    }
    
    // Form Submissions
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
                window.location.href = data.redirect;
            } else if (data.message) {
                showMessage(data.message, 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            otpInputs.forEach(input => input.classList.add('error'));
            showMessage('{{ __("message.Verification_Failed") }}', 'danger');
        })
        .finally(() => {
            submitBtn.disabled = false;
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
        });
    });
    
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
                    startResendTimer();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('{{ __("message.Failed_To_Send_SMS") }}', 'danger');
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

        setTimeout(() => {
            hideMessage();
        }, 5000); // Hide after 5 seconds
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
    if (!{{ $canResend ? 'true' : 'false' }}) {
        startResendTimer();
    }
});
</script>
@endsection 