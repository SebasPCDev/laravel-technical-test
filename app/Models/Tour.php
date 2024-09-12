<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\UUID;

class Tour extends Model
{
    use HasFactory, UUID;
    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
    ];

    /**
     * Get all of the  for the Tours
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
