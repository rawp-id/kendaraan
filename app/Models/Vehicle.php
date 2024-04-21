<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
