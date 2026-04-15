<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'otp_sent' => 'We sent a verification code. Enter it below to continue.',
    'otp_cooldown' => 'Please wait before requesting another code.',
    'account_disabled' => 'Your account has been disabled. Please contact support.',
    'otp_not_found' => 'No active verification code found. Request a new code.',
    'otp_expired' => 'This code has expired. Request a new one.',
    'otp_too_many_attempts' => 'Too many incorrect attempts. Request a new code.',
    'otp_invalid' => 'Invalid code. :remaining attempt(s) remaining.',
    'otp_sms_message' => 'Your :app verification code is: :code',
    'otp_email_subject' => 'Your verification code — :app',
    'otp_email_greeting' => 'Hello,',
    'otp_email_body' => 'Use this code to sign in:',
    'otp_email_expiry' => 'This code expires in :minutes minutes.',
    'otp_email_ignore' => 'If you did not request this, you can ignore this email.',

];
