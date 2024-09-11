<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class User extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Get all of the bookings for the Users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


}
