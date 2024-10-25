<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::create([
            'nama_ruangan' => 'Decontamination Room',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Steril Room',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Radiologi',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Basic Biomedical Science',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Pediatric Nursing',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'General Nursing',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'ICU',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'VIP',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'NICU',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Maternitas',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'PERINATOLOGI',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Medical Surgical Nursing 2',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Hemodialisa',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Ruang Alat 1',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Ruang Alat 2',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Ruang Alat 2',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Selasar Lab',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Selasar KBK',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Klinik 1',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Klinik 2',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'KOMUNITAS',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'JIWA',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'CSSD',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Sterilization Room',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Tool Setting Room',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Operation Room',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Emergency Room',
        ]);
        Ruangan::create([
            'nama_ruangan' => 'Nurse Station',
        ]);
    }
}
