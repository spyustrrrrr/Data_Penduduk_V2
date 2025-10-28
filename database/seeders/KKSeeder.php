<?php

namespace Database\Seeders;

use App\Models\KK;
use Illuminate\Database\Seeder;

class KKSeeder extends Seeder
{
    public function run(): void
    {
        $kks = [
            [
                'no_kk' => '3201010101010001',
                'alamat' => 'Jl. Merdeka No. 123',
                'rt' => '01',
                'rw' => '02',
                'kelurahan' => 'Kelurahan A',
                'kecamatan' => 'Kecamatan A',
            ],
            [
                'no_kk' => '3201010101010002',
                'alamat' => 'Jl. Sudirman No. 456',
                'rt' => '02',
                'rw' => '03',
                'kelurahan' => 'Kelurahan B',
                'kecamatan' => 'Kecamatan B',
            ],
        ];

        foreach ($kks as $kk) {
            KK::firstOrCreate(['no_kk' => $kk['no_kk']], $kk);
        }
    }
}
