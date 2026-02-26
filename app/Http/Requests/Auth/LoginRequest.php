<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $login = $this->input('login');
        $loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // If login is a phone number, process it to match the format in the database
        if ($loginType === 'phone') {
            $login = $this->processPhoneNumber($login);
        }

        // Self-healing: fix any malformed Bcrypt hash (e.g. $12$ instead of $2y$12$)
        $this->fixMalformedPasswordHash($loginType, $login);

        $credentials = [
            $loginType => $login,
            'password' => $this->input('password')
        ];

        if (!Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Auto-fix malformed Bcrypt hashes stored without the $2y$ prefix.
     * Some external tools / direct DB inserts produce $12$... instead of $2y$12$...
     */
    private function fixMalformedPasswordHash(string $loginType, string $login): void
    {
        $user = User::where($loginType, $login)->first();

        if (!$user) {
            return;
        }

        $raw = $user->getAttributes()['password'] ?? '';

        // Detect $12$ or $10$ etc. — valid Bcrypt cost but missing $2y$ wrapper
        if (preg_match('/^\$(\d+)\$/', $raw) && !str_starts_with($raw, '$2y$') && !str_starts_with($raw, '$2b$') && !str_starts_with($raw, '$argon')) {
            $fixed = '$2y$' . ltrim($raw, '$');
            if (password_get_info($fixed)['algo'] === PASSWORD_BCRYPT) {
                DB::table('users')->where('id', $user->id)->update(['password' => $fixed]);
            }
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        // return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
        return Str::transliterate(Str::lower($this->string('login')) . '|' . $this->ip());
    }

    private function processPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        // Remove leading zeros
        $cleanPhone = ltrim($cleanPhone, '0');

        // Remove common UAE country code if present
        if (substr($cleanPhone, 0, 3) === '971') {
            $cleanPhone = substr($cleanPhone, 3);
        }

        // Remove leading zero again after country code removal
        $cleanPhone = ltrim($cleanPhone, '0');

        // Get the last 9 digits
        if (strlen($cleanPhone) >= 9) {
            return substr($cleanPhone, -9);
        }

        // If less than 9 digits, pad with leading zeros to make it 9 digits
        return str_pad($cleanPhone, 9, '0', STR_PAD_LEFT);
    }
}
