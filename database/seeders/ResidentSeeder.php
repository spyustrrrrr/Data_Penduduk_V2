<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\KK;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        $kk1 = KK::where('no_kk', '3201010101010001')->first();
        $kk2 = KK::where('no_kk', '3201010101010002')->first();

        $residents = [
            [
                'kk_id' => $kk1->id,
                'no_kk' => '3201010101010001',
                'nik' => '3201010101010001',
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1980-01-15',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan' => 'Pegawai Negeri Sipil',
                'alamat' => 'Jl. Merdeka No. 123',
                'rt' => '01',
                'rw' => '02',
                'kelurahan' => 'Kelurahan A',
                'kecamatan' => 'Kecamatan A',
            ],
            [
                'kk_id' => $kk1->id,
                'no_kk' => '3201010101010001',
                'nik' => '3201010101010002',
                'nama' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1985-05-20',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan' => 'Guru',
                'alamat' => 'Jl. Merdeka No. 123',
                'rt' => '01',
                'rw' => '02',
                'kelurahan' => 'Kelurahan A',
                'kecamatan' => 'Kecamatan A',
            ],
            [
                'kk_id' => $kk2->id,
                'no_kk' => '3201010101010002',
                'nik' => '3201010101010003',
                'nama' => 'Ahmad Wijaya',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1990-03-10',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'pekerjaan' => 'Karyawan Swasta',
                'alamat' => 'Jl. Sudirman No. 456',
                'rt' => '02',
                'rw' => '03',
                'kelurahan' => 'Kelurahan B',
                'kecamatan' => 'Kecamatan B',
            ],
        ];

        foreach ($residents as $resident) {
            Resident::create($resident);
        }
    }
}
