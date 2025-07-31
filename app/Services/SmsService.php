<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as TwilioClient;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SmsService
{
    protected string $defaultProvider;
    protected array $config;

    public function __construct()
    {
        $this->defaultProvider = config('sms.default_provider', 'unifonic');
        $this->config = config('sms.providers', []);
    }

    /**
     * Send SMS verification code
     */
    public function sendVerificationCode(string $phoneNumber, string $code): bool
    {
        $message = $this->buildVerificationMessage($code);
        $provider = $this->defaultProvider;
        
        // Log the attempt
        Log::info('📱 SMS VERIFICATION CODE', [
            'phone' => $this->maskPhoneNumber($phoneNumber),
            'code' => $code,
            'message' => $message,
            'timestamp' => now()->toDateTimeString()
        ]);
        
        // In development, use log provider if configured
        if (config('app.debug') && ($provider === 'log' || $provider === 'unifonic')) {
            return $this->sendViaLog($phoneNumber, $message, $code);
        }
        
        // Check if provider is configured
        if (!$this->isProviderConfigured($provider)) {
            Log::error('SMS provider not configured', [
                'provider' => $provider,
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'platform' => 'plate35.com'
            ]);
            
            // Fallback to log in development
            if (config('app.debug')) {
                return $this->sendViaLog($phoneNumber, $message, $code);
            }
            
            return false;
        }

        // Send via configured provider
        try {
            $success = $this->sendViaProvider($provider, $phoneNumber, $message);
            
            if ($success) {
                Log::info("✅ SMS sent successfully via {$provider}", [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'provider' => $provider,
                    'platform' => 'plate35.com'
                ]);
                return true;
            } else {
                Log::error('SMS failed via provider', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
                    'provider' => $provider,
                    'platform' => 'plate35.com'
                ]);
                return false;
            }
            
        } catch (Exception $e) {
            Log::error("SMS service error", [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'provider' => $provider,
                'error' => $e->getMessage(),
                'platform' => 'plate35.com'
            ]);
            
            // Fallback to log in development
            if (config('app.debug')) {
                return $this->sendViaLog($phoneNumber, $message, $code);
            }
            
            return false;
        }
    }

    /**
     * Send SMS via specific provider
     */
    private function sendViaProvider(string $provider, string $phoneNumber, string $message): bool
    {
        return match($provider) {
            'vonage' => $this->sendViaVonage($phoneNumber, $message),
            'unifonic' => $this->sendViaUnifonic($phoneNumber, $message),
            'twilio' => $this->sendViaTwilio($phoneNumber, $message),
            'log' => $this->sendViaLog($phoneNumber, $message, ''),
            default => false
        };
    }

    /**
     * Check if provider is properly configured
     */
    private function isProviderConfigured(string $provider): bool
    {
        $config = $this->config[$provider] ?? [];
        
        return match($provider) {
            'vonage' => !empty($config['key']) && !empty($config['secret']),
            'unifonic' => !empty($config['app_id']) && !empty($config['sender_id']),
            'twilio' => !empty($config['sid']) && !empty($config['token']),
            'log' => true,
            default => false
        };
    }

    /**
     * Build verification message from template
     */
    private function buildVerificationMessage(string $code): string
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
    private function sendViaLog(string $phoneNumber, string $message, string $code): bool
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
     * Send SMS via Vonage
     */
    private function sendViaVonage(string $phoneNumber, string $message): bool
    {
        try {
            $config = $this->config['vonage'];
            
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

        } catch (Exception $e) {
            Log::error('Vonage SMS Error', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'platform' => 'plate35.com'
            ]);
            return false;
        }
    }

    /**
     * Send SMS via Unifonic
     */
    private function sendViaUnifonic(string $phoneNumber, string $message): bool
    {
        // In development mode, always log instead of sending real SMS
        if (config('app.debug')) {
            Log::info('📱 UNIFONIC SMS SIMULATION (Development Mode)', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'message' => $message,
                'note' => 'Real SMS not sent - development mode',
                'timestamp' => now()->toDateTimeString()
            ]);
            
            // Also log in simple format for easy reading
            $formattedNumber = $this->formatPhoneNumber($phoneNumber);
            Log::info("🔐 UNIFONIC VERIFICATION CODE FOR {$formattedNumber}: " . substr($message, -6));
            
            return true;
        }

        try {
            $config = $this->config['unifonic'];
            
            // Log the attempt with detailed info
            Log::info('Attempting Unifonic SMS', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'has_app_id' => !empty($config['app_id']),
                'has_sender_id' => !empty($config['sender_id']),
                'sender_id' => $config['sender_id'] ?? 'Not set',
                'message_length' => strlen($message),
                'platform' => 'plate35.com'
            ]);

            // Log the API request details
            Log::info('Unifonic API Request', [
                'url' => 'https://el.cloud.unifonic.com/api/wrapper/sendSMS',
                'app_sid' => !empty($config['app_id']) ? 'Set' : 'Missing',
                'sender_id' => $config['sender_id'] ?? 'Not set',
                'recipient' => $this->formatPhoneNumber($phoneNumber),
                'body_length' => strlen($message),
                'platform' => 'plate35.com'
            ]);

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
            
            // Log the API response
            Log::info('Unifonic API Response', [
                'status_code' => $response->status(),
                'response_body' => $result,
                'platform' => 'plate35.com'
            ]);
            
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

        } catch (Exception $e) {
            Log::error('Unifonic SMS Error', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'platform' => 'plate35.com'
            ]);
            return false;
        }
    }

    /**
     * Send SMS via Twilio
     */
    private function sendViaTwilio(string $phoneNumber, string $message): bool
    {
        try {
            $config = $this->config['twilio'];
            
            Log::info('Attempting Twilio SMS', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'has_sid' => !empty($config['sid']),
                'has_token' => !empty($config['token']),
                'from' => $config['from'] ?? 'Not set',
                'message_length' => strlen($message),
                'platform' => 'plate35.com'
            ]);

            $client = new TwilioClient($config['sid'], $config['token']);
            
            $message = $client->messages->create(
                $this->formatPhoneNumber($phoneNumber),
                [
                    'from' => $config['from'],
                    'body' => $message
                ]
            );

            Log::info('Twilio SMS Sent Successfully', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'message_id' => $message->sid,
                'status' => $message->status,
                'platform' => 'plate35.com'
            ]);
            
            return true;

        } catch (Exception $e) {
            Log::error('Twilio SMS Error', [
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
    private function formatPhoneNumber(string $phoneNumber): string
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
    private function maskPhoneNumber(string $phoneNumber): string
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
        $config = $this->config[$provider] ?? [];
        
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