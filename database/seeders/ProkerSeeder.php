<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomProker;

class ProkerSeeder extends Seeder
{
    public function run(): void
    {
        RoomProker::create([
            'room_id'     => 1,
            'user_id'     => 1, // sesuaikan: id user pembuat proker
            'nama_proker' => 'PPMB',
            'deskripsi'   => 'Pengenalan mengenai FASILKOM kepada Mahasiswa Baru',
            'tahun'       => 2025,
        ]);

        RoomProker::create([
            'room_id'     => 1,
            'user_id'     => 1,
            'nama_proker' => 'TIC',
            'deskripsi'   => 'Workshop dan Lomba Teknologi tingkat Nasional',
            'tahun'       => 2025,
        ]);

        RoomProker::create([
            'room_id'     => 1,
            'user_id'     => 1,
            'nama_proker' => 'COD',
            'deskripsi'   => 'Pengembangan karakter pengurus HIMATIF',
            'tahun'       => 2025,
        ]);
    }
}
