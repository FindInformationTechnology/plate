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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'password' => 'hashed',
        ];
    }

    public function getPhoneNumberAttribute()
    {
        return '+971'. $this-> processPhoneNumber( $this->phone);
    }

    public function getWhatsappNumberAttribute()
    {
        return '+971' . $this-> processPhoneNumber( $this->whatsapp);
    }

    private function processPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        
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
}
