<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Plate</title>
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
        <img src="{{ asset('assets/img/logo.png') }}" alt="Plate Logo" class="logo">
        <h1>Welcome to Plate!</h1>
    </div>
    
    <div class="content">
        <p>Hello {{ $user->name }},</p>
        
        <p>Thank you for registering with Plate! We're excited to have you join our community.</p>
        
        <p>With your new account, you can:</p>
        <ul>
            <li>Browse and search for unique license plates</li>
            <li>List your own plates for sale</li>
            <li>Connect with buyers and sellers</li>
            <li>Manage your listings from your personal dashboard</li>
        </ul>
        
        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        
        <div style="text-align: center;">
            <a href="{{ route('user.dashboard') }}" class="button">Go to My Dashboard</a>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} Plate. All rights reserved.</p>
        <p>This email was sent to {{ $user->email }}</p>
    </div>
</body>
</html>