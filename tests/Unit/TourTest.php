<?php

namespace Tests\Unit;

use App\Http\Resources\TourResource;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class TourTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    use RefreshDatabase;

    /** @test */
    public function a_tour_can_be_created_by_a_user()
    {
        // Crea un usuario
        $user = User::factory()->create();

        // Crea un tour asociado a este usuario
        $tour = new TourResource(Tour::create([
            'title' => 'Tour por la ciudad',
            'description' => 'Un recorrido turístico por la ciudad',
            'price' => 100.00,
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(3),
            'location' => 'New York',
            'user_id' => $user->id, // Asociación con el usuario
        ]));

        // Verificar que el tour se ha creado
        $this->assertInstanceOf(Tour::class, $tour);

        // Verificar que el tour está asociado con el usuario correcto
        $this->assertEquals($user->id, $tour->user_id);
    }



}
