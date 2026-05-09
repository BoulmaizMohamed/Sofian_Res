<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add num_days to reservations (so the public client can specify stay duration)
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedInteger('num_days')->default(1)->after('num_beds');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('num_days');
        });
    }
};
