<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $appends  = ['phone_number', 'whatsapp_number', 'profile_photo_url'];
    protected $fillable = [
        'name', 'email', 'phone', 'whatsapp', 'password', 'nationality', 'status',
        'photo',
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
            'password'          => 'hashed',
        ];
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = $this->normalizePhone($value);
    }

    public function setWhatsappAttribute($value)
    {
        $this->attributes['whatsapp'] = $this->normalizePhone($value);
    }

    public function getPhoneNumberAttribute()
    {
        return $this->phone ? '+' . $this->phone : null;
    }

    public function getWhatsappNumberAttribute()
    {
        return $this->whatsapp ? '+' . $this->whatsapp : null;
    }

    private function normalizePhone($phone)
    {
        if (! $phone) {
            return null;
        }

        // Remove non-numeric
        $clean = preg_replace('/[^0-9]/', '', $phone);

        if (! $clean) {
            return null;
        }

        // Remove leading zeros
        $clean = ltrim($clean, '0');

        // Remove country code if exists
        if (str_starts_with($clean, '971')) {
            $clean = substr($clean, 3);
        }

        // Remove leading zero again
        $clean = ltrim($clean, '0');

        // Must be exactly 9 digits (UAE mobile)
        if (strlen($clean) !== 9) {
            return null; // or throw exception if you prefer strict
        }

        return '971' . $clean;
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->photo ? asset($this->photo) : asset('assets/img/profiles/avatar.webp');
    }
}
