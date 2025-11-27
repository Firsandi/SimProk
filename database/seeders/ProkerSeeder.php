<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proker;

class ProkerSeeder extends Seeder
{
    public function run(): void
    {
        Proker::create([
            'room_id' => 1,
            'name' => 'PPMB',
            'description' => 'Pengenalan mengenai FASILKOM kepada Mahasiswa Baru',
            'year' => 2025,
            'start_date' => now()->subDays(10),
            'end_date' => now()->addDays(10),
            'status' => 'ongoing',
        ]);

        Proker::create([
            'room_id' => 1,
            'name' => 'TIC',
            'description' => 'Workshop dan Lomba Teknologi tingkat Nasional',
            'year' => 2025,
            'start_date' => now()->subDays(5),
            'end_date' => now()->addDays(15),
            'status' => 'ongoing',
        ]);

        Proker::create([
            'room_id' => 1,
            'name' => 'COD',
            'description' => 'Pengembangan karakter pengurus HIMATIF',
            'year' => 2025,
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(20),
            'status' => 'ongoing',
        ]);
    }
}
