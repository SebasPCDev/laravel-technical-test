<?php

namespace Tests\Feature;

use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class TourTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_tours_success_response_and_body_structure()
    {

        Artisan::call('migrate --seed');

        $response = $this->get('/api/v1/tours');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'price',
                    'location',
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

    public function test_get_tours_by_user_id_body_structure_and_success_response()
    {
        Artisan::call('migrate --seed');

        $tourRandom = $this->get('/api/v1/tours')->json('data')[0];

        $response = $this->get('/api/v1/tours/' . $tourRandom['id']);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'price',
                    'location',
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
                ]


            ],

        );
    }

    public function test_get_tours_by_user_id_not_found_response_and_body_structure()
    {
        Artisan::call('migrate --seed');


        $response = $this->get('/api/v1/tours/100');
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message',
            'status',
            'data',
        ]);

        $response->assertJson([
            'message' => 'No query results for model [App\Models\Tour] 100',
            'status' => 404,
        ]);
    }

    public function test_post_new_tour_success_response_and_body_structure()
    {
        Artisan::call('migrate --seed');

        $response = $this->post('/api/v1/tours', [
            'title' => 'New Tour',
            'description' => 'Explora la belleza de la selva amazónica con un guía experto.',
            'price' => 100,
            'location' => 'New Tour Location',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'price',
                'location',
                'bookings',
                'created_at',
                'updated_at',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'title' => 'New Tour',
                'description' => 'Explora la belleza de la selva amazónica con un guía experto.',
                'price' => 100,
                'location' => 'New Tour Location'
            ],
        ]);
    }

    public function test_post_new_tour_error_response_and_body_structure_with_invalid_data()
    {
        $this->withoutExceptionHandling();
        Artisan::call('migrate --seed');

        try {
            $response = $this->post('/api/v1/tours', [
                'title' => '',
                'description' => 'Explora',
                'price' => 'inválido', // Precio inválido a propósito
                'location' => '',

            ]);
        } catch (ValidationException $e) {
            // Verifica que los errores de validación están presentes
            $errors = $e->errors();
            $this->assertArrayHasKey('title', $errors);
            $this->assertArrayHasKey('description', $errors);
            $this->assertArrayHasKey('location', $errors);
            return;
        }

        $this->fail('Expected ValidationException was not thrown.');

    }

    public function test_put_tour_success_response_and_body_structur()
    {
        Artisan::call('migrate --seed');

        $tourRandom = $this->get('/api/v1/tours')->json('data')[0];

        $response = $this->put('/api/v1/tours/' . $tourRandom['id'], [
            'title' => 'New Tour',
            'description' => 'Explora la belleza de la selva amazónica con un guía experto.',
            'price' => 100,
            'location' => 'New Tour Location'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'price',
                'location',
                'bookings',
                'created_at',
                'updated_at',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'title' => 'New Tour',
                'description' => 'Explora la belleza de la selva amazónica con un guía experto.',
                'price' => 100,
                'location' => 'New Tour Location'
            ],
        ]);

    }

    public function test_delete_tour_success_response_and_body_structure()
    {
        Artisan::call('migrate --seed');

        $tourRandom = $this->get('/api/v1/tours')->json('data')[0];

        $response = $this->delete('/api/v1/tours/' . $tourRandom['id']);
        $response->assertStatus(204);
    }
    public function test_delete_tour_error_response_and_body_structure()
    {
        Artisan::call('migrate --seed');

        $response = $this->delete('/api/v1/tours/100');
        $response->assertStatus(404);
    }





}
