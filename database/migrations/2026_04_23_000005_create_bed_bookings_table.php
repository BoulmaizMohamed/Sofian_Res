<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bed_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bed_id')->constrained()->cascadeOnDelete();
            $table->string('client_name');
            $table->string('phone_number')->nullable();
            $table->string('national_id')->nullable();
            $table->date('date');
            $table->timestamps();

            // A bed can only have one booking per day
            $table->unique(['bed_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bed_bookings');
    }
};
