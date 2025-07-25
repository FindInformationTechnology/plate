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
    | Supported: "log", "twilio", "sms_to", "local_uae"
    |
    */
    'default_provider' => env('SMS_PROVIDER', 'log'),

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

        'twilio' => [
            'sid' => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from' => env('TWILIO_FROM'),
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