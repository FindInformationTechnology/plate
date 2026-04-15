<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function authenticate(): void
    {
        
        if (! Auth::attempt($this->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);
        }

        // ✅ Check role using Spatie
        if (! Auth::user()->hasRole('admin')) {
            Auth::logout();

            throw ValidationException::withMessages([
                'email' => 'Access denied (not admin)',
            ]);
        }
    }
}