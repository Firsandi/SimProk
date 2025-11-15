<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Fasilkom',
            'username' => 'admin',
            'email' => 'admin@fasilkom.unej.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
]);

    }
}
