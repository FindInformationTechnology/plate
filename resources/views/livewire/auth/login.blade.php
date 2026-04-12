<div>
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow">

<h2 class="text-xl font-bold mb-4 text-center">
    {{ $step === 1 ? 'Login' : 'Enter OTP' }}
</h2>

{{-- STEP 1: Identifier --}}
@if ($step === 1)

    <div class="space-y-4">

        <input
            type="text"
            wire:model.defer="identifier"
            placeholder="Enter phone or email"
            class="w-full border rounded px-3 py-2"
        >

        @error('identifier')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <button
            wire:click="sendOtp"
            class="w-full bg-blue-600 text-white py-2 rounded"
        >
            Continue
        </button>

    </div>

@endif

{{-- STEP 2: OTP --}}
@if ($step === 2)

    <div class="space-y-4">

        <input
            type="text"
            wire:model.defer="otp"
            placeholder="Enter OTP"
            class="w-full border rounded px-3 py-2 text-center tracking-widest"
        >

        @error('otp')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <button
            wire:click="verifyOtp"
            class="w-full bg-green-600 text-white py-2 rounded"
        >
            Verify & Login
        </button>

        <button
            wire:click="resendOtp"
            class="text-sm text-blue-500 underline"
        >
            Resend OTP
        </button>

    </div>

@endif

</div>
</div>
