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
            'name' => 'Admin Bendahara',
            'username' => 'admin1',
            'email' => 'admin1@fasilkom.unej.ac.id',
            'password' => Hash::make('admin1'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Sekretaris BEM',
            'username' => 'sekretaris1',
            'email' => 'sekretaris1@fasilkom.unej.ac.id',
            'password' => Hash::make('password'),
            'role' => 'sekretaris',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Bendahara BEM',
            'username' => 'bendahara1',
            'email' => 'bendahara1@fasilkom.unej.ac.id',
            'password' => Hash::make('password'),
            'role' => 'bendahara',
            'is_active' => true,
        ]);
    }
}
