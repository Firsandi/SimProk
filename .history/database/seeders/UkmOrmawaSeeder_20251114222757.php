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
                'nama_ukm_ormawa' => 'Badan Eksekutif Mahasiswa (BEM)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ukm_ormawa' => 'Himpunan Mahasiswa Informatika (HIMTI)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ukm_ormawa' => 'Unit Kegiatan Mahasiswa Seni',
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
