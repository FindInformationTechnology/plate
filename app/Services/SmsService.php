<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as TwilioClient;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;
use Unifonic\Unifonic;

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
            'timestamp' => now()->toDateTimeString()
        ]);
        
        // In development, use log provider if configured
        if (config('app.debug') && $provider === 'log') {
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
                    'platform' => 'plate35.com'
                ]);
                return true;
            } else {
                Log::error('Vonage SMS Failed', [
                    'phone' => $this->maskPhoneNumber($phoneNumber),
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

        try {
            $config = $this->config['unifonic'];
            
            // Log the attempt
            Log::info('Attempting Unifonic SMS', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'has_app_id' => !empty($config['app_id']),
                'has_sender_id' => !empty($config['sender_id']),
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
                    'platform' => 'plate35.com'
                ]);
                return false;
            }

        } catch (Exception $e) {
            Log::error('Unifonic SMS Error', [
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
    private function sendViaTwilio(string $phoneNumber, string $message): bool
    {
        try {
            $config = $this->config['twilio'];
            
            Log::info('Attempting Twilio SMS', [
                'phone' => $this->maskPhoneNumber($phoneNumber),
                'has_sid' => !empty($config['sid']),
                'has_token' => !empty($config['token']),
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


} 