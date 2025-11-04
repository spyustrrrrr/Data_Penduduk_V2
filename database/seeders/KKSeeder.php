<?php

namespace Database\Seeders;

use App\Models\KK;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KKSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $this->command->info('Membuat 200 data Kartu Keluarga...');
        $progressBar = $this->command->getOutput()->createProgressBar(200);

        // Data kelurahan dan kecamatan yang umum
        $kelurahan = [
            'Kedungasem', 'Pasinan', 'Bugel', 'Karangdoro', 'Karangrejo',
            'Tegaldlimo', 'Purwoasri', 'Wonosari', 'Sumberrejo', 'Tamanan',
            'Klampis', 'Sumberwringin', 'Grogol', 'Mangir', 'Sukorejo'
        ];
        
        $kecamatan = [
            'Kedungasem', 'Pasinan', 'Bugel', 'Wonosari', 'Purwoasri'
        ];

        $namaJalan = [
            'Jl. Merdeka', 'Jl. Sudirman', 'Jl. Ahmad Yani', 'Jl. Diponegoro',
            'Jl. Gajah Mada', 'Jl. Hayam Wuruk', 'Jl. Veteran', 'Jl. Pahlawan',
            'Jl. Kartini', 'Jl. Gatot Subroto', 'Jl. Soekarno Hatta', 
            'Jl. Raya Kedungasem', 'Jl. Raya Pasinan', 'Jl. Mastrip',
            'Jl. Basuki Rahmat', 'Jl. Cut Nyak Dien', 'Jl. Imam Bonjol'
        ];

        for ($i = 1; $i <= 200; $i++) {
            // Generate No KK yang unik
            $noKK = '3211' . str_pad($faker->unique()->numberBetween(1000000000, 9999999999), 12, '0', STR_PAD_LEFT);
            
            // Random RT/RW
            $rt = str_pad($faker->numberBetween(1, 15), 2, '0', STR_PAD_LEFT);
            $rw = str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT);
            
            // Random alamat
            $jalan = $faker->randomElement($namaJalan);
            $nomor = $faker->numberBetween(1, 200);
            $alamat = $jalan . ' No. ' . $nomor;

            KK::create([
                'no_kk' => $noKK,
                'alamat' => $alamat,
                'rt' => $rt,
                'rw' => $rw,
                'kelurahan' => $faker->randomElement($kelurahan),
                'kecamatan' => $faker->randomElement($kecamatan),
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('✓ Berhasil membuat 200 data Kartu Keluarga!');
    }
}