<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UkmOrmawaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ukm_ormawa')->insert([
            [
                'nama_ukm_ormawa' => 'BEM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ukm_ormawa' => 'HIMASIF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ukm_ormawa' => 'HIMA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ukm_ormawa' => 'Unit Kegiatan Mahasiswa Olahraga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
