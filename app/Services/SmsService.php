<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SmsService
{
    protected string $provider;
    protected array $config;

    public function __construct()
    {
        $this->provider = config('sms.default_provider', 'vonage');
        $this->config = config('sms.providers.' . $this->provider, []);
    }

    /**
     * Send SMS verification code with fallback providers
     */
    public function sendVerificationCode(string $phoneNumber, string $code): bool
    {
        $message = $this->buildVerificationMessage($code);
        
        // Try providers in order of preference for UAE
        $providers = ['vonage', 'unifonic', 'twilio'];
        
        foreach ($providers as $provider) {
            try {
                $config = config('sms.providers.' . $provider, []);
                if (empty($config) || !$this->isProviderConfigured($provider)) {
                    continue;
                }

                $success = match($provider) {
                    'vonage' => $this->sendViaVonage($phoneNumber, $message, $config),
                    'unifonic' => $this->sendViaUnifonic($phoneNumber, $message, $config),
                    'twilio' => $this->sendViaTwilio($phoneNumber, $message, $config),
                    default => false
                };
                
                if ($success) {
                    Log::info("SMS sent successfully via {$provider}", [
                        'phone' => $this->maskPhoneNumber($phoneNumber),
                        'provider' => $provider,
                        'platform' => 'plate35.com'
                    ]);
                    return true;
                }
            } catch (\Exception $e) {
                Log::warning("SMS failed via {$provider}", [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'provider' => $provider,
                    'error' => $e->getMessage()
                ]);
                continue;
            }
        }
        
        // Fallback to log provider for development
        if (config('app.debug')) {
            return $this->sendViaLog($phoneNumber, $message, $code);
        }
        
        Log::error('All SMS providers failed', [
            'phone' => $this->maskPhoneNumber($phoneNumber),
            'providers_tried' => $providers
        ]);
        
        return false;
    }

    /**
     * Check if provider is properly configured
     */
    private function isProviderConfigured(string $provider): bool
    {
        $config = config('sms.providers.' . $provider, []);
        
        return match($provider) {
            'vonage' => !empty($config['key']) && !empty($config['secret']),
            'unifonic' => !empty($config['app_id']) && !empty($config['sender_id']),
            'twilio' => !empty($config['sid']) && !empty($config['token']),
            default => false
        };
    }

    /**
     * Build verification message from template
     */
    protected function buildVerificationMessage(string $code): string
    {
        $template = config('sms.templates.verification');
        $appName = config('app.name');
        
        return str_replace(
            [':app', ':code'],
            [$appName, $code],
            $template
        );
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
     * Send SMS via Vonage (proper implementation)
     */
    private function sendViaVonage(string $phoneNumber, string $message, array $config): bool
    {
        try {
            $credentials = new Basic($config['key'], $config['secret']);
            $client = new Client($credentials);

            $smsMessage = new SMS(
                $this->formatPhoneNumber($phoneNumber),
                $config['from'] ?? 'PLATE35',
                $message
            );
            
            $response = $client->sms()->send($smsMessage);
            $smsMessage = $response->current();
            
            if ($smsMessage->getStatus() == 0) {
                Log::info('Vonage SMS Sent Successfully', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'message_id' => $smsMessage->getMessageId(),
                    'status' => $smsMessage->getStatus(),
                    'platform' => 'plate35.com'
                ]);
                return true;
            } else {
                Log::error('Vonage SMS Failed', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'status' => $smsMessage->getStatus(),
                    'error' => $smsMessage->getStatusText(),
                    'platform' => 'plate35.com'
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Vonage SMS Service Error', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'platform' => 'plate35.com'
            ]);
            return false;
        }
    }

    /**
     * Send SMS via Unifonic (UAE-focused provider)
     */
    private function sendViaUnifonic(string $phoneNumber, string $message, array $config): bool
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post('https://el.cloud.unifonic.com/api/wrapper/sendSMS', [
                'AppSid' => $config['app_id'],
                'SenderID' => $config['sender_id'],
                'Recipient' => $this->formatPhoneNumber($phoneNumber),
                'Body' => $message,
            ]);

            $result = $response->json();
            
            if ($response->successful() && isset($result['success']) && $result['success']) {
                Log::info('Unifonic SMS Sent Successfully', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'message_id' => $result['data']['MessageID'] ?? 'N/A',
                    'platform' => 'plate35.com'
                ]);
                return true;
            } else {
                Log::error('Unifonic SMS Failed', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'error' => $result['message'] ?? 'Unknown error',
                    'response' => $result,
                    'platform' => 'plate35.com'
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Unifonic SMS Service Error', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'platform' => 'plate35.com'
            ]);
            return false;
        }
    }

    /**
     * Send SMS via Twilio
     */
    protected function sendViaTwilio(string $phoneNumber, string $message, array $config): bool
    {
        try {
            $response = Http::asForm()
                ->withBasicAuth($config['sid'], $config['token'])
                ->post("https://api.twilio.com/2010-04-01/Accounts/{$config['sid']}/Messages.json", [
                    'From' => $config['from'],
                    'To' => $this->formatPhoneNumber($phoneNumber),
                    'Body' => $message,
                ]);

            $result = $response->json();

            if ($response->successful()) {
                Log::info('Twilio SMS Sent Successfully', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'message_id' => $result['sid'] ?? 'N/A',
                    'platform' => 'plate35.com'
                ]);
                return true;
            } else {
                Log::error('Twilio SMS Failed', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'error' => $result['message'] ?? 'Unknown error',
                    'platform' => 'plate35.com'
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Twilio SMS Service Error', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'platform' => 'plate35.com'
            ]);
            return false;
        }
    }

    /**
     * Format phone number for UAE with international format
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
     * Mask phone number for logging (privacy)
     */
    protected function maskPhoneNumber(string $phoneNumber): string
    {
        $formatted = $this->formatPhoneNumber($phoneNumber);
        if (strlen($formatted) > 8) {
            return substr($formatted, 0, 4) . '****' . substr($formatted, -4);
        }
        return $formatted;
    }

    /**
     * Test SMS configuration
     */
    public function testConfiguration(): array
    {
        $results = [];
        $providers = ['vonage', 'unifonic', 'twilio'];
        
        foreach ($providers as $provider) {
            $results[$provider] = [
                'configured' => $this->isProviderConfigured($provider),
                'config' => $this->getProviderTestInfo($provider)
            ];
        }
        
        return $results;
    }

    /**
     * Get provider configuration info for testing
     */
    private function getProviderTestInfo(string $provider): array
    {
        $config = config('sms.providers.' . $provider, []);
        
        return match($provider) {
            'vonage' => [
                'has_key' => !empty($config['key']),
                'has_secret' => !empty($config['secret']),
                'from' => $config['from'] ?? 'Not set'
            ],
            'unifonic' => [
                'has_app_id' => !empty($config['app_id']),
                'has_sender_id' => !empty($config['sender_id']),
                'sender_id' => $config['sender_id'] ?? 'Not set'
            ],
            'twilio' => [
                'has_sid' => !empty($config['sid']),
                'has_token' => !empty($config['token']),
                'from' => $config['from'] ?? 'Not set'
            ],
            default => ['error' => 'Unknown provider']
        };
    }
} 