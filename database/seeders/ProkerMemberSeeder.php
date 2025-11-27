<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProkerMember;

class ProkerMemberSeeder extends Seeder
{
    public function run(): void
    {
        ProkerMember::create([
            'proker_id' => 1,
            'user_id' => 2,
            'role' => 'sekretaris',
        ]);

        ProkerMember::create([
            'proker_id' => 2,
            'user_id' => 3,
            'role' => 'bendahara',
        ]);
    }
}
