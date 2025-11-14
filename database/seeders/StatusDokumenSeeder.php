<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusDokumenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_dokumen')->insert([
            [
                'status_awal' => null,
                'status_baru' => 'draft',
                'komentar' => 'Masih dalam tahap awal',
                'id_dokumen' => 1,
                'id_pengguna' => 1,
                'waktu_perubahan' => now(),
            ],
            [
                'status_awal' => 'draft',
                'status_baru' => 'final',
                'komentar' => 'Sudah disetujui',
                'id_dokumen' => 2,
                'id_pengguna' => 2,
                'waktu_perubahan' => now(),
            ],
        ]);
    }
}
