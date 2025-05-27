<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255'],
            'g-recaptcha-response' => ['required'],
        ]);

        // Verify reCAPTCHA
        $recaptchaResult = $this->verifyRecaptcha($request->input('g-recaptcha-response'));

        if (!$recaptchaResult['success']) {
            app()->isLocale('ar') ? $message = 'فشل التحقق من reCAPTCHA' : $message = 'reCAPTCHA verification failed';
            return back()->withErrors(['g-recaptcha-response' => $message])->withInput();
        }


        if (!$recaptchaResult['success']) {
            app()->isLocale('ar') ? $message = 'فشل التحقق من reCAPTCHA' : $message = 'reCAPTCHA verification failed';
            return back()->withErrors(['g-recaptcha-response' => $message])->withInput();
        }

        // If score is too low (potential bot)
        if ($recaptchaResult['score'] < 0.5) {
            app()->isLocale('ar') ? $message = 'تم رفض التسجيل بسبب نشاط مشبوه' : $message = 'Registration rejected due to suspicious activity';
            return back()->withErrors(['g-recaptcha-response' => $message])->withInput();
        }

        // Process phone number to get last 9 digits
        $phoneNumber = $this->processPhoneNumber($request->phone);

        app()->isLocale('ar') ? $message = 'هذا الرقم مسجل بالفعل' : $message = 'This phone number is already registered';

        // Check if processed phone number already exists
        if (User::where('phone', $phoneNumber)->exists()) {
            return back()->withErrors(['phone' => $message])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phoneNumber,

            'password' => Hash::make($request->password),
        ]);

        // Assign the 'user' role to the newly registered user
        $user->assignRole('user');

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeEmail($user));

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false))
            ->with('success', 'Welcome to Plate! A confirmation email has been sent to your email address.');

        // return redirect(route('dashboard', absolute: false));
    }

    public function processPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone); // 

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

    private function verifyRecaptcha($token)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => request()->ip()
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result, true);
    }
}
