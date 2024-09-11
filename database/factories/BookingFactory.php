<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'id' => $this->faker->uuid(),
            'user_id' => User::inRandomOrder()->first()->id,
            'tour_id' => Tour::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'reservation_date' => $this->faker->dateTime(),
            'number_of_people' => $this->faker->numberBetween(1, 5),
        ];
    }
}
