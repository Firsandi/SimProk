<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        public function run(): void
{
    $this->call([
        UkmOrmawaSeeder::class,
        ProkerSeeder::class,
        PenggunaSeeder::class,
        ProkerPenggunaSeeder::class,
        DokumenSeeder::class,
        StatusDokumenSeeder::class,
    ]);
}

}
