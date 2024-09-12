<?php

namespace Tests\Feature;

use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Faker\Factory as Faker;

class BookingTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    protected $faker;

    protected function setUp(): void
    {
        parent::setUp(); // Inicializa el entorno de Laravel correctamente

        $this->faker = Faker::create();
    }
    public function test_post_new_booking_success_response_and_body_structure()
    {
        Artisan::call('migrate:fresh --seed');


        $randomTour = $this->get('/api/v1/tours')->json('data')[0];
        $randomUser = $this->get('/api/v1/users')->json('data')[0];

        $response = $this->post('/api/v1/bookings', [
            'user_id' => $randomUser['id'],
            'tour_id' => $randomTour['id'],
            'status' => 'pending',
            'number_of_people' => 2,
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
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

    public function test_post_new_booking_error_response_and_body_structure()
    {
        $randomDate = $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s');

        $response = $this->postJson('/api/v1/bookings', [
            'user_id' => 0,
            'tour_id' => 0,
            'status' => 'approved',
            'number_of_people' => 0,
            'reservation_date' => $randomDate,
        ]);

        // Verifica que la respuesta tiene código 422 (Unprocessable Entity)
        $response->assertStatus(422);

        //Verifica que los errores de validación contienen las claves esperadas
        $response->assertJsonStructure([
            'errors' => [
                'user_id',
                'tour_id',
                'number_of_people',
            ],
        ]);

        // // Opcionalmente, puedes verificar mensajes de error específicos
        $response->assertJsonFragment([
            'user_id' => ['El id del usuario es obligatorio y debe ser un UUID válido.'],
            'tour_id' => ['El id del tour es obligatorio y debe ser un UUID válido.'],
            'number_of_people' => ['Debe haber al menos una persona en la reserva.'],
            'reservation_date' => ['La fecha de reserva debe ser hoy o una fecha futura.'],
            'status' => ['El estado de la reserva debe ser pending.'],
        ]);
    }

    public function test_post_new_booking_error_two_same_tours_same_user()
    {

        Artisan::call('migrate:fresh --seed');
        $randomTour = $this->get('/api/v1/tours')->json('data')[0];
        $randomUser = $this->get('/api/v1/users')->json('data')[0];

        $response = $this->post('/api/v1/bookings', [
            'user_id' => $randomUser['id'],
            'tour_id' => $randomTour['id'],
            'status' => 'pending',
            'number_of_people' => 2,
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
        ]);

        $response = $this->post('/api/v1/bookings', [
            'user_id' => $randomUser['id'],
            'tour_id' => $randomTour['id'],
            'status' => 'pending',
            'number_of_people' => 2,
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(400);
        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJsonFragment([
            'Ya tienes una reserva pendiente para este tour.',
        ]);
    }

    public function test_update_status_booking_success_response_and_body_structure()
    {
        Artisan::call('migrate:fresh --seed');
        $randomTour = $this->get('/api/v1/tours')->json('data')[0];
        $randomUser = $this->get('/api/v1/users')->json('data')[0];

        $createNewBooking = $this->post('/api/v1/bookings', [
            'user_id' => $randomUser['id'],
            'tour_id' => $randomTour['id'],
            'status' => 'pending',
            'number_of_people' => 2,
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
        ]);

        $booking = $createNewBooking->json('data');

        $responseUpdate = $this->putJson('/api/v1/bookings/' . $booking['id'], [
            'status' => 'approved',
        ]);

        $responseUpdate->assertStatus(200);
        $responseUpdate->assertJsonStructure([
            'message',
            'status',
            'data'
        ]);

        $responseUpdate->assertJsonFragment([
            'message' => 'Reserva actualizada',
            'status' => 200,

        ]);
    }
}
