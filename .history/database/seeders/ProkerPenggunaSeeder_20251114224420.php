<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProkerPenggunaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proker_pengguna')->insert([
            [
                'id_proker' => 1,
                'id_pengguna' => 1,
                'role' => 'Sekretaris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_proker' => 2,
                'id_pengguna' => 2,
                'role' => 'Bendahara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
