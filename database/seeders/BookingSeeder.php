<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {

        // Obtén todos los UUIDs de las tablas users y tours
        $userIds = User::pluck('id')->toArray(); // Array de todos los user_ids (UUIDs)
        $tourIds = Tour::pluck('id')->toArray(); // Array de todos los tour_ids (UUIDs)



        // Verifica que existan usuarios y tours para asignar
        if (empty($userIds) || empty($tourIds)) {
            $this->command->info('No hay usuarios o tours suficientes para generar bookings.');
            return;
        }
        Booking::factory()
            ->count(20)
            ->create([
                // Asignar un user_id y tour_id aleatorio a cada booking
                'user_id' => fn() => (string) $userIds[array_rand($userIds)], // Convertir a string explícitamente
                'tour_id' => fn() => (string) $tourIds[array_rand($tourIds)],
            ]);
    }
}
