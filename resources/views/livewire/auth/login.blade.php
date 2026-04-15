<div>
    <div class="login-wrapper">
        <div class="loginbox">
            <div class="login-auth">
                <div class="login-auth-wrap">
                    <div class="sign-group">
                        <a href="{{ route('home') }}" class="btn sign-up"><span><i class="fe feather-corner-down-left"
                                    aria-hidden="true"></i></span> {{ __('message.Back_To_Home') }}</a>
                    </div>
                    <h1>{{ __('message.Sign_In') }}</h1>

                    {{-- STEP 1: Identifier --}}
                    @if ($step === 1)
                        <p class="account-subtitle">{{ __('message.We_will_send_a_confirmation_code_to_your_email') }}.</p>

                        <div>
                            <div class="input-block">
                                <label class="form-label">{{ __('message.Email_or_Phone') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="identifier" class="form-control"
                                    placeholder="" autocomplete="username">
                                @error('identifier')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="button" wire:click="sendOtp"
                                class="btn btn-outline-light w-100 btn-size mt-1">{{ __('message.Sign_In') }}</button>

                            <div class="text-center dont-have mt-3">{{ __('message.Dont_have_an_account_yet') }}? <a
                                    href="{{ route('register') }}">{{ __('message.Register') }}</a></div>
                        </div>
                    @endif

                    {{-- STEP 2: OTP --}}
                    @if ($step === 2)
                        <p class="account-subtitle">{{ __('message.Enter_Verification_Code') }}</p>

                        <div>
                            <div class="input-block">
                                <label class="form-label">{{ __('message.Enter_Verification_Code') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="otp" class="form-control text-center"
                                    placeholder="______" inputmode="numeric" autocomplete="one-time-code" maxlength="6"
                                    style="font-size:1.15rem; letter-spacing:0.35rem;">
                                @error('otp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-block d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <a href="#" class="forgot-link m-0" wire:click.prevent="$set('step', 1)"><i
                                        class="fe feather-arrow-left" aria-hidden="true"></i>
                                    {{ __('message.Back') }}</a>
                                <a href="#" class="forgot-link m-0" wire:click.prevent="resendOtp">{{ __('message.Resend_Code') }}</a>
                            </div>

                            <button type="button" wire:click="verifyOtp"
                                class="btn btn-outline-light w-100 btn-size mt-1">{{ __('message.Verify_Now') }}</button>

                            <div class="text-center dont-have mt-3">{{ __('message.Dont_have_an_account_yet') }}? <a
                                    href="{{ route('register') }}">{{ __('message.Register') }}</a></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
