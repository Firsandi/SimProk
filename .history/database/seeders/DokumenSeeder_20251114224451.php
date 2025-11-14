<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dokumen')->insert([
            [
                'id_proker_pengguna' => 1,
                'jenis_dokumen' => 'proposal',
                'nama_dokumen' => 'Proposal Seminar Teknologi',
                'catatan' => 'Butuh revisi anggaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_proker_pengguna' => 2,
                'jenis_dokumen' => 'lpj',
                'nama_dokumen' => 'Laporan Pertanggungjawaban Lomba Coding',
                'catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
