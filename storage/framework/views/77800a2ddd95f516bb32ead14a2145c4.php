<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e(config('app.name')); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
        }
        h1 {
            color: #127384;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .button {
            display: inline-block;
            background-color: #127384;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="<?php echo e(asset('assets/img/logo-b.png')); ?>" alt="Plate Logo" class="logo">
        <h1>Welcome to <?php echo e(config('app.name')); ?>!</h1>
    </div>
    
    <div class="content">
        <p>Hello <?php echo e($user->name); ?>,</p>
        
        <p>Thank you for registering with Plate35! We're excited to have you join our community.</p>
        
        <p>With your new account, you can:</p>
        <ul>
            <li>Browse and search for unique license plates</li>
            <li>List your own plates for sale</li>
            <li>Connect with buyers and sellers</li>
            <li>Manage your listings from your personal dashboard</li>
        </ul>
        
        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        
        <div style="text-align: center;">
            <a href="<?php echo e(route('user.dashboard')); ?>" class="button">Go to My Dashboard</a>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; <?php echo e(date('Y')); ?> Plate. All rights reserved.</p>
        <p>This email was sent to <?php echo e($user->email); ?></p>
    </div>
</body>
</html><?php /**PATH C:\Users\dell\Desktop\plate\resources\views/emails/welcome.blade.php ENDPATH**/ ?>