<?php

namespace Database\Seeders;

use App\Models\Kondisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kondisi::create([
            'kondisi' => 'Tersedia'
        ]);
        Kondisi::create([
            'kondisi' => 'Terpakai'
        ]);
        Kondisi::create([
            'kondisi' => 'Habis'
        ]);
        Kondisi::create([
            'kondisi' => 'Baik'
        ]);
        Kondisi::create([
            'kondisi' => 'Hilang'
        ]);
    }
}
