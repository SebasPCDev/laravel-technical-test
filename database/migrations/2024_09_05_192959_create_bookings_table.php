<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->index();
            $table->string('status');
            $table->string('reservation_date');
            $table->integer('number_of_people');
            $table->timestamps();

            // Llaves foráneas
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('tour_id')->constrained('tours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
