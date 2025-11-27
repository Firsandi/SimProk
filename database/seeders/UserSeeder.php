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
            'username' => 'admin bendahara',
            'email' => 'adminbend@fasilkom.unej.ac.id',
            'password' => Hash::make('minbend123'),
            'role' => 'admin',
            'is_active' => true,
        ]);
        User::create([
            'name' => 'User Biasa',
            'username' => 'user biasa',
            'email' => 'firsandi@fasilkom.unej.ac.id',
            'password' => Hash::make('userbiasa123'),
            'role' => 'user',
            'is_active' => true,
        ]);
        User::create([
            'name' => 'Sekretaris',
            'username' => 'sekretaris',
            'email' => 'sekretaris@fasilkom.unej.ac.id',
            'password' => Hash::make('sekretaris123'),
            'role' => 'sekretaris',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Bendahara',
            'username' => 'bendahara',
            'email' => 'bendahara@fasilkom.unej.ac.id',
            'password' => Hash::make('bendahara123'),
            'role' => 'bendahara',
            'is_active' => true,
        ]);


    }
}
