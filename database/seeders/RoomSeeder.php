<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::create([
            'name' => 'HMIF',
            'slug' => 'hmif',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'admin_id' => 1, // id user admin
            'status' => 'active',
            'color' => 'blue',
            'room_type' => 'sekretaris',
        ]);

        Room::create([
            'name' => 'BEM Fasilkom',
            'slug' => 'bem-fasilkom',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'admin_id' => 1,
            'status' => 'active',
            'color' => 'green',
            'room_type' => 'bendahara',
        ]);
    }
}
