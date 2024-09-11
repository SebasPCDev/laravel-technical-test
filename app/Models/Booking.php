<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Booking extends Model
{
    use HasFactory, UUID;
    protected $fillable = [
        'tour_id',
        'user_id',
        'status',
        'reservation_date',
        'number_of_people',
    ];

    /**
     * Get the user that owns the Bookings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
