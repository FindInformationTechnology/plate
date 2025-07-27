<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class PhoneVerificationController extends Controller
{
    protected SmsService $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
        // Remove middleware call from constructor - it will be applied in routes
    }

    /**
     * Show phone verification form
     */
    public function show(Request $request)
    {
        $user = $request->user();

        // If phone is already verified, redirect to intended page
        if ($user && $user->hasVerifiedPhone()) {
            return redirect()->intended(route('user.dashboard'));
        }

        // Auto-send verification code on first visit (if user hasn't received one recently)
        $autoSent = false;
        if ($user && $user->canRequestNewVerificationCode() && !$user->isBlockedFromVerification()) {
            try {

              
                // Check if this is likely a first visit (no recent verification code)
                $isFirstVisit = !$user->phone_verification_sent_at || 
                               $user->phone_verification_sent_at->addMinutes(10)->isPast();
                
                if ($isFirstVisit) {
                    $code = $user->generatePhoneVerificationCode();
                    $sent = $this->smsService->sendVerificationCode($user->phone, $code);
                    
                    if ($sent) {
                        $autoSent = true;
                       
                        session()->flash('status', __('message.Verification_Code_Sent_Automatically'));
                    }
                }
            } catch (\Exception $e) {
                // If auto-send fails, don't block the page - user can still request manually
                \Log::warning('Auto-send verification code failed', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return view('auth.verify-phone', [
            'phoneNumber' => $user ? $user->phone : '',
            'canResend' => $user ? $user->canRequestNewVerificationCode() : false,
            'isBlocked' => $user ? $user->isBlockedFromVerification() : false,
            'autoSent' => $autoSent,
        ]);
    }

    /**
     * Send verification code
     */
    public function send(Request $request)
    {
        $user = $request->user();

        
        if (!$user) {
            abort(401);
        }

        // Check if user is blocked
        if ($user->isBlockedFromVerification()) {
            throw ValidationException::withMessages([
                'phone' => __('message.Too_Many_Verification_Attempts'),
            ]);
        }

        // Check rate limiting - production limits
        $key = 'send-sms:' . $user->id;
        $maxAttempts = config('sms.rate_limiting.max_attempts_per_hour', 5);
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            
            Log::warning('SMS rate limit exceeded', [
                'user_id' => $user->id,
                'phone' => $user->phone,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'platform' => 'plate35.com'
            ]);
            
            throw ValidationException::withMessages([
                'phone' => __('message.Too_Many_SMS_Requests', ['seconds' => $seconds]),
            ]);
        }

        // Check if user can request new code
        if (!$user->canRequestNewVerificationCode()) {
            throw ValidationException::withMessages([
                'phone' => __('message.Wait_Before_Requesting_New_Code'),
            ]);
        }

        // Generate and send verification code
        $code = $user->generatePhoneVerificationCode();
        
        Log::info('SMS verification code requested', [
            'user_id' => $user->id,
            'phone' => substr($user->phone, 0, 3) . '****' . substr($user->phone, -3),
            'ip' => $request->ip(),
            'platform' => 'plate35.com'
        ]);
        
        $sent = $this->smsService->sendVerificationCode($user->phone, $code);

        // Record the attempt for rate limiting
        RateLimiter::hit($key, 300); // 5 minutes
        
        if (!$sent) {
            Log::error('SMS sending failed', [
                'user_id' => $user->id,
                'phone' => substr($user->phone, 0, 3) . '****' . substr($user->phone, -3),
                'ip' => $request->ip(),
                'platform' => 'plate35.com'
            ]);
            
            throw ValidationException::withMessages([
                'phone' => __('message.Failed_To_Send_SMS'),
            ]);
        }
       
        
        if ($request->expectsJson()) {
            return response()->json([
                'message' => __('message.Verification_Code_Sent'),
            ]);
        }

        return back()->with('status', __('message.Verification_Code_Sent'));
    }

    /**
     * Verify the submitted code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        $code = $request->input('code');

        // Check if user is blocked
        if ($user->isBlockedFromVerification()) {
            throw ValidationException::withMessages([
                'code' => __('message.Too_Many_Verification_Attempts'),
            ]);
        }

        // Verify the code
        if (!$user->isValidPhoneVerificationCode($code)) {
            $attemptsLeft = 5 - $user->phone_verification_attempts;
            
            Log::warning('Invalid verification code attempt', [
                'user_id' => $user->id,
                'phone' => substr($user->phone, 0, 3) . '****' . substr($user->phone, -3),
                'attempts_left' => $attemptsLeft,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'platform' => 'plate35.com'
            ]);
            
            if ($attemptsLeft <= 0) {
                Log::error('Phone verification blocked due to too many attempts', [
                    'user_id' => $user->id,
                    'phone' => substr($user->phone, 0, 3) . '****' . substr($user->phone, -3),
                    'ip' => $request->ip(),
                    'platform' => 'plate35.com'
                ]);
                
                throw ValidationException::withMessages([
                    'code' => __('message.Too_Many_Verification_Attempts'),
                ]);
            }

            throw ValidationException::withMessages([
                'code' => __('message.Invalid_Verification_Code', ['attempts' => $attemptsLeft]),
            ]);
        }

        // Mark phone as verified
        Log::info('Phone verification successful', [
            'user_id' => $user->id,
            'phone' => substr($user->phone, 0, 3) . '****' . substr($user->phone, -3),
            'ip' => $request->ip(),
            'platform' => 'plate35.com'
        ]);
        
        $user->markPhoneAsVerified();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => __('message.Phone_Verified_Successfully'),
                'redirect' => route('user.dashboard'),
            ]);
        }

        return redirect()->intended(route('user.dashboard'))
            ->with('success', __('message.Phone_Verified_Successfully'));
    }

    /**
     * Skip phone verification (Development only)
     */
    public function skip(Request $request)
    {
        // Only allow skipping in development
        if (!config('app.debug')) {
            Log::warning('Attempted to skip phone verification in production', [
                'user_id' => $request->user()?->id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'platform' => 'plate35.com'
            ]);
            abort(403, 'Phone verification skip is not allowed in production');
        }

        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        Log::info('Phone verification skipped (development)', [
            'user_id' => $user->id,
            'ip' => $request->ip(),
            'platform' => 'plate35.com'
        ]);

        $user->update(['phone_verification_required' => false]);

        return redirect()->intended(route('user.dashboard'))
            ->with('info', __('message.Phone_Verification_Skipped'));
    }
} 