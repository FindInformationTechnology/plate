<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

     protected $appends = ['phone_number','whatsapp_number'];
    protected $fillable = [
        'name','email','phone', 'whatsapp','password','nationality','status',
        'google_id',
        'facebook_id',
        'twitter_id',
        'phone_verified_at',
        'phone_verification_required',
        'phone_verification_sent_at',
        'phone_verification_code',
        'phone_verification_attempts',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'phone_verification_code',
    ];

    public function plates()
    {
        return $this->hasMany(Plate::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'phone_verification_sent_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPhoneNumberAttribute()
    {
        if (!$this->phone) {
            return null;
        }
        
        $processed = $this->processPhoneNumber($this->phone);
        return $processed ? '+971' . $processed : null;
    }

    public function getWhatsappNumberAttribute()
    {
        if (!$this->whatsapp) {
            return null;
        }
        
        $processed = $this->processPhoneNumber($this->whatsapp);
        return $processed ? '+971' . $processed : null;
    }

    private function processPhoneNumber($phone)
    {
        if (!$phone || trim($phone) === '') {
            return null;
        }
        
        // Remove all non-numeric characters
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        
        // If empty after cleaning, return null
        if (empty($cleanPhone)) {
            return null;
        }
        
        // Remove leading zeros
        $cleanPhone = ltrim($cleanPhone, '0');
        
        // Remove common UAE country code if present
        if (substr($cleanPhone, 0, 3) === '971') {
            $cleanPhone = substr($cleanPhone, 3);
        }
        
        // Remove leading zero again after country code removal
        $cleanPhone = ltrim($cleanPhone, '0');
        
        // Validate minimum length (at least 7 digits for UAE mobile)
        if (strlen($cleanPhone) < 7) {
            return null;
        }
        
        // Get the last 9 digits
        if (strlen($cleanPhone) >= 9) {
            return substr($cleanPhone, -9);
        }
        
        // If less than 9 digits, pad with leading zeros to make it 9 digits
        return str_pad($cleanPhone, 9, '0', STR_PAD_LEFT);
    }

    /**
     * Check if user's phone is verified
     */
    public function hasVerifiedPhone(): bool
    {
        return !is_null($this->phone_verified_at);
    }

    /**
     * Check if user needs phone verification
     */
    public function needsPhoneVerification(): bool
    {
        return $this->phone_verification_required && !$this->hasVerifiedPhone();
    }

    /**
     * Mark phone as verified
     */
    public function markPhoneAsVerified(): void
    {
        $this->forceFill([
            'phone_verified_at' => now(),
            'phone_verification_code' => null,
            'phone_verification_attempts' => 0,
        ])->save();
    }

    /**
     * Generate and store phone verification code
     */
    public function generatePhoneVerificationCode(): string
    {
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->forceFill([
            'phone_verification_code' => $code,
            'phone_verification_sent_at' => now(),
        ])->save();

        return $code;
    }

    /**
     * Check if verification code is valid
     */
    public function isValidPhoneVerificationCode(string $code): bool
    {
        if (!$this->phone_verification_code) {
            return false;
        }

        // Check if code matches
        if ($this->phone_verification_code !== $code) {
            $this->increment('phone_verification_attempts');
            return false;
        }

        // Check if code is not expired (5 minutes)
        if ($this->phone_verification_sent_at->addMinutes(5)->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Check if user can request new verification code
     */
    public function canRequestNewVerificationCode(): bool
    {
        if (!$this->phone_verification_sent_at) {
            return true;
        }

        // Allow new code after 1 minute
        return $this->phone_verification_sent_at->addMinute()->isPast();
    }

    /**
     * Check if user is blocked from verification (too many attempts)
     */
    public function isBlockedFromVerification(): bool
    {
        return $this->phone_verification_attempts >= 5;
    }
}
