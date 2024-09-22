<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'ruangan' => 'Decontamination Room',
        ]);
        Room::create([
            'ruangan' => 'Steril Room',
        ]);
        Room::create([
            'ruangan' => 'Radiologi',
        ]);
        Room::create([
            'ruangan' => 'Basic Biomedical Science',
        ]);
        Room::create([
            'ruangan' => 'Pediatric Nursing',
        ]);
        Room::create([
            'ruangan' => 'General Nursing',
        ]);
        Room::create([
            'ruangan' => 'ICU',
        ]);
        Room::create([
            'ruangan' => 'VIP',
        ]);
        Room::create([
            'ruangan' => 'NICU',
        ]);
        Room::create([
            'ruangan' => 'Maternitas',
        ]);
        Room::create([
            'ruangan' => 'PERINATOLOGI',
        ]);
        Room::create([
            'ruangan' => 'Medical Surgical Nursing 2',
        ]);
        Room::create([
            'ruangan' => 'Hemodialisa',
        ]);
        Room::create([
            'ruangan' => 'Ruang Alat 1',
        ]);
        Room::create([
            'ruangan' => 'Ruang Alat 2',
        ]);
        Room::create([
            'ruangan' => 'Ruang Alat 2',
        ]);
        Room::create([
            'ruangan' => 'Selasar Lab',
        ]);
        Room::create([
            'ruangan' => 'Selasar KBK',
        ]);
        Room::create([
            'ruangan' => 'Klinik 1',
        ]);
        Room::create([
            'ruangan' => 'Klinik 2',
        ]);
        Room::create([
            'ruangan' => 'KOMUNITAS',
        ]);
        Room::create([
            'ruangan' => 'JIWA',
        ]);
        Room::create([
            'ruangan' => 'CSSD',
        ]);
        Room::create([
            'ruangan' => 'Sterilization Room',
        ]);
        Room::create([
            'ruangan' => 'Tool Setting Room',
        ]);
        Room::create([
            'ruangan' => 'Operation Room',
        ]);
        Room::create([
            'ruangan' => 'Emergency Room',
        ]);
        Room::create([
            'ruangan' => 'Nurse Station',
        ]);
    }
}
