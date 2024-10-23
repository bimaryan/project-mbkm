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
            'nama_ruangan' => 'Decontamination Room',
        ]);
        Room::create([
            'nama_ruangan' => 'Steril Room',
        ]);
        Room::create([
            'nama_ruangan' => 'Radiologi',
        ]);
        Room::create([
            'nama_ruangan' => 'Basic Biomedical Science',
        ]);
        Room::create([
            'nama_ruangan' => 'Pediatric Nursing',
        ]);
        Room::create([
            'nama_ruangan' => 'General Nursing',
        ]);
        Room::create([
            'nama_ruangan' => 'ICU',
        ]);
        Room::create([
            'nama_ruangan' => 'VIP',
        ]);
        Room::create([
            'nama_ruangan' => 'NICU',
        ]);
        Room::create([
            'nama_ruangan' => 'Maternitas',
        ]);
        Room::create([
            'nama_ruangan' => 'PERINATOLOGI',
        ]);
        Room::create([
            'nama_ruangan' => 'Medical Surgical Nursing 2',
        ]);
        Room::create([
            'nama_ruangan' => 'Hemodialisa',
        ]);
        Room::create([
            'nama_ruangan' => 'Ruang Alat 1',
        ]);
        Room::create([
            'nama_ruangan' => 'Ruang Alat 2',
        ]);
        Room::create([
            'nama_ruangan' => 'Ruang Alat 2',
        ]);
        Room::create([
            'nama_ruangan' => 'Selasar Lab',
        ]);
        Room::create([
            'nama_ruangan' => 'Selasar KBK',
        ]);
        Room::create([
            'nama_ruangan' => 'Klinik 1',
        ]);
        Room::create([
            'nama_ruangan' => 'Klinik 2',
        ]);
        Room::create([
            'nama_ruangan' => 'KOMUNITAS',
        ]);
        Room::create([
            'nama_ruangan' => 'JIWA',
        ]);
        Room::create([
            'nama_ruangan' => 'CSSD',
        ]);
        Room::create([
            'nama_ruangan' => 'Sterilization Room',
        ]);
        Room::create([
            'nama_ruangan' => 'Tool Setting Room',
        ]);
        Room::create([
            'nama_ruangan' => 'Operation Room',
        ]);
        Room::create([
            'nama_ruangan' => 'Emergency Room',
        ]);
        Room::create([
            'nama_ruangan' => 'Nurse Station',
        ]);
    }
}
