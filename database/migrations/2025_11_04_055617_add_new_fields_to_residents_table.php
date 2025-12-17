<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Pastikan ini ada

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // STEP 1: Ubah kolom ENUM lama menjadi STRING sementara.
        Schema::table('residents', function (Blueprint $table) {
            $table->string('status_perkawinan', 50)->nullable()->change();
            $table->string('pendidikan', 50)->nullable()->change();
        });

        // STEP 2: Update data 'status_perkawinan' yang lama
        DB::table('residents')
            ->where('status_perkawinan', 'Belum Kawin')
            ->update(['status_perkawinan' => 'Belum Menikah']);

        DB::table('residents')
            ->where('status_perkawinan', 'Kawin')
            ->update(['status_perkawinan' => 'Menikah']);

        DB::table('residents')
            ->whereIn('status_perkawinan', ['Cerai Hidup', 'Cerai Mati'])
            ->where('jenis_kelamin', 'Perempuan')
            ->update(['status_perkawinan' => 'Janda']);

        DB::table('residents')
            ->whereIn('status_perkawinan', ['Cerai Hidup', 'Cerai Mati'])
            ->where('jenis_kelamin', 'Laki-laki')
            ->update(['status_perkawinan' => 'Duda']);

        // =================================================================
        // STEP 3: [FIX] Update data 'pendidikan' yang lama
        // =================================================================
        // (Tambahkan pemetaan lain di sini jika Anda punya data lama lainnya)
        DB::table('residents')->where('pendidikan', 'SMA')->update(['pendidikan' => 'SMA/SMK']);
        DB::table('residents')->where('pendidikan', 'SMK')->update(['pendidikan' => 'SMA/SMK']);
        DB::table('residents')->where('pendidikan', 'S1')->update(['pendidikan' => 'S1/D4']);
        DB::table('residents')->where('pendidikan', 'D4')->update(['pendidikan' => 'S1/D4']);
        DB::table('residents')->where('pendidikan', 'D3')->update(['pendidikan' => 'D1/D2/D3']);
        DB::table('residents')->where('pendidikan', 'D2')->update(['pendidikan' => 'D1/D2/D3']);
        DB::table('residents')->where('pendidikan', 'D1')->update(['pendidikan' => 'D1/D2/D3']);

        // PENTING: Set data lain yang TIDAK DIKENALI ke NULL
        $newList = ['Belum Sekolah','TK','SD', 'SMP', 'SMA/SMK', 'D1/D2/D3', 'S1/D4', 'S2', 'S3', null];
        DB::table('residents')
            ->whereNotIn('pendidikan', $newList)
            ->update(['pendidikan' => null]);
        // =================================================================

        // STEP 4: Ubah kolom STRING (yang datanya sudah bersih) menjadi ENUM baru
        // dan tambahkan semua kolom baru lainnya.
        Schema::table('residents', function (Blueprint $table) {

            // Mengubah kolom yang sudah dikonversi
            $table->enum('status_perkawinan', [
                'Belum Menikah', 'Menikah', 'Janda', 'Duda'
            ])->nullable()->change();

            $table->enum('pendidikan', [
               'Belum Sekolah','TK', 'SD', 'SMP', 'SMA/SMK', 'D1/D2/D3', 'S1/D4', 'S2', 'S3'
            ])->nullable()->change();

            // Menambahkan kolom baru
            $table->enum('golongan_darah', [
                'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'
            ])->nullable()->after('email');

            $table->enum('status_merokok', ['MEROKOK', 'TIDAK MEROKOK'])->nullable()->after('golongan_darah');
            $table->string('nama_ayah')->nullable()->after('status_merokok');
            $table->string('nama_ibu')->nullable()->after('nama_ayah');
            $table->text('riwayat_penyakit')->nullable()->after('nama_ibu');

            $table->enum('cek_kesehatan', [
                'SETIAP BULAN', '3 BULAN SEKALI', '6 BULAN SEKALI', 'SETAHUN SEKALI', 'TIDAK PERNAH'
            ])->nullable()->after('riwayat_penyakit');

            $table->enum('asuransi_kesehatan', [
                'BPJS KESEHATAN', 'BPJS PRIBADI', 'ASURANSI SWASTA', 'TIDAK MEMILIKI'
            ])->nullable()->after('cek_kesehatan');

            $table->enum('bpjs_ketenagakerjaan', ['MEMILIKI', 'TIDAK MEMILIKI'])->nullable()->after('asuransi_kesehatan');
            $table->enum('tambah_anak', ['YA', 'TIDAK'])->nullable()->after('bpjs_ketenagakerjaan');
            $table->integer('jumlah_anak')->nullable()->default(0)->after('tambah_anak');

            $table->enum('alat_kontrasepsi', [
                'KONDOM', 'IUD/SPIRAL', 'PIL', 'SUNTIK', 'IMPLANT', 'STERIL', 'TIDAK ADA'
            ])->nullable()->after('jumlah_anak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ... (logika rollback)
    }
};
