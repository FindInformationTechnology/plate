<?php 

return [
    'driver' => env('OTP_SMS_DRIVER', 'smart_sms'),

    'drivers' => [

        'smart_sms' => [
            'username' => env('SMS_USERNAME'),
            'password' => env('SMS_PASSWORD'),
            'sender'   => env('SMS_SENDER'),
            'url'      => 'https://smartsmsgateway.com/api/api_json.php',
        ],

        'log' => [
            'channel' => 'stack',
        ],

        'otp_length' => 6,
        'otp_expiry' => 3000, // seconds

    ],
];