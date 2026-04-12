<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(
        protected OtpService $otpService,
        protected IdentifierResolver $resolver
    ) {}

    /**
     * Step 1: Send OTP
     */
    public function sendOtp(string $input): void
    {
        $data = $this->resolver->resolve($input);

        $identifier = $data['identifier'];
        $channel    = $data['channel'];

        // cooldown check
        if ($this->otpService->hasCooldown($identifier)) {
            throw ValidationException::withMessages([
                'identifier' => __('auth.otp_cooldown'),
            ]);
        }

        $this->otpService->send($identifier, $channel, 'login');
    }

    /**
     * Step 2: Verify OTP and login
     */
    public function verifyOtp(string $input, string $otp): User
    {
        $data = $this->resolver->resolve($input);

        $identifier = $data['identifier'];
        $channel    = $data['channel'];

        // verify OTP
        $this->otpService->verify($identifier, $otp, 'login');

        // find or create user
        $user = $this->findOrCreateUser($identifier, $channel);

        if (isset($user->status) && $user->status !== 'active') {
            throw ValidationException::withMessages([
                'identifier' => __('auth.account_disabled'),
            ]);
        }

        Auth::login($user, remember: true);
        request()->session()->regenerate();

        return $user;
    }

    /**
     * Find or auto-register user
     */
    protected function findOrCreateUser(string $identifier, string $channel): User
    {
        $field = $channel === 'phone' ? 'phone' : 'email';

        $user = User::firstOrCreate(
            [$field => $identifier],
            [
                'name' => $this->defaultName($identifier, $channel),
                'password' => null,
            ]
        );

        if (! $user->hasRole('user')) {
            $user->assignRole('user');
        }

        return $user;
    }

    /**
     * Generate default name
     */
    protected function defaultName(string $identifier, string $channel): string
    {
        if ($channel === 'email') {
            return Str::title(explode('@', $identifier)[0]);
        }

        return 'User_' . substr($identifier, -4);
    }
}