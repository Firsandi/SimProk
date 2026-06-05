<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProkerMemberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proker_members')->insert([
            [
                'proker_id' => 1,
                'user_id' => 2,
                'role' => 'sekretaris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'proker_id' => 2,
                'user_id' => 3,
                'role' => 'bendahara',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
