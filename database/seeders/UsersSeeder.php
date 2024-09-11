<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'password' => bcrypt('password'),
            'email' => 'admin@gmail.com',
            'role_id' => 1
        ]);
        User::create([
            'name' => 'staff',
            'password' => bcrypt('password'),
            'email' => 'staff@gmail.com',
            'role_id' => 2
        ]);
        User::create([
            'name' => 'mahasiswa',
            'password' => bcrypt('password'),
            'email' => 'mahasiswa@gmail.com',
            'role_id' => 3
        ]);
    }
}
