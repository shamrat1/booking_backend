<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('car_make')->nullable();
            $table->string('car_model')->nullable();
            $table->integer('car_year')->nullable();
            $table->string('registration_plate')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('booking_title')->nullable();
            $table->timestamp('start_datetime')->nullable();
            $table->timestamp('end_datetime')->nullable();
            $table->foreignId('mechanic_id')->constrained('users')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->enum('status', ['pending', 'in-progress', 'no-show', 'complete', 'waiting-for-parts', 'cancelled',]);
            $table->timestamps();
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
