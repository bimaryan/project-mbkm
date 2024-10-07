<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = [
            [
                'nama' => 'Admin 1',
                'nip' => '12345678901',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role_id' => 1,
            ],
            [
                'nama' => 'Staff 1',
                'nip' => '1234567890111',
                'username' => 'staff',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('staff'),
                'role_id' => 2,
            ]
        ];

        foreach ($admin as $admin) {
            Admin::create($admin);
        }
    }
}
