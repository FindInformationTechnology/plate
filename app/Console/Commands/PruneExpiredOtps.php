<?php

namespace App\Console\Commands;

use App\Models\OtpCode;
use Illuminate\Console\Command;

class PruneExpiredOtps extends Command
{
    protected $signature   = 'otp:prune';
    protected $description = 'Delete expired and verified OTP codes';

    public function handle(): int
    {
        $deleted = OtpCode::where(function ($q) {
            $q->where('expires_at', '<', now())
              ->orWhereNotNull('verified_at');
        })->delete();

        $this->info("Pruned {$deleted} OTP record(s).");

        return self::SUCCESS;
    }
}
