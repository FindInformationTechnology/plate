<?php

namespace App\Http\Requests\Auth;

use App\Services\Auth\AuthService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
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
     * OTP send (no otp field) or verify + login (with otp).
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $authService = app(AuthService::class);

        if (! $this->filled('otp')) {
            $authService->sendOtp($this->string('identifier'));

            throw ValidationException::withMessages([
                'otp_sent' => [__('auth.otp_sent')],
            ])->status(422);
        }

        $authService->verifyOtp($this->string('identifier'), $this->string('otp'));

        RateLimiter::clear($this->throttleKey());
    }

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
