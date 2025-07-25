<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // Check rate limiting
        $key = 'send-sms:' . $user->id;
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
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
        $sent = $this->smsService->sendVerificationCode($user->phone, $code);

        
        // Record the attempt for rate limiting
        RateLimiter::hit($key, 300); // 5 minutes
        
        if (!$sent) {
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
            
            if ($attemptsLeft <= 0) {
                throw ValidationException::withMessages([
                    'code' => __('message.Too_Many_Verification_Attempts'),
                ]);
            }

            throw ValidationException::withMessages([
                'code' => __('message.Invalid_Verification_Code', ['attempts' => $attemptsLeft]),
            ]);
        }

        // Mark phone as verified
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
     * Skip phone verification (if allowed)
     */
    public function skip(Request $request)
    {
        // Only allow skipping in development or for specific user types
        if (!config('app.debug')) {
            abort(403);
        }

        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        $user->update(['phone_verification_required' => false]);

        return redirect()->intended(route('user.dashboard'))
            ->with('info', __('message.Phone_Verification_Skipped'));
    }
} 