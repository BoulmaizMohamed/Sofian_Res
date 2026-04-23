<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@beach.com')],
            [
                'name'     => 'Beach Admin',
                'password' => env('ADMIN_PASSWORD', 'password'),
            ]
        );

        $this->command->info('✅ Admin seeded: ' . env('ADMIN_EMAIL', 'admin@beach.com'));
    }
}
