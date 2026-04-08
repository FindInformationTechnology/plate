<?php

namespace App\Services\Auth;

use App\Models\OtpCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OtpService
{
    public function __construct(
        private readonly OtpSenderService $sender,
    ) {}

    // ─── Constants ───────────────────────────────────────────────────────────────

    const OTP_LENGTH     = 6;
    const OTP_EXPIRY_MIN = 5;
    const MAX_ATTEMPTS   = 5;

    // ─── Public API ──────────────────────────────────────────────────────────────

    /**
     * Generate, store, and send a new OTP.
     * Invalidates any previous active OTP for the same identifier+type.
     */
    public function send(string $identifier, string $channel, string $type = 'login'): OtpCode
    {
        // Invalidate old active OTPs
        OtpCode::forIdentifier($identifier)
            ->where('type', $type)
            ->active()
            ->delete();

        $plainCode = $this->generateCode();

        $otp = OtpCode::create([
            'identifier' => $identifier,
            'code'       => Hash::make($plainCode),
            'type'       => $type,
            'channel'    => $channel,
            'expires_at' => now()->addMinutes(self::OTP_EXPIRY_MIN),
        ]);

        $this->sender->send($identifier, $channel, $plainCode);

        Log::info('OTP sent', [
            'identifier' => $this->maskIdentifier($identifier),
            'channel'    => $channel,
            'type'       => $type,
        ]);

        return $otp;
    }

    /**
     * Verify an OTP code for the given identifier.
     *
     * @throws ValidationException
     */
    public function verify(string $identifier, string $code, string $type = 'login'): OtpCode
    {
        /** @var OtpCode|null $otp */
        $otp = OtpCode::forIdentifier($identifier)
            ->where('type', $type)
            ->active()
            ->latest()
            ->first();

        // No active OTP found
        if (! $otp) {
            throw ValidationException::withMessages([
                'otp' => __('auth.otp_not_found'),
            ]);
        }

        // Expired
        if ($otp->isExpired()) {
            throw ValidationException::withMessages([
                'otp' => __('auth.otp_expired'),
            ]);
        }

        // Too many attempts
        if ($otp->hasExceededAttempts(self::MAX_ATTEMPTS)) {
            $otp->delete();
            throw ValidationException::withMessages([
                'otp' => __('auth.otp_too_many_attempts'),
            ]);
        }

        // Wrong code
        if (! Hash::check($code, $otp->code)) {
            $otp->incrementAttempts();
            $remaining = self::MAX_ATTEMPTS - $otp->fresh()->attempts;

            throw ValidationException::withMessages([
                'otp' => __('auth.otp_invalid', ['remaining' => max(0, $remaining)]),
            ]);
        }

        $otp->markVerified();

        Log::info('OTP verified', [
            'identifier' => $this->maskIdentifier($identifier),
            'type'       => $type,
        ]);

        return $otp;
    }

    /**
     * Check if a recent OTP was already sent (cooldown enforcement).
     */
    public function hasCooldown(string $identifier, int $seconds = 60): bool
    {
        return OtpCode::forIdentifier($identifier)
            ->where('created_at', '>=', now()->subSeconds($seconds))
            ->exists();
    }

    // ─── Private ─────────────────────────────────────────────────────────────────

    private function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), self::OTP_LENGTH, '0', STR_PAD_LEFT);
    }

    private function maskIdentifier(string $identifier): string
    {
        if (str_contains($identifier, '@')) {
            [$local, $domain] = explode('@', $identifier);
            return substr($local, 0, 2) . '***@' . $domain;
        }

        return substr($identifier, 0, 4) . '****' . substr($identifier, -3);
    }
}
