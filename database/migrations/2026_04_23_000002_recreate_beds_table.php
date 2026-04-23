<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->string('name'); // display name e.g. "A1", "B2", "Bed 1"
            $table->enum('status', ['available', 'reserved'])->default('available');
            // Client info (filled when reserved)
            $table->string('client_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('national_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beds');
    }
};
