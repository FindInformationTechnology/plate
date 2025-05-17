<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    //
    protected $fillable = ['name',
        'emirate_id','status'];
    public function emirate()
    {
        return $this->belongsTo(Emirate::class);
    }
    public function getCodeAttribute($value)
    {
        return $value;
    }
   
    
    
}
