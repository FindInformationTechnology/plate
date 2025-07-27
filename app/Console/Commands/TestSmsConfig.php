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
    protected $signature = 'sms:test {--provider=} {--phone=}';

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
}
