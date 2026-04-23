<?php

namespace Database\Seeders;

use App\Models\Bed;
use App\Models\Room;
use Illuminate\Database\Seeder;

class BedSeeder extends Seeder
{
    public function run(): void
    {
        // Create an initial VIP Room
        $vipRoom = Room::create([
            'name' => 'VIP Room',
            'description' => 'A nice view for VIP clients',
            'capacity' => 5,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            Bed::create([
                'room_id' => $vipRoom->id,
                'name'    => 'Bed ' . $i,
            ]);
        }

        // Create an initial General Room
        $generalRoom = Room::create([
            'name' => 'General Section A',
            'description' => 'Main beach area section',
            'capacity' => 15,
        ]);

        for ($i = 1; $i <= 15; $i++) {
            Bed::create([
                'room_id' => $generalRoom->id,
                'name'    => 'A' . $i,
            ]);
        }

        $this->command->info('✅ Seeded 2 rooms and 20 beds successfully.');
    }
}
