<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_entries', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['revenue', 'expense']); // money-in or money-out
            $table->string('category', 100);              // user-chosen type label
            $table->decimal('amount', 12, 2);
            $table->string('description', 255)->nullable();
            $table->date('entry_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_entries');
    }
};
