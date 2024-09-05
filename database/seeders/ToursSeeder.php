<?php

namespace Database\Seeders;

use App\Models\Tours;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tours::factory()
            ->count(10)
            ->create();
    }
}
