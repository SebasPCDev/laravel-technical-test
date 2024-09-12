<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Booking extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_new_booking_success_response_and_body_structure()
    {
        $randomTour = $this->get('/api/v1/tours')->json('data')[0];
        $randomUser = $this->get('/api/v1/users')->json('data')[0];

        $response = $this->post('/api/v1/bookings', [
            'user_id' => $randomUser['id'],
            'tour_id' => $randomTour['id'],
            'status' => 'pending',
            'number_of_people' => 2,
            'reservation_date' => '2024-10-10',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'user_id',
                'tour_id',
                'status',
                'number_of_people',
                'reservation_date',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
