<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\KK;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Indonesian locale

        // Ambil semua KK yang ada
        $kks = KK::all();

        if ($kks->isEmpty()) {
            $this->command->error('Tidak ada KK! Jalankan KKSeeder terlebih dahulu.');
            return;
        }

        // Data master untuk random selection
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $statusPerkawinan = ['Belum Menikah', 'Menikah', 'Janda', 'Duda'];
        $pendidikan = ['BELUM SEKOLAH', 'TK', 'SD', 'SMP', 'SMA/SMK', 'D1/D2/D3', 'S1/D4', 'S2', 'S3'];
        $golonganDarah = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $statusMerokok = ['MEROKOK', 'TIDAK MEROKOK'];
        $cekKesehatan = ['SETIAP BULAN', '3 BULAN SEKALI', '6 BULAN SEKALI', 'SETAHUN SEKALI', 'TIDAK PERNAH'];
        $asuransiKesehatan = ['BPJS KESEHATAN', 'BPJS PRIBADI', 'ASURANSI SWASTA', 'TIDAK MEMILIKI'];
        $bpjsKetenagakerjaan = ['MEMILIKI', 'TIDAK MEMILIKI'];
        $tambahAnak = ['YA', 'TIDAK'];
        $alatKontrasepsi = ['KONDOM', 'IUD/SPIRAL', 'PIL', 'SUNTIK', 'IMPLANT', 'STERIL', 'TIDAK ADA'];

        // Pekerjaan yang umum di Indonesia
        $pekerjaan = [
            'Pegawai Negeri Sipil', 'Guru', 'Dosen', 'Dokter', 'Perawat', 'Bidan',
            'Polisi', 'TNI', 'Karyawan Swasta', 'Wiraswasta', 'Pedagang',
            'Petani', 'Buruh', 'Sopir', 'Tukang', 'Montir', 'Teknisi',
            'Programmer', 'Designer', 'Marketing', 'Sales', 'Admin', 'Sekretaris',
            'Chef', 'Barista', 'Cleaning Service', 'Security', 'Ojek Online',
            'Pengusaha', 'Direktur', 'Manager', 'Supervisor', 'Staff',
            'Ibu Rumah Tangga', 'Pelajar', 'Mahasiswa', 'Pensiunan', 'Tidak Bekerja'
        ];

        $this->command->info('Membuat 1000 data penduduk...');
        $progressBar = $this->command->getOutput()->createProgressBar(1000);

        for ($i = 0; $i < 1000; $i++) {
            // Random KK
            $kk = $kks->random();

            // Generate data
            $jk = $faker->randomElement($jenisKelamin);
            $nama = $jk === 'Laki-laki' ? $faker->firstNameMale() . ' ' . $faker->lastName() : $faker->firstNameFemale() . ' ' . $faker->lastName();

            // Generate NIK yang unik
            $nik = '32' . str_pad($faker->unique()->numberBetween(1000000000000, 9999999999999), 14, '0', STR_PAD_LEFT);

            // Generate tanggal lahir (umur 1-90 tahun)
            $tanggalLahir = $faker->dateTimeBetween('-90 years', '-1 year');
            $umur = date_diff(date_create($tanggalLahir->format('Y-m-d')), date_create('today'))->y;

            // Status perkawinan berdasarkan umur
            if ($umur < 17) {
                $status = 'Belum Menikah';
            } elseif ($umur < 25) {
                $status = $faker->randomElement(['Belum Menikah', 'Menikah']);
            } else {
                $status = $faker->randomElement($statusPerkawinan);
            }

            // Sesuaikan status dengan jenis kelamin
            if ($status === 'Janda' && $jk === 'Laki-laki') {
                $status = 'Duda';
            } elseif ($status === 'Duda' && $jk === 'Perempuan') {
                $status = 'Janda';
            }

            // Pendidikan berdasarkan umur
            if ($umur < 6) {
                $pend = null;
            } elseif ($umur < 12) {
                $pend = 'SD';
            } elseif ($umur < 15) {
                $pend = $faker->randomElement(['SD', 'SMP']);
            } elseif ($umur < 18) {
                $pend = $faker->randomElement(['SMP', 'SMA/SMK']);
            } else {
                $pend = $faker->randomElement($pendidikan);
            }

            // Pekerjaan berdasarkan umur dan status
            if ($umur < 17) {
                $kerja = $faker->randomElement(['Pelajar', 'Tidak Bekerja']);
            } elseif ($umur < 25 && $pend === 'SMA/SMK') {
                $kerja = $faker->randomElement(['Mahasiswa', 'Pelajar', ...$pekerjaan]);
            } elseif ($umur > 60) {
                $kerja = $faker->randomElement(['Pensiunan', 'Tidak Bekerja', ...$pekerjaan]);
            } else {
                $kerja = $faker->randomElement($pekerjaan);
            }

            // Jumlah anak untuk yang sudah menikah
            $jumlahAnak = 0;
            $inginAnak = null;
            $kontrasepsi = null;

            if ($status === 'Menikah' && $umur >= 20) {
                $jumlahAnak = $faker->numberBetween(0, 5);
                $inginAnak = $faker->randomElement($tambahAnak);

                if ($jk === 'Perempuan' && $umur < 50) {
                    $kontrasepsi = $faker->randomElement($alatKontrasepsi);
                }
            }

            Resident::create([
                'kk_id' => $kk->id,
                'nik' => $nik,
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'tempat_lahir' => $faker->city(),
                'alamat' => $kk->alamat,
                'status_perkawinan' => $status,
                'agama' => $faker->randomElement($agama),
                'pendidikan' => $pend,
                'pekerjaan' => $kerja,
                'no_telepon' => $faker->boolean(70) ? '08' . $faker->numerify('##########') : null,
                'email' => $faker->boolean(50) ? $faker->unique()->safeEmail() : null,

                // Data kesehatan
                'golongan_darah' => $faker->boolean(80) ? $faker->randomElement($golonganDarah) : null,
                'status_merokok' => ($jk === 'Laki-laki' && $umur >= 17) ? $faker->randomElement($statusMerokok) : 'TIDAK MEROKOK',
                'nama_ayah' => $faker->firstNameMale() . ' ' . $faker->lastName(),
                'nama_ibu' => $faker->firstNameFemale() . ' ' . $faker->lastName(),
                'riwayat_penyakit' => $faker->boolean(20) ? $faker->randomElement([
                    'Diabetes', 'Hipertensi', 'Asma', 'Jantung', 'Maag',
                    'Kolesterol', 'Alergi', 'Tidak Ada'
                ]) : null,
                'cek_kesehatan' => $faker->randomElement($cekKesehatan),
                'asuransi_kesehatan' => $faker->randomElement($asuransiKesehatan),
                'bpjs_ketenagakerjaan' => ($kerja !== 'Tidak Bekerja' && $kerja !== 'Pelajar' && $kerja !== 'Mahasiswa')
                    ? $faker->randomElement($bpjsKetenagakerjaan)
                    : 'TIDAK MEMILIKI',
                'tambah_anak' => $inginAnak,
                'jumlah_anak' => $jumlahAnak,
                'alat_kontrasepsi' => $kontrasepsi,
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('✓ Berhasil membuat 1000 data penduduk!');
    }
}
