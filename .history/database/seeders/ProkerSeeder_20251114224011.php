<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProkerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proker')->insert([
            [
                'nama_proker' => 'Pembinaan dan Pengembangan Mahasiswa Baru (PPMB)',
                'tahun' => 2025,
                'deskripsi' => 'Pengenalan mengenai FASILKOM kepada Mahasiswa Baru',
                'id_ukm_ormawa' => 3, // relasi ke BEM
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_proker' => 'Technology Innovative Challenge (TIC)',
                'tahun' => 2025,
                'deskripsi' => 'Workshop dan Lomba Teknologi tingkat Nasional',
                'id_ukm_ormawa' => 3, // relasi ke BEM
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_proker' => 'Character Organization Development (COD)',
                'tahun' => 2025,
                'deskripsi' => 'Pengembangan karakter pengurus HIMATIF',
                'id_ukm_ormawa' => 3, // relasi ke HIMTI
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
