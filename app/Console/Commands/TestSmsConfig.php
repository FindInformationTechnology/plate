<?php

namespace App\Console\Commands;

use App\Services\SmsService;
use Illuminate\Console\Command;

class TestSmsConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:test {--provider= : Test specific provider} {--phone= : Phone number to test} {--vonage-only : Test only Vonage without fallbacks}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test SMS configuration and providers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Testing SMS Configuration...');
        $this->newLine();

        $smsService = app(SmsService::class);
        
        // Check for Vonage-only mode
        if ($this->option('vonage-only')) {
            return $this->handleVonageOnly($smsService);
        }

        $results = $smsService->testConfiguration();
        $this->displayConfiguration($results);
        
        if ($this->option('phone')) {
            $this->testActualSMS($this->option('phone'));
        }

        return Command::SUCCESS;
    }

    /**
     * Display SMS provider configurations
     */
    private function displayConfiguration(array $results): void
    {
        $this->info('📋 SMS Provider Configuration Status:');
        $this->newLine();

        foreach ($results as $provider => $data) {
            $status = $data['configured'] ? '✅ Configured' : '❌ Not Configured';
            $this->line("🔧 <fg=cyan>{$provider}</fg=cyan>: {$status}");
            
            if (isset($data['config'])) {
                foreach ($data['config'] as $key => $value) {
                    $icon = str_starts_with($key, 'has_') ? 
                        ($value ? '✅' : '❌') : '📝';
                    $this->line("   {$icon} {$key}: " . 
                        (is_bool($value) ? ($value ? 'Yes' : 'No') : $value));
                }
            }
            $this->newLine();
        }
    }

    /**
     * Test actual SMS sending
     */
    private function testActualSMS(string $phoneNumber): void
    {
        $this->info('📱 Testing Actual SMS Sending...');
        $this->newLine();

        if (!$this->confirm('This will send a real SMS. Continue?')) {
            return;
        }

        $smsService = app(SmsService::class);
        $testCode = '123456';

        try {
            $success = $smsService->sendVerificationCode($phoneNumber, $testCode);
            
            if ($success) {
                $this->info("✅ SMS sent successfully to {$phoneNumber}");
                $this->line("Test code: {$testCode}");
            } else {
                $this->error("❌ Failed to send SMS to {$phoneNumber}");
                $this->line("Check logs for detailed error information");
            }
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
        }

        $this->newLine();
    }
    
    /**
     * Handle Vonage-only testing mode
     */
    private function handleVonageOnly(SmsService $smsService)
    {
        $this->info('🎯 Vonage-Only Testing Mode');
        $this->newLine();
        
        // Check current Vonage configuration
        $results = $smsService->testConfiguration();
        $vonageStatus = $results['vonage'] ?? ['configured' => false];
        
        $this->line("🔧 <fg=cyan>vonage</fg=cyan>: " . ($vonageStatus['configured'] ? '✅ Configured' : '❌ Not Configured'));
        if (isset($vonageStatus['config'])) {
            foreach ($vonageStatus['config'] as $key => $value) {
                $icon = str_starts_with($key, 'has_') ? 
                    ($value ? '✅' : '❌') : '📝';
                $this->line("   {$icon} {$key}: " . 
                    (is_bool($value) ? ($value ? 'Yes' : 'No') : $value));
            }
        }
        $this->newLine();
        
        if (!$vonageStatus['configured']) {
            $this->warn('Vonage is not configured. Let\'s set it up:');
            $this->setupVonageCredentials();
            
            // Re-check after setup
            $results = $smsService->testConfiguration();
            $vonageStatus = $results['vonage'] ?? ['configured' => false];
            $this->line("🔧 <fg=cyan>vonage</fg=cyan>: " . ($vonageStatus['configured'] ? '✅ Configured' : '❌ Not Configured'));
            $this->newLine();
        }
        
        // Test phone
        $phone = $this->option('phone');
        if (!$phone) {
            $phone = $this->ask('Enter phone number to test (e.g., +971501234567)');
        }
        
        if (!$phone) {
            $this->error('Phone number is required for testing');
            return Command::FAILURE;
        }
        
        // Test Vonage only
        $this->info('📱 Testing Vonage SMS (NO FALLBACKS)...');
        if (!$this->confirm('This will send a real SMS via Vonage only. Continue?', false)) {
            $this->info('Test cancelled.');
            return Command::SUCCESS;
        }
        
        $testCode = '123456';
        
        try {
            $success = $smsService->sendViaVonageOnly($phone, $testCode);
            
            if ($success) {
                $this->info("✅ Vonage SMS sent successfully to {$phone}");
                $this->line("Test code: {$testCode}");
            } else {
                $this->error("❌ Vonage SMS failed to {$phone}");
                $this->line('Check logs for detailed error information.');
            }
        } catch (\Exception $e) {
            $this->error("❌ Vonage Error: " . $e->getMessage());
            $this->line('This indicates a configuration or credentials issue.');
        }
        
        return Command::SUCCESS;
    }
    
    /**
     * Setup Vonage credentials interactively
     */
    private function setupVonageCredentials()
    {
        $this->info('📝 Vonage Credentials Setup:');
        $this->line('Get your credentials from: https://dashboard.nexmo.com/settings');
        $this->newLine();
        
        $key = $this->ask('Enter your Vonage API Key (8 characters)');
        $secret = $this->ask('Enter your Vonage API Secret (32+ characters)');
        $from = $this->ask('Enter sender name/number', 'PLATE35');
        
        if (!$key || !$secret) {
            $this->error('Both API Key and Secret are required!');
            return;
        }
        
        // Show .env format
        $this->newLine();
        $this->info('📋 Add these to your .env file:');
        $this->line("VONAGE_KEY={$key}");
        $this->line("VONAGE_SECRET={$secret}");
        $this->line("VONAGE_SMS_FROM={$from}");
        $this->newLine();
        
        if ($this->confirm('Do you want me to update your .env file automatically?', true)) {
            $this->updateEnvFile([
                'VONAGE_KEY' => $key,
                'VONAGE_SECRET' => $secret,
                'VONAGE_SMS_FROM' => $from,
            ]);
            
            // Clear config cache
            $this->call('config:clear');
            $this->info('✅ .env file updated and config cache cleared!');
        }
    }
    
    /**
     * Update .env file with new values
     */
    private function updateEnvFile(array $values)
    {
        $envFile = base_path('.env');
        $envContent = file_get_contents($envFile);
        
        foreach ($values as $key => $value) {
            if (str_contains($envContent, $key . '=')) {
                // Update existing
                $envContent = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $envContent);
            } else {
                // Add new
                $envContent .= "\n{$key}={$value}";
            }
        }
        
        file_put_contents($envFile, $envContent);
    }
}
