<?php

namespace Tests\Feature;

use App\Models\User;
use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_users_success_response_and_body_structure()
    {

        Artisan::call('migrate --seed');

        $response = $this->get('/api/v1/users');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'password',
                    'created_at',
                    'updated_at',
                    'bookings' => [
                        '*' => [
                            'id',
                            'user_id',
                            'tour_id',
                            'status',
                            'number_of_people',
                            'reservation_date',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ],
            ],
        ]);
    }
    public function test_get_bookings_by_user_id_body_structure_and_success_response()
    {
        Artisan::call('migrate --seed');

        $userRandom = $this->get('/api/v1/users')->json('data')[0];

        $response = $this->get('/api/v1/users/' . $userRandom['id'] . '/bookings');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'status',
                    'reservation_date',
                    'number_of_people',
                    'created_at',
                    'updated_at',
                    'user_id',
                    'tour_id',
                ],
            ],
        );
    }
    public function test_get_bookings_by_user_id_not_found_response_and_body_structure()
    {
        Artisan::call('migrate --seed');


        $response = $this->get('/api/v1/users/100/bookings');
        $response->assertStatus(404);

        $response->assertJsonStructure([
            'message',
            'status',
            'data',
        ]);

        $response->assertJson([
            'message' => 'No query results for model [App\Models\User] 100',
            'status' => 404
        ]);
    }
}
