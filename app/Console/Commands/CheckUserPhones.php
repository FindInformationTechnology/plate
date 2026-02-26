<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUserPhones extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'users:check-phones {--fix : Fix users with missing phone numbers}';

    /**
     * The console command description.
     */
    protected $description = 'Check for users without phone numbers and optionally fix them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('📱 Checking User Phone Numbers');
        $this->newLine();

        // Count total users
        $totalUsers = User::count();
        $this->line("Total Users: {$totalUsers}");

        // Count users without phone numbers
        $usersWithoutPhone = User::whereNull('phone')->orWhere('phone', '')->count();
        $usersWithPhone = $totalUsers - $usersWithoutPhone;

        $this->line("Users with Phone: ✅ {$usersWithPhone}");
        $this->line("Users without Phone: ❌ {$usersWithoutPhone}");
        $this->newLine();

        if ($usersWithoutPhone > 0) {
            $this->warn("Found {$usersWithoutPhone} users without phone numbers:");
            $this->newLine();

            $problematicUsers = User::whereNull('phone')->orWhere('phone', '')->get();
            
            foreach ($problematicUsers as $user) {
                $this->line("ID: {$user->id} | Email: {$user->email} | Name: {$user->name} | Created: {$user->created_at->format('Y-m-d H:i')}");
            }

            $this->newLine();

            if ($this->option('fix')) {
                $this->fixUsers($problematicUsers);
            } else {
                $this->info('💡 To automatically handle these users, run: php artisan users:check-phones --fix');
            }
        } else {
            $this->info('✅ All users have phone numbers!');
        }

        return Command::SUCCESS;
    }

    private function fixUsers($users)
    {
        $this->info('🔧 Fixing users without phone numbers...');
        $this->newLine();

        foreach ($users as $user) {
            $action = $this->choice(
                "User: {$user->email} - What should we do?",
                [
                    'skip' => 'Skip this user',
                    'disable_verification' => 'Disable phone verification for this user',
                    'set_dummy_phone' => 'Set a dummy phone number',
                    'delete' => 'Delete this user (if test account)',
                ],
                'skip'
            );

            switch ($action) {
                case 'disable_verification':
                    $user->update(['phone_verification_required' => false]);
                    $this->info("✅ Disabled phone verification for {$user->email}");
                    break;

                case 'set_dummy_phone':
                    $dummyPhone = '500000' . str_pad($user->id, 3, '0', STR_PAD_LEFT);
                    $user->update(['phone' => $dummyPhone]);
                    $this->info("✅ Set dummy phone {$dummyPhone} for {$user->email}");
                    break;

                case 'delete':
                    if ($this->confirm("Are you sure you want to delete user {$user->email}?")) {
                        $user->delete();
                        $this->info("🗑️ Deleted user {$user->email}");
                    }
                    break;

                case 'skip':
                default:
                    $this->line("⏭️ Skipped {$user->email}");
                    break;
            }
        }

        $this->newLine();
        $this->info('✅ Finished processing users!');
    }
} 