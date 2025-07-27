<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class DebugSms extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sms:debug';

    /**
     * The console command description.
     */
    protected $description = 'Debug SMS issues step by step';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 SMS Debug Mode - Step by Step Analysis');
        $this->newLine();

        // Step 1: Check Environment
        $this->checkEnvironment();
        
        // Step 2: Check Configuration
        $this->checkConfiguration();
        
        // Step 3: Test Vonage Classes
        $this->testVonageClasses();
        
        // Step 4: Test Basic Connection
        $this->testBasicConnection();

        return Command::SUCCESS;
    }

    private function checkEnvironment(): void
    {
        $this->info('📋 Step 1: Environment Check');
        
        $envVars = [
            'VONAGE_KEY' => env('VONAGE_KEY'),
            'VONAGE_SECRET' => env('VONAGE_SECRET'),
            'VONAGE_SMS_FROM' => env('VONAGE_SMS_FROM'),
        ];

        foreach ($envVars as $key => $value) {
            $status = $value ? '✅' : '❌';
            $displayValue = $value ? (strlen($value) > 10 ? substr($value, 0, 10) . '...' : $value) : 'Not set';
            $this->line("  {$status} {$key}: {$displayValue}");
        }
        $this->newLine();
    }

    private function checkConfiguration(): void
    {
        $this->info('⚙️ Step 2: Configuration Check');
        
        try {
            $config = config('sms.providers.vonage');
            $this->line("  ✅ SMS config loaded");
            $this->line("  📝 Key present: " . (!empty($config['key']) ? 'Yes' : 'No'));
            $this->line("  📝 Secret present: " . (!empty($config['secret']) ? 'Yes' : 'No'));
            $this->line("  📝 From: " . ($config['from'] ?? 'Not set'));
        } catch (\Exception $e) {
            $this->error("  ❌ Config error: " . $e->getMessage());
        }
        $this->newLine();
    }

    private function testVonageClasses(): void
    {
        $this->info('🔧 Step 3: Vonage Classes Test');
        
        try {
            // Test if classes can be loaded
            $this->line("  ✅ Vonage\\Client: " . (class_exists(Client::class) ? 'Available' : 'Missing'));
            $this->line("  ✅ Vonage\\Client\\Credentials\\Basic: " . (class_exists(Basic::class) ? 'Available' : 'Missing'));
            $this->line("  ✅ Vonage\\SMS\\Message\\SMS: " . (class_exists(SMS::class) ? 'Available' : 'Missing'));
            
            // Test basic instantiation
            $testKey = 'test_key';
            $testSecret = 'test_secret';
            $credentials = new Basic($testKey, $testSecret);
            $this->line("  ✅ Basic credentials: Can instantiate");
            
            $client = new Client($credentials);
            $this->line("  ✅ Vonage client: Can instantiate");
            
        } catch (\Exception $e) {
            $this->error("  ❌ Class loading error: " . $e->getMessage());
            $this->error("  📍 File: " . $e->getFile() . ':' . $e->getLine());
        }
        $this->newLine();
    }

    private function testBasicConnection(): void
    {
        $this->info('🌐 Step 4: Basic Connection Test');
        
        $config = config('sms.providers.vonage');
        
        if (empty($config['key']) || empty($config['secret'])) {
            $this->error("  ❌ Cannot test - Missing credentials");
            return;
        }

        try {
            $credentials = new Basic($config['key'], $config['secret']);
            $client = new Client($credentials);
            
            $this->line("  ✅ Client created successfully");
            
            // Test SMS object creation (without sending)
            $testSms = new SMS('+971501234567', 'PLATE35', 'Test message');
            $this->line("  ✅ SMS object created successfully");
            
            // Try to get balance (this will test API connectivity without sending SMS)
            try {
                $balance = $client->account()->getBalance();
                $this->line("  ✅ API Connection: Working");
                $this->line("  💰 Account Balance: " . $balance->getBalance() . ' ' . $balance->getCurrency());
            } catch (\Exception $e) {
                $this->error("  ❌ API Connection failed: " . $e->getMessage());
                
                if (method_exists($e, 'hasResponse') && $e->hasResponse()) {
                    $response = $e->getResponse();
                    $this->error("  📄 Response: " . $response->getBody()->getContents());
                }
            }
            
        } catch (\Exception $e) {
            $this->error("  ❌ Connection test failed: " . $e->getMessage());
            $this->error("  📍 File: " . $e->getFile() . ':' . $e->getLine());
            
            // Show more details for debugging
            if ($e->getCode()) {
                $this->error("  🔢 Error Code: " . $e->getCode());
            }
        }
        $this->newLine();
    }
}
