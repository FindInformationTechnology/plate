<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Http;
use App\Notifications\Auth\OtpNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class OtpSenderService
{
    /**
     * Dispatch an OTP to the given identifier through the appropriate channel.
     */
    public function send(string $identifier, string $channel, string $plainCode): void
    {
        try {
            match ($channel) {
                'phone' => $this->sendSms($identifier, $plainCode),
                'email' => $this->sendEmail($identifier, $plainCode),
            };
        } catch (\Throwable $e) {
            Log::error('OTP send failed', [
                'channel' => $channel,
                'error'   => $e->getMessage(),
            ]);

            // Re-throw so controller can handle gracefully
            throw $e;
        }
    }

    // ─── Channels ────────────────────────────────────────────────────────────────

    private function sendSms(string $phone, string $code): void
    {
        // Unifonic integration (swap driver in config/otp.php)
        $driver = config('otp.driver', 'smart_sms');

        // Log::info("[OTP SMS] {$phone} → {$code}");
        // $this->sendViaSmartSmsGateway($phone, $code);
        // dev only
        match ($driver) {
            'smart_sms' =>  $this->sendViaSmartSmsGateway($phone, $code),
            'unifonic' => $this->sendViauUnifonic($phone, $code),
            'twilio'   => $this->sendViaTwilio($phone, $code),
            'log'      => Log::info("[OTP SMS] {$phone} → {$code}"), // dev only
        };
    }

    private function sendEmail(string $email, string $code): void
    {
        
        // Uses Laravel Notification system
        Notification::route('mail', $email)
            ->notify(new OtpNotification($code, 'email'));
    }

    // ─── SMS Providers ───────────────────────────────────────────────────────────

    private function sendViauUnifonic(string $phone, string $code): void
    {
        // $appSid   = config('otp.unifonic.app_sid');
        // $senderId = config('otp.unifonic.sender_id');
        // $message  = __('auth.otp_sms_message', ['code' => $code, 'app' => config('app.name')]);

        // $response = \Illuminate\Support\Facades\Http::asForm()
        //     ->post('https://el.cloud.unifonic.com/rest/SMS/messages', [
        //         'AppSid'    => $appSid,
        //         'SenderID'  => $senderId,
        //         'Body'      => $message,
        //         'Recipient' => ltrim($phone, '+'), // Unifonic expects no leading +
        //     ]);

        // if (! $response->successful()) {
        //     throw new \RuntimeException('Unifonic SMS failed: ' . $response->body());
        // }
    }

    private function sendViaTwilio(string $phone, string $code): void
    {
        // Twilio integration placeholder
        // $twilio = new \Twilio\Rest\Client(config('otp.twilio.sid'), config('otp.twilio.token'));
        // $twilio->messages->create($phone, ['from' => config('otp.twilio.from'), 'body' => "Your OTP: {$code}"]);
        Log::info("[OTP Twilio stub] {$phone} → {$code}");
    }

    private function sendViaSmartSmsGateway(string $phone, string $code) : void {
        $message = "Your OTP is {$code} for Plate35.com";

        $response = Http::get('https://smartsmsgateway.com/api/api_json.php', [
            'username' => config('services.sms.username'),
            'password' => config('services.sms.password'),
            'senderid' => config('services.sms.sender'),
            'to'       => $phone,
            'text'     => $message,
            'type'     => 'text', // use 'unicode' for Arabic
        ]);

        \Log::info($response->body());
    }
}
