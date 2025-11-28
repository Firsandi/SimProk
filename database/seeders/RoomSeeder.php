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
        ]);
        Room::create([
            'name' => 'HIMASIF',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'status' => 'active',
            'admin_id' => 1, 
        ]);
        Room::create([
            'name' => 'HIMATIF',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'admin_id' => 1,
            'status' => 'active',
        ]);
        Room::create([
            'name' => 'HMIF',
            'period' => '2024/2025',
            'organization_type' => 'ormawa',
            'admin_id' => 1,
            'status' => 'active',
        ]);
    }
}
