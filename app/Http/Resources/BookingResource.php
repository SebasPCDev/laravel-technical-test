<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tour_id' => $this->tour_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'reservation_date' => $this->reservation_date,
            'number_of_people' => $this->number_of_people,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
