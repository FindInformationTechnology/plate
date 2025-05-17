<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Emirate extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name','slug','image'];

    protected $appends = ['image_url'];

    public function code () {
        return $this->hasMany(Code::class);
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
