<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::create([
            'name' => 'BEM',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'admin_id' => 1,
            'status' => 'active',
            'room_type' => 'bendahara',
        ]);
        Room::create([
            'name' => 'HIMASIF',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'status' => 'active',
            'admin_id' => 1, 
            'room_type' => 'bendahara',
        ]);
        Room::create([
            'name' => 'HIMATIF',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'admin_id' => 1,
            'status' => 'active',
            'room_type' => 'bendahara',
        ]);
        Room::create([
            'name' => 'HMIF',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'admin_id' => 1,
            'status' => 'active',
            'room_type' => 'bendahara',
        ]);
    }
}
