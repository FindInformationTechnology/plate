<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\Auth\AuthService;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $identifier = '';
    public $otp = '';
    public $step = 1;

    public function sendOtp(AuthService $authService)
    {
        $this->resetErrorBag();

        try {
            $authService->sendOtp($this->identifier);

            $this->step = 2;

        } catch (ValidationException $e) {
            $this->setErrorBag($e->errors());
        }
    }

    public function verifyOtp(AuthService $authService)
    {
        $this->resetErrorBag();

        try {
            $authService->verifyOtp($this->identifier, $this->otp);

            $this->redirectIntended(route('user.dashboard'), navigate: false);
        } catch (ValidationException $e) {
            $this->setErrorBag($e->errors());
        }
    }

    public function resendOtp(AuthService $authService): void
    {
        $this->resetErrorBag();

        try {
            $authService->sendOtp($this->identifier);
        } catch (ValidationException $e) {
            $this->setErrorBag($e->errors());
        }
    }

    public function render()
    {
        
        return view('livewire.auth.login');
    }
}