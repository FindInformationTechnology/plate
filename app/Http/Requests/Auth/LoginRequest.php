<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Services\Auth\IdentifierResolver;
use App\Services\Auth\OtpService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identifier' => ['required', 'string', 'max:255'],
            'otp'        => ['nullable', 'string', 'digits:6'],
        ];
    }

    /**
     * Main entry point: handles both OTP send and OTP verify flows.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        
        $this->ensureIsNotRateLimited();

        $resolver   = app(IdentifierResolver::class);
        
        $otpService = app(OtpService::class);

        ['channel' => $channel, 'identifier' => $identifier] = $resolver->resolve(
            $this->string('identifier')
        );

        // ── No OTP submitted → send OTP ──────────────────────────────────────────
        if (! $this->filled('otp')) {
            $this->sendOtp($identifier, $channel, $otpService);
        }

        // ── OTP submitted → verify and login ─────────────────────────────────────
        $this->verifyAndLogin($identifier, $channel, $otpService);

        RateLimiter::clear($this->throttleKey());
    }

    // ─── Private ─────────────────────────────────────────────────────────────────

    private function sendOtp(string $identifier, string $channel, OtpService $otpService): never
    {
        // Cooldown: prevent spam (60s between requests)
        if ($otpService->hasCooldown($identifier)) {
            throw ValidationException::withMessages([
                'identifier' => [__('auth.otp_cooldown')],
            ])->status(429);
        }

        $otpService->send($identifier, $channel);

        // Tell the frontend to show the OTP field
        throw ValidationException::withMessages([
            'otp_sent' => [__('auth.otp_sent')],
        ])->status(422); // 422 keeps us in the login form, intercepted by JS/Livewire
    }

    private function verifyAndLogin(string $identifier, string $channel, OtpService $otpService): void
    {
        // Throws ValidationException on failure
        $otpService->verify($identifier, $this->string('otp'), 'login');

        // Find or auto-register the user
        $user = $this->findOrCreateUser($identifier, $channel);

        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'identifier' => [__('auth.account_disabled')],
            ]);
        }

        Auth::login($user, remember: true);
    }

    private function findOrCreateUser(string $identifier, string $channel): User
    {
        $field = $channel === 'phone' ? 'phone' : 'email';

        return User::firstOrCreate(
            [$field => $identifier],
            [
                'name'     => $this->deriveDefaultName($identifier, $channel),
                'role'     => 'user',
                'password' => null, // OTP users don't need a password
            ]
        );
    }

    private function deriveDefaultName(string $identifier, string $channel): string
    {
        if ($channel === 'email') {
            return Str::title(explode('@', $identifier)[0]);
        }

        // Phone: will be updated by user later
        return 'User';
    }

    // ─── Rate Limiting ───────────────────────────────────────────────────────────

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'identifier' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ])->status(429);
    }

    private function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->string('identifier')) . '|' . $this->ip()
        );
    }
}
