<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Memulai Database Seeding...');
        $this->command->newLine();

        // 1. User seeder (admin, petugas)
        $this->command->info('📝 Step 1: Membuat user...');
        $this->call(UserSeeder::class);
        $this->command->newLine();

        // 2. KK seeder (200 Kartu Keluarga)
        $this->command->info('📝 Step 2: Membuat Kartu Keluarga...');
        $this->call(KKSeeder::class);
        $this->command->newLine();

        // 3. Resident seeder (1000 Penduduk)
        $this->command->info('📝 Step 3: Membuat data penduduk...');
        $this->call(ResidentSeeder::class);
        $this->command->newLine();

        $this->command->info('✅ Seeding selesai!');
        $this->command->info('📊 Total: 2 users, 200 KK, 1000 penduduk');
    }
}