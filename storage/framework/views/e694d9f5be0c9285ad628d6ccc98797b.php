<!DOCTYPE html>
<html>
<head>
    <title>Test Resend Functionality</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Test Resend SMS Functionality</h4>
                    </div>
                    <div class="card-body">
                        <!-- Message Container -->
                        <div id="messageContainer" class="mb-3" style="display: none;">
                            <div class="alert alert-dismissible fade show" role="alert" id="messageAlert">
                                <span id="messageText"></span>
                                <button type="button" class="btn-close" onclick="hideMessage()"></button>
                            </div>
                        </div>

                        <p><strong>User:</strong> <?php echo e(auth()->user()->name); ?></p>
                        <p><strong>Phone:</strong> <?php echo e(auth()->user()->phone); ?></p>
                        <p><strong>Can Request New Code:</strong> <?php echo e(auth()->user()->canRequestNewVerificationCode() ? 'Yes' : 'No'); ?></p>
                        
                        <form id="testResendForm" action="<?php echo e(route('phone.verify.send')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary" id="testResendButton">
                                <span class="btn-text">Send Test SMS</span>
                                <span class="btn-loading d-none">
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Sending...
                                </span>
                            </button>
                        </form>

                        <hr>
                        <p><strong>Instructions:</strong></p>
                        <ol>
                            <li>Click "Send Test SMS"</li>
                            <li>Check for success message above</li>
                            <li>Check Laravel logs for verification code</li>
                        </ol>
                        
                        <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-secondary mt-3">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const testForm = document.getElementById('testResendForm');
            
            testForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const testBtn = document.getElementById('testResendButton');
                const btnText = testBtn.querySelector('.btn-text');
                const btnLoading = testBtn.querySelector('.btn-loading');
                
                testBtn.disabled = true;
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
                
                fetch(testForm.action, {
                    method: 'POST',
                    body: new FormData(testForm),
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
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Failed to send SMS. Please try again later.', 'danger');
                })
                .finally(() => {
                    testBtn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                });
            });
        });

        function showMessage(message, type) {
            const messageContainer = document.getElementById('messageContainer');
            const messageAlert = document.getElementById('messageAlert');
            const messageText = document.getElementById('messageText');

            messageText.textContent = message;
            messageAlert.classList.remove('alert-success', 'alert-danger', 'alert-info', 'alert-warning');
            messageAlert.classList.add(`alert-${type}`);
            messageContainer.style.display = 'block';

            setTimeout(() => {
                hideMessage();
            }, 5000);
        }

        function hideMessage() {
            const messageContainer = document.getElementById('messageContainer');
            messageContainer.style.display = 'none';
        }
    </script>
</body>
</html> <?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/test-resend.blade.php ENDPATH**/ ?>