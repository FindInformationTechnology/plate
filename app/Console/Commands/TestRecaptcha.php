<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestRecaptcha extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'recaptcha:test {--token= : reCAPTCHA token to test}';

    /**
     * The console command description.
     */
    protected $description = 'Test reCAPTCHA configuration and verify tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 reCAPTCHA Configuration Test');
        $this->newLine();

        // Check configuration
        $this->checkConfiguration();

        // Test verification if token provided
        if ($this->option('token')) {
            $this->testToken($this->option('token'));
        } else {
            $this->info('💡 To test a specific token, use: php artisan recaptcha:test --token=YOUR_TOKEN');
        }

        return Command::SUCCESS;
    }

    private function checkConfiguration()
    {
        $siteKey = config('services.recaptcha.site_key');
        $secretKey = config('services.recaptcha.secret_key');

        $this->line('📋 Configuration Status:');
        $this->newLine();

        // Site Key
        if ($siteKey) {
            $this->line("✅ Site Key: " . substr($siteKey, 0, 10) . "..." . substr($siteKey, -10));
        } else {
            $this->error("❌ Site Key: Missing");
        }

        // Secret Key  
        if ($secretKey) {
            $this->line("✅ Secret Key: " . substr($secretKey, 0, 10) . "..." . substr($secretKey, -10));
        } else {
            $this->error("❌ Secret Key: Missing");
        }

        $this->newLine();

        // Environment check
        $this->line('🌍 Environment Check:');
        $this->line("App Environment: " . config('app.env'));
        $this->line("App URL: " . config('app.url'));
        $this->line("Debug Mode: " . (config('app.debug') ? 'Enabled' : 'Disabled'));

        $this->newLine();

        // Key format validation
        if ($siteKey && $secretKey) {
            $this->validateKeyFormats($siteKey, $secretKey);
        }
    }

    private function validateKeyFormats($siteKey, $secretKey)
    {
        $this->line('🔑 Key Format Validation:');

        // Site key should start with specific prefixes
        $validSitePrefixes = ['6Lc', '6Le', '6Lf', '6Ld'];
        $siteKeyValid = false;
        foreach ($validSitePrefixes as $prefix) {
            if (str_starts_with($siteKey, $prefix)) {
                $siteKeyValid = true;
                break;
            }
        }

        if ($siteKeyValid) {
            $this->line("✅ Site Key format: Valid");
        } else {
            $this->warn("⚠️ Site Key format: Unusual (may be test key)");
        }

        // Secret key should start with specific prefixes
        $validSecretPrefixes = ['6Lc', '6Le', '6Lf', '6Ld'];
        $secretKeyValid = false;
        foreach ($validSecretPrefixes as $prefix) {
            if (str_starts_with($secretKey, $prefix)) {
                $secretKeyValid = true;
                break;
            }
        }

        if ($secretKeyValid) {
            $this->line("✅ Secret Key format: Valid");
        } else {
            $this->warn("⚠️ Secret Key format: Unusual (may be test key)");
        }

        $this->newLine();
    }

    private function testToken($token)
    {
        $this->info('🧪 Testing reCAPTCHA Token');
        $this->newLine();

        $result = $this->verifyRecaptcha($token);

        if (!$result) {
            $this->error('❌ Failed to connect to reCAPTCHA API');
            return;
        }

        $this->line('📊 Verification Result:');
        $this->line("Success: " . ($result['success'] ? '✅ Yes' : '❌ No'));

        if (isset($result['score'])) {
            $score = $result['score'];
            $scoreStatus = $score >= 0.5 ? '✅' : '❌';
            $this->line("Score: {$scoreStatus} {$score} (threshold: 0.5)");
        }

        if (isset($result['action'])) {
            $this->line("Action: " . $result['action']);
        }

        if (isset($result['hostname'])) {
            $this->line("Hostname: " . $result['hostname']);
        }

        if (isset($result['challenge_ts'])) {
            $this->line("Challenge Time: " . $result['challenge_ts']);
        }

        if (isset($result['error-codes']) && !empty($result['error-codes'])) {
            $this->newLine();
            $this->error('🚨 Error Codes:');
            foreach ($result['error-codes'] as $code) {
                $this->line("  - " . $this->getErrorCodeDescription($code));
            }
        }

        $this->newLine();
    }

    private function verifyRecaptcha($token)
    {
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $token,
                'remoteip' => '127.0.0.1' // Test IP
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            $this->error('HTTP Error: ' . $response->status());
            return null;
        } catch (\Exception $e) {
            $this->error('Exception: ' . $e->getMessage());
            return null;
        }
    }

    private function getErrorCodeDescription($code)
    {
        $descriptions = [
            'missing-input-secret' => 'The secret parameter is missing',
            'invalid-input-secret' => 'The secret parameter is invalid or malformed',
            'missing-input-response' => 'The response parameter is missing',
            'invalid-input-response' => 'The response parameter is invalid or malformed',
            'bad-request' => 'The request is invalid or malformed',
            'timeout-or-duplicate' => 'The response is no longer valid (timeout or duplicate)',
        ];

        return $code . ': ' . ($descriptions[$code] ?? 'Unknown error');
    }
} 