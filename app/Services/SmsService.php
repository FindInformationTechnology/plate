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
        
        // For production, use only Vonage
        $provider = config('sms.default_provider', 'vonage');
        
        // If in development and no provider configured, use log
        if (config('app.debug') && $provider === 'log') {
            return $this->sendViaLog($phoneNumber, $message, $code);
        }
        
        // Use configured provider (production: Vonage only)
        try {
            $config = config('sms.providers.' . $provider, []);
            
            if (empty($config) || !$this->isProviderConfigured($provider)) {
                Log::error('Primary SMS provider not configured', [
                    'provider' => $provider,
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'platform' => 'plate35.com'
                ]);
                
                // Only fallback in development
                if (config('app.debug')) {
                    return $this->sendViaLog($phoneNumber, $message, $code);
                }
                
                return false;
            }

            $success = match($provider) {
                'vonage' => $this->sendViaVonage($phoneNumber, $message, $config),
                'unifonic' => $this->sendViaUnifonic($phoneNumber, $message, $config),
                'twilio' => $this->sendViaTwilio($phoneNumber, $message, $config),
                default => false
            };
            
            if ($success) {
                Log::info("✅ SMS sent successfully via {$provider}", [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'provider' => $provider,
                    'platform' => 'plate35.com'
                ]);
                return true;
            } else {
                Log::error('SMS failed via primary provider', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'provider' => $provider,
                    'platform' => 'plate35.com'
                ]);
                return false;
            }
            
        } catch (\Exception $e) {
            Log::error("SMS service error", [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'provider' => $provider,
                'error' => $e->getMessage(),
                'platform' => 'plate35.com'
            ]);
            
            // Only fallback in development
            if (config('app.debug')) {
                return $this->sendViaLog($phoneNumber, $message, $code);
            }
            
            return false;
        }
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
     * Send SMS via Vonage only (for testing credentials)
     */
    public function sendViaVonageOnly(string $phoneNumber, string $code): bool
    {
        $message = $this->buildVerificationMessage($code);
        $config = config('sms.providers.vonage');
        
        // Log the attempt
        Log::info('Testing Vonage-only SMS', [
            'phone' => $this->maskPhoneNumber($phoneNumber),
            'config_present' => !empty($config),
            'platform' => 'plate35.com'
        ]);
        
        return $this->sendViaVonage($phoneNumber, $message, $config);
    }

    /**
     * Send SMS via Vonage (proper implementation)
     */
    private function sendViaVonage(string $phoneNumber, string $message, array $config): bool
    {
        try {
            // Log detailed attempt info
            Log::info('Attempting Vonage SMS', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'has_key' => !empty($config['key']),
                'has_secret' => !empty($config['secret']),
                'from' => $config['from'] ?? 'PLATE35',
                'message_length' => strlen($message),
                'platform' => 'plate35.com'
            ]);

            $credentials = new Basic($config['key'], $config['secret']);
            $client = new Client($credentials);

            $smsMessage = new SMS(
                $this->formatPhoneNumber($phoneNumber),
                $config['from'] ?? 'PLATE35',
                $message
            );
            
            Log::info('Vonage SMS object created', [
                'to' => $this->maskPhoneNumber($phoneNumber),
                'from' => $config['from'] ?? 'PLATE35',
                'platform' => 'plate35.com'
            ]);
            
            $response = $client->sms()->send($smsMessage);
            $smsMessage = $response->current();
            
            Log::info('Vonage API Response received', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'status' => $smsMessage->getStatus(),
                'message_id' => $smsMessage->getMessageId(),
                'platform' => 'plate35.com'
            ]);
            
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
                    'network_error_code' => $smsMessage->getNetworkErrorCode(),
                    'platform' => 'plate35.com'
                ]);
                return false;
            }

        } catch (\Vonage\Client\Exception\Request $e) {
            Log::error('Vonage Request Failed', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'platform' => 'plate35.com'
            ]);
            return false;
        } catch (\Vonage\Client\Exception\Exception $e) {
            Log::error('Vonage Client Failed', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'platform' => 'plate35.com'
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error('Vonage SMS Service Error', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
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
                Log::warning('Unifonic SMS Failed (fallback available)', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'error' => $result['message'] ?? 'Unknown error',
                    'response' => $result,
                    'platform' => 'plate35.com'
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::warning('Unifonic SMS Service Error (fallback available)', [
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
                Log::warning('Twilio SMS Failed (fallback available)', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'error' => $result['message'] ?? 'Unknown error',
                    'platform' => 'plate35.com'
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::warning('Twilio SMS Service Error (fallback available)', [
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