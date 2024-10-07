<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            ['kelas' => 'D3 KP 1A'],
            ['kelas' => 'D3 KP 1B'],
            ['kelas' => 'D3 KP 1C'],
        ];

        foreach ($kelas as $kelas) {
            Kelas::create($kelas);
        }
    }
}