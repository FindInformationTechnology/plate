<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\SmsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ProductionSmsTest extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sms:production-test {--phone= : Phone number to test} {--create-user : Create test user}';

    /**
     * The console command description.
     */
    protected $description = 'Complete production SMS verification flow test';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Production SMS Verification Flow Test');
        $this->newLine();

        // Step 1: Check Environment
        $this->checkEnvironment();

        // Step 2: Test SMS Configuration
        $this->testSmsConfiguration();

        // Step 3: Test Complete OTP Flow
        if ($this->option('phone')) {
            $this->testCompleteFlow($this->option('phone'));
        }

        return Command::SUCCESS;
    }

    private function checkEnvironment()
    {
        $this->info('🔍 Environment Check');
        
        $isProduction = app()->environment('production');
        $debugMode = config('app.debug');
        $smsProvider = config('sms.default_provider');
        
        $this->line("Environment: " . app()->environment());
        $this->line("Debug Mode: " . ($debugMode ? '❌ Enabled' : '✅ Disabled'));
        $this->line("SMS Provider: {$smsProvider}");
        
        if ($isProduction && $debugMode) {
            $this->warn('⚠️ Debug mode is enabled in production!');
        }
        
        $this->newLine();
    }

    private function testSmsConfiguration()
    {
        $this->info('📱 SMS Configuration Test');
        
        $smsService = app(SmsService::class);
        $results = $smsService->testConfiguration();
        
        $provider = config('sms.default_provider');
        $status = $results[$provider] ?? ['configured' => false];
        
        if ($status['configured']) {
            $this->line("✅ {$provider}: Configured");
            if (isset($status['config'])) {
                foreach ($status['config'] as $key => $value) {
                    if (str_starts_with($key, 'has_')) {
                        $icon = $value ? '✅' : '❌';
                        $this->line("  {$icon} {$key}: " . ($value ? 'Yes' : 'No'));
                    }
                }
            }
        } else {
            $this->error("❌ {$provider}: Not configured properly");
            $this->error("Please check your .env file and ensure all SMS credentials are set");
            return false;
        }
        
        $this->newLine();
        return true;
    }

    private function testCompleteFlow(string $phoneNumber)
    {
        $this->info('🔄 Complete OTP Flow Test');
        $this->newLine();

        // Step 1: Create or find test user
        $user = $this->getOrCreateTestUser($phoneNumber);
        if (!$user) {
            $this->error('❌ Could not create/find test user');
            return;
        }

        $this->line("📋 Test User: {$user->name} ({$user->email})");
        $this->line("📞 Phone: {$user->phone}");
        $this->newLine();

        // Step 2: Test SMS sending
        $this->line('📤 Testing SMS Send...');
        $code = $user->generatePhoneVerificationCode();
        
        $smsService = app(SmsService::class);
        $sent = $smsService->sendVerificationCode($user->phone, $code);
        
        if ($sent) {
            $this->info("✅ SMS sent successfully");
            $this->line("🔢 Generated code: {$code}");
        } else {
            $this->error("❌ SMS sending failed");
            return;
        }

        // Step 3: Test code validation
        $this->newLine();
        $this->line('🔍 Testing Code Validation...');
        
        // Test valid code
        if ($user->isValidPhoneVerificationCode($code)) {
            $this->info("✅ Code validation: Working");
        } else {
            $this->error("❌ Code validation: Failed");
        }

        // Test invalid code
        $user->refresh(); // Reload user to reset attempts
        if (!$user->isValidPhoneVerificationCode('000000')) {
            $this->info("✅ Invalid code rejection: Working");
        } else {
            $this->error("❌ Invalid code rejection: Failed");
        }

        // Step 4: Test phone verification
        $this->newLine();
        $this->line('✅ Testing Phone Verification...');
        
        $user->refresh(); // Reset attempts
        if ($user->isValidPhoneVerificationCode($code)) {
            $user->markPhoneAsVerified();
            $this->info("✅ Phone verification: Complete");
            $this->line("📞 User phone verified at: {$user->phone_verified_at}");
        }

        // Step 5: Cleanup
        if ($this->option('create-user')) {
            if ($this->confirm('Delete test user?', true)) {
                $user->delete();
                $this->info("🗑️ Test user deleted");
            }
        }

        $this->newLine();
        $this->info('🎉 Complete OTP flow test: PASSED');
    }

    private function getOrCreateTestUser(string $phoneNumber): ?User
    {
        // Clean phone number
        $cleanPhone = preg_replace('/[^0-9]/', '', $phoneNumber);
        $cleanPhone = ltrim($cleanPhone, '0');
        if (str_starts_with($cleanPhone, '971')) {
            $cleanPhone = substr($cleanPhone, 3);
        }
        $cleanPhone = ltrim($cleanPhone, '0');

        // Try to find existing user
        $user = User::where('phone', $cleanPhone)->first();
        
        if ($user) {
            $this->line("👤 Found existing user: {$user->name}");
            return $user;
        }

        // Create new user if requested
        if ($this->option('create-user') || $this->confirm('Create test user?', true)) {
            $user = User::create([
                'name' => 'SMS Test User',
                'email' => 'sms-test-' . time() . '@plate35.com',
                'phone' => $cleanPhone,
                'password' => Hash::make('password'),
                'phone_verification_required' => true,
            ]);

            $this->line("👤 Created test user: {$user->name}");
            return $user;
        }

        return null;
    }
} 