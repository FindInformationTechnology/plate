<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PlateView extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_id',
        'ip_address',
        'user_agent',
        'user_id'
    ];

    public function plate()
    {
        return $this->belongsTo(Plate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
