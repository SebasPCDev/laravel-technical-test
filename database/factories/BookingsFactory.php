<?php

namespace Database\Factories;

use App\Models\Tours;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookings>
 */
class BookingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'user_id' => User::factory(),
            'tour_id' => Tours::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'reservation_date' => $this->faker->dateTime(),
            'number_of_people' => $this->faker->numberBetween(1, 5),
        ];
    }
}
