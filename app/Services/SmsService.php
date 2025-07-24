<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected string $provider;
    protected array $config;

    public function __construct()
    {
        $this->provider = config('sms.default_provider', 'twilio');
        $this->config = config('sms.providers.' . $this->provider, []);
    }

    /**
     * Send SMS verification code
     */
    public function sendVerificationCode(string $phoneNumber, string $code): bool
    {
        try {
            $message = $this->buildVerificationMessage($code);
            
            switch ($this->provider) {
                case 'log':
                    return $this->sendViaLog($phoneNumber, $message, $code);
                case 'twilio':
                    return $this->sendViaTwilio($phoneNumber, $message);
                case 'sms_to':
                    return $this->sendViaSmsTo($phoneNumber, $message);
                case 'local_uae':
                    return $this->sendViaLocalUAE($phoneNumber, $message);
                default:
                    Log::error('Unknown SMS provider: ' . $this->provider);
                    return false;
            }
        } catch (Exception $e) {
            Log::error('SMS sending failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Build verification message
     */
    protected function buildVerificationMessage(string $code): string
    {
        $appName = config('app.name');
        return "Your {$appName} verification code is: {$code}. Valid for 5 minutes. Do not share this code.";
    }

    /**
     * Send SMS via Log (for development/testing)
     */
    protected function sendViaLog(string $phoneNumber, string $message, string $code): bool
    {
        $formattedNumber = $this->formatPhoneNumber($phoneNumber);
        
        Log::info("📱 SMS VERIFICATION CODE", [
            'phone' => $formattedNumber,
            'code' => $code,
            'message' => $message,
            'timestamp' => now()->toDateTimeString()
        ]);
        
        // Also log in a simple format for easy reading
        Log::info("🔐 VERIFICATION CODE FOR {$formattedNumber}: {$code}");
        
        return true;
    }

    /**
     * Send SMS via Twilio
     */
    protected function sendViaTwilio(string $phoneNumber, string $message): bool
    {
        $response = Http::asForm()
            ->withBasicAuth($this->config['sid'], $this->config['token'])
            ->post("https://api.twilio.com/2010-04-01/Accounts/{$this->config['sid']}/Messages.json", [
                'From' => $this->config['from'],
                'To' => $this->formatPhoneNumber($phoneNumber),
                'Body' => $message,
            ]);

        return $response->successful();
    }

    /**
     * Send SMS via SMS.to
     */
    protected function sendViaSmsTo(string $phoneNumber, string $message): bool
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->config['api_key'],
            'Content-Type' => 'application/json',
        ])->post('https://api.sms.to/sms/send', [
            'to' => $this->formatPhoneNumber($phoneNumber),
            'message' => $message,
            'sender_id' => $this->config['sender_id'] ?? config('app.name'),
        ]);

        return $response->successful();
    }

    /**
     * Send SMS via Local UAE Provider (example implementation)
     */
    protected function sendViaLocalUAE(string $phoneNumber, string $message): bool
    {
        // This is a placeholder for local UAE SMS providers
        // Replace with actual provider API implementation
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->config['api_key'],
        ])->post($this->config['endpoint'], [
            'mobile' => $this->formatPhoneNumber($phoneNumber),
            'message' => $message,
            'sender' => $this->config['sender_id'],
        ]);   

        return $response->successful();
    }

    /**
     * Format phone number for UAE
     */
    protected function formatPhoneNumber(string $phoneNumber): string
    {
        // Remove any non-numeric characters
        $clean = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Add UAE country code if not present
        if (!str_starts_with($clean, '971')) {
            // Remove leading zero if present
            $clean = ltrim($clean, '0');
            $clean = '971' . $clean;
        }
        
        return '+' . $clean;
    }

    /**
     * Test SMS configuration
     */
    public function testConfiguration(): bool
    {
        try {
            // Send a test message to a dummy number for validation
            $testNumber = '+971501234567';
            $testMessage = 'Test message from ' . config('app.name');
            
            return $this->sendTestMessage($testNumber, $testMessage);
        } catch (Exception $e) {
            Log::error('SMS configuration test failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send test message (without actually sending)
     */
    protected function sendTestMessage(string $phoneNumber, string $message): bool
    {
        // In production, you might want to send to a test number
        // For now, just validate the configuration
        return !empty($this->config['api_key']) || 
               (!empty($this->config['sid']) && !empty($this->config['token']));
    }
} 