@extends('layouts.app')

@section('title', 'Input Warga')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-xl p-8">
    <div class="mb-8 text-center">
        <h3 class="text-3xl font-bold text-gray-900">INPUT WARGA DIBAWAH INI</h3>
    </div>

    <form method="POST" action="{{ route('residents.store') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- NO. KARTU KELUARGA -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">NO. KARTU KELUARGA</label>
                <input type="text" name="kk_id" required value="{{ old('kk_id') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini">
            </div>

            <!-- NOMOR INDUK KEPENDUDUKAN -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">NOMOR INDUK KEPENDUDUKAN</label>
                <input type="text" name="nik" required value="{{ old('nik') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini">
            </div>

            <!-- NAMA -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">NAMA</label>
                <input type="text" name="nama" required value="{{ old('nama') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini">
            </div>

            <!-- TEMPAT LAHIR -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">TEMPAT LAHIR</label>
                <input type="text" name="tempat_lahir" required value="{{ old('tempat_lahir') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini">
            </div>

            <!-- TANGGAL LAHIR -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">TANGGAL LAHIR</label>
                <input type="date" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <!-- JENIS KELAMIN -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">JENIS KELAMIN</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer bg-blue-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} class="w-4 h-4">
                        <span class="font-semibold">LAKI-LAKI ♂</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer bg-pink-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} class="w-4 h-4">
                        <span class="font-semibold">PEREMPUAN ♀</span>
                    </label>
                </div>
            </div>

            <!-- GOLONGAN DARAH -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">GOLONGAN DARAH</label>
                <select name="golongan_darah" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Golongan Darah --</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>

            <!-- AGAMA -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">AGAMA</label>
                <select name="agama" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Agama --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>

            <!-- PENDIDIKAN TERAKHIR -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">PENDIDIKAN TERAKHIR</label>
                <select name="pendidikan" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA/SMK">SMA/SMK</option>
                    <option value="D1/D2/D3">D1/D2/D3</option>
                    <option value="S1/D4">S1/D4</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

            <!-- PEKERJAAN -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">PEKERJAAN</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini">
            </div>

            <!-- STATUS MEROKOK -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">STATUS MEROKOK</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="status_merokok" value="MEROKOK" class="w-4 h-4">
                        <span class="font-semibold">MEROKOK</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="status_merokok" value="TIDAK MEROKOK" checked class="w-4 h-4">
                        <span class="font-semibold">TIDAK ✓</span>
                    </label>
                </div>
            </div>

            <!-- NAMA AYAH -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">NAMA AYAH</label>
                <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini">
            </div>

            <!-- NAMA IBU -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">NAMA IBU</label>
                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini atau -- jika tidak ada">
            </div>

            <!-- RIWAYAT PENYAKIT -->
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-900 mb-2">RIWAYAT PENYAKIT</label>
                <textarea name="riwayat_penyakit" rows="3" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini atau -- jika tidak ada">{{ old('riwayat_penyakit') }}</textarea>
            </div>

            <!-- CEK KESEHATAN -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">CEK KESEHATAN</label>
                <select name="cek_kesehatan" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Frekuensi Cek Kesehatan --</option>
                    <option value="SETIAP BULAN">Setiap Bulan</option>
                    <option value="3 BULAN SEKALI">3 Bulan Sekali</option>
                    <option value="6 BULAN SEKALI">6 Bulan Sekali</option>
                    <option value="SETAHUN SEKALI">Setahun Sekali</option>
                    <option value="TIDAK PERNAH">Tidak Pernah</option>
                </select>
            </div>

            <!-- ASURANSI KESEHATAN -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">ASURANSI KESEHATAN</label>
                <select name="asuransi_kesehatan" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Asuransi Kesehatan --</option>
                    <option value="BPJS KESEHATAN">BPJS Kesehatan</option>
                    <option value="BPJS PRIBADI">BPJS Pribadi</option>
                    <option value="ASURANSI SWASTA">Asuransi Swasta</option>
                    <option value="TIDAK MEMILIKI">Tidak Memiliki</option>
                </select>
            </div>

            <!-- BPJS KETENAGAKERJAAN -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">BPJS KETENAGAKERJAAN</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="bpjs_ketenagakerjaan" value="MEMILIKI" class="w-4 h-4">
                        <span class="font-semibold">MEMILIKI</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="bpjs_ketenagakerjaan" value="TIDAK MEMILIKI" class="w-4 h-4">
                        <span class="font-semibold">TIDAK ✓</span>
                    </label>
                </div>
            </div>

            <!-- KEINGINAN MENAMBAH ANAK -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">KEINGINAN MENAMBAH ANAK</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="tambah_anak" value="YA" class="w-4 h-4">
                        <span class="font-semibold">YA</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-100 px-6 py-3 rounded-lg">
                        <input type="radio" name="tambah_anak" value="TIDAK" class="w-4 h-4">
                        <span class="font-semibold">TIDAK ✓</span>
                    </label>
                </div>
            </div>

            <!-- JUMLAH ANAK -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">JUMLAH ANAK</label>
                <input type="number" name="jumlah_anak" value="{{ old('jumlah_anak', 0) }}" min="0" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <!-- ALAT KONTRASEPSI -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">ALAT KONTRASEPSI</label>
                <select name="alat_kontrasepsi" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih alat kontrasepsi --</option>
                    <option value="KONDOM">Kondom</option>
                    <option value="IUD/SPIRAL">IUD/Spiral</option>
                    <option value="PIL">Pil</option>
                    <option value="SUNTIK">Suntik</option>
                    <option value="IMPLANT">Implant</option>
                    <option value="STERIL">Steril</option>
                    <option value="TIDAK ADA">Tidak Ada</option>
                </select>
            </div>

            <!-- ALAMAT -->
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-900 mb-2">ALAMAT</label>
                <input type="text" name="alamat" required value="{{ old('alamat') }}" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="ketik disini">
            </div>

            <!-- STATUS KAWIN -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">STATUS KAWIN</label>
                <select name="status_perkawinan" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Status Kawin --</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Janda">Janda</option>
                    <option value="Duda">Duda</option>
                </select>
            </div>

            <!-- USIA (TAHUN) -->
            <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">USIA (TAHUN)</label>
                <input type="number" name="usia" value="{{ old('usia', 0) }}" min="0" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 bg-gray-50" 
                    readonly>
                <p class="text-xs text-gray-500 mt-1">USIA 0 TAHUN</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center pt-6">
            <button type="submit" class="bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-bold px-12 py-4 rounded-xl transition transform hover:scale-105 shadow-lg">
                SIMPAN
            </button>
        </div>
    </form>
</div>
@endsection