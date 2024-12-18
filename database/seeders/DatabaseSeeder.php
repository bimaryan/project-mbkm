<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(RuanganSeeder::class);
        $this->call(KondisiSeeder::class);
        // $this->call(JurusanSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(matkulSeeder::class);
        $this->call(DosenSeeder::class);
    }
}
