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
        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255'],
        ];

        
        // Add reCAPTCHA validation only in production
        if (!config('app.debug')) {
            $validationRules['g-recaptcha-response'] = ['required'];
        }
        
       
        $request->validate($validationRules);
        
    
        // Verify reCAPTCHA (skip in development)
        if (!config('app.debug')) {
            $recaptchaResult = $this->verifyRecaptcha($request->input('g-recaptcha-response'));

            if (!$recaptchaResult['success']) {
                app()->isLocale('ar') ? $message = 'فشل التحقق من reCAPTCHA' : $message = 'reCAPTCHA verification failed';
                return back()->withErrors(['g-recaptcha-response' => $message])->withInput();
            }

            // If score is too low (potential bot)
            if ($recaptchaResult['score'] < 0.5) {
                app()->isLocale('ar') ? $message = 'تم رفض التسجيل بسبب نشاط مشبوه' : $message = 'Registration rejected due to suspicious activity';
                return back()->withErrors(['g-recaptcha-response' => $message])->withInput();
            }
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

        $message = app()->isLocale('ar') ? 'تم تسجيلك بنجاح' : 'You have been registered successfully';

        return redirect(route('home', absolute: false))
            ->with('success', $message);

        // return redirect(route('dashboard', absolute: false));
    }

    public function processPhoneNumber($phone)
{
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

    // Remove country code if exists
    if (substr($cleanPhone, 0, 3) === '971') {
        $cleanPhone = substr($cleanPhone, 3);
    }

    // Remove leading zero
    $cleanPhone = ltrim($cleanPhone, '0');

    // Ensure exactly 9 digits
    $cleanPhone = str_pad(substr($cleanPhone, -9), 9, '0', STR_PAD_LEFT);

    return '971' . $cleanPhone;
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
