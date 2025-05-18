<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emirate_id',
        'code_id',
        'number',
        'length',
        'price',
        'is_approved',
        'is_sold',
        'is_visible',
        'image'
    ];
    protected $appends = ['image_url', 'price_digits'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(PlateView::class);
    }

    public function emirate()
    {
        return $this->belongsTo(Emirate::class);
    }

    public function code()
    {
        return $this->belongsTo(Code::class);
    }

    public function getPriceDigitsAttribute()
    {
        if ($this->price <= 0) {
            return 'Call for Price';
        }

        // Format price as integer (no decimal places)
        return number_format((int)$this->price, 0) . ' AED';
    }

    public function getImageUrlAttribute()
    {
        if ($this->image == null) {
            return asset('assets/media/plates/default.png');
        } else {
            return asset('storage/' . $this->image);
        }
    }
}
