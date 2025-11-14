<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'nama_pengguna' => 'Najwa Dzakirah Fadiyah',
                'kata_sandi' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pengguna' => 'Rizky',
                'kata_sandi' => bcrypt('password456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
