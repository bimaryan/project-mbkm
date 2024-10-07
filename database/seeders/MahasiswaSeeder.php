<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nama' => 'Mahasiswa 1',
            'nim' => '2205042',
            'email' => 'mahasiswa1@gmail.com',
            'password' => Hash::make('mahasiswa'),
            'kelas_id' => 1,
        ]);
    }
}
