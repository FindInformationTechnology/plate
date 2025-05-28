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
        'is_featured',
        'is_premium',
        'is_urgent',
        'image'
    ];
    protected $appends = ['image_url', 'price_digits', 'views_count'];

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

            if (app()->getLocale() == 'ar') {
                
                return 'تواصل للسعر';
            }
            else{
               
                return 'Call for Price';
            }
        }

       

        // Format price as integer (no decimal places)
        return number_format((int)$this->price, 0) .' '. $this->currency();
    }

    public function getImageUrlAttribute()
    {
        if ($this->image == null) {
            return asset('assets/media/plates/default.png');
        } else {
            return asset('storage/' . $this->image);
        }
    }

    // ... existing code ...

    public function getViewsCountAttribute()
    {
        return $this->views()->count();
    }

    // related to search

    public function scopeActive($query)
    {
        return $query->where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false);
    }

    public function scopeSimilarTo($query, $plate, $excludeId = true)
    {
        $query->active();

        if ($excludeId) {
            $query->where('id', '!=', $plate->id);
        }

        return $query;
    }

    public function scopeSameEmirate($query, $emirateId)
    {
        return $query->where('emirate_id', $emirateId);
    }

    public function scopeSameCode($query, $codeId)
    {
        return $query->where('code_id', $codeId);
    }

    public function scopeSimilarPrice($query, $price, $rangeFactor = 0.2)
    {
        $minPrice = $price * (1 - $rangeFactor);
        $maxPrice = $price * (1 + $rangeFactor);

        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    public function currency () {
        if (app()->getLocale() == 'ar') {
            return 'د.إ';
        }
        else{
            return 'AED';
        }
    }
}
