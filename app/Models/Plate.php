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
        'code',
        'number',
        'length',
        'price',
        'is_approved',
        'is_sold',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emirate()
    {
        return $this->belongsTo(Emirate::class);
    }
}
