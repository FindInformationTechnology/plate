<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default SMS Provider
    |--------------------------------------------------------------------------
    |
    | This option controls the default SMS provider that will be used
    | to send verification codes and other SMS messages.
    |
    | Supported: "vonage", "unifonic", "twilio", "log"
    |
    */
    'default_provider' => env('SMS_PROVIDER', 'unifonic'),

    /*
    |--------------------------------------------------------------------------
    | SMS Providers Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the SMS providers for your application.
    |
    */
    'providers' => [
        'log' => [
            // Log provider doesn't need configuration
            // It will log SMS messages to Laravel logs for development
        ],
        
        'vonage' => [
            'key' => env('VONAGE_KEY'),
            'secret' => env('VONAGE_SECRET'),
            'from' => env('VONAGE_SMS_FROM', 'PLATE35'),
        ],

        'unifonic' => [
            'app_id' => env('UNIFONIC_APP_ID'),
            'sender_id' => env('UNIFONIC_SENDER_ID', 'PLATE35'),
        ],

        'twilio' => [
            'sid' => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from' => env('TWILIO_FROM'),
            'alpha_sender' => env('TWILIO_ALPHA_SENDER', 'PLATE35'),
        ],
        

        'sms_to' => [
            'api_key' => env('SMS_TO_API_KEY'),
            'sender_id' => env('SMS_TO_SENDER_ID', 'Plate'),
        ],

        'local_uae' => [
            'api_key' => env('UAE_SMS_API_KEY'),
            'endpoint' => env('UAE_SMS_ENDPOINT'),
            'sender_id' => env('UAE_SMS_SENDER_ID', 'Plate'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Rate limiting configuration for SMS sending
    |
    */
    'rate_limiting' => [
        'max_attempts_per_hour' => 5,
        'max_attempts_per_day' => 20,
        'cooldown_minutes' => 1,
    ],

    /*
    |--------------------------------------------------------------------------
    | Message Templates
    |--------------------------------------------------------------------------
    |
    | Default message templates for different types of SMS
    |
    */
    'templates' => [
        'verification' => 'Your :app verification code is: :code. Valid for 5 minutes. Do not share this code.',
        'welcome' => 'Welcome to :app! Your phone number has been successfully verified.',
    ],
]; 