<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_categories', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['revenue', 'expense']);
            $table->string('name', 100);
            $table->boolean('is_default')->default(false); // flags the built-in ones
            $table->timestamps();

            $table->unique(['type', 'name']); // no duplicate names per type
        });

        // Seed the default categories
        $now = now();
        $defaults = [
            // Revenue
            ['type' => 'revenue', 'name' => 'Beach Rental',      'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'revenue', 'name' => 'Room Booking Fee',   'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'revenue', 'name' => 'Service Charge',     'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'revenue', 'name' => 'Food & Beverage',    'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'revenue', 'name' => 'Equipment Rental',   'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'revenue', 'name' => 'Other Income',       'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            // Expense
            ['type' => 'expense', 'name' => 'Staff Salaries',     'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'expense', 'name' => 'Maintenance',        'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'expense', 'name' => 'Supplies',           'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'expense', 'name' => 'Utilities',          'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'expense', 'name' => 'Marketing',          'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'expense', 'name' => 'Insurance',          'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
            ['type' => 'expense', 'name' => 'Other Expense',      'is_default' => true,  'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('revenue_categories')->insert($defaults);
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_categories');
    }
};
