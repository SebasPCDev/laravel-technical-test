<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(10)->create();
        Tour::factory(10)->create();
        Booking::factory(20)->create();
    }
}
