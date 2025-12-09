@extends('layouts.app')

@section('title', 'Input Warga')

@section('content')
<div class="max-w-6xl mx-auto bg-blue-50 rounded-2xl shadow-xl p-10 ring-4 ring-sky-800">

    <!-- Heading -->
    <div class="text-center mb-10">
        <h3 class="text-4xl font-extrabold text-slate-800 tracking-wide">
            Form Input Data Warga
        </h3>
    </div>

    <form method="POST" action="{{ route('residents.store') }}" class="space-y-8">
        @csrf

        @php
        $inputClass = "w-full px-4 py-3 rounded-xl border border-gray-200 bg-sky-100 ring-sky-800 ring-2
        focus:bg-white focus:ring-2 focus:ring-sky-800 focus:outline-none transition focus:bg-sky-100";
        $labelClass = "block text-md font-bold text-gray-800 mb-2 ";
        @endphp

        <div class="grid grid-cols-2 gap-6">

            <!-- KK -->
            <div>
                <label class="{{ $labelClass }}">No. Kartu Keluarga</label>
                <input type="text" name="kk_id" required class="{{ $inputClass }}" value="{{ old('kk_id') }}">
            </div>

            <!-- NIK -->
            <div>
                <label class="{{ $labelClass }}">NIK</label>
                <input type="text" name="nik" required class="{{ $inputClass }}" value="{{ old('nik') }}">
            </div>

            <!-- Nama -->
            <div>
                <label class="{{ $labelClass }}">Nama Lengkap</label>
                <input type="text" name="nama" required class="{{ $inputClass }}" value="{{ old('nama') }}">
            </div>

            <!-- Tempat Lahir -->
            <div>
                <label class="{{ $labelClass }}">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" required class="{{ $inputClass }}" value="{{ old('tempat_lahir') }}">
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label class="{{ $labelClass }}">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required class="{{ $inputClass }}" value="{{ old('tanggal_lahir') }}">
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label class="{{ $labelClass }}">Jenis Kelamin</label>
                <div class="flex gap-3 w-full">
                    <label class="bg-amber-100 rounded-xl border-2 border-amber-200 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-amber-200 has-[:checked]:text-black has-[:checked]:border-amber-300
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" class="hidden" checked> Laki-laki
                    </label>
                    <label class="bg-amber-100 rounded-xl border-2 border-amber-200 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-amber-200 has-[:checked]:text-black has-[:checked]:border-amber-300
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="hidden"> Perempuan
                    </label>
                </div>
            </div>

            <!-- Golongan Darah -->
            <div>
                <label class="{{ $labelClass }}">Golongan Darah</label>
                <select name="golongan_darah" class="{{ $inputClass }}">
                    <option value="">Pilih</option>
                    <option>A+</option><option>A-</option>
                    <option>B+</option><option>B-</option>
                    <option>AB+</option><option>AB-</option>
                    <option>O+</option><option>O-</option>
                </select>
            </div>

            <!-- Agama -->
            <div>
                <label class="{{ $labelClass }}">Agama</label>
                <select name="agama" required class="{{ $inputClass }}">
                    <option value="">Pilih</option>
                    <option>Islam</option><option>Kristen</option>
                    <option>Katolik</option><option>Hindu</option>
                    <option>Buddha</option><option>Konghucu</option>
                </select>
            </div>

            <!-- Pendidikan -->
            <div>
                <label class="{{ $labelClass }}">Pendidikan</label>
                <select name="pendidikan" class="{{ $inputClass }}">
                    <option value="">Pilih</option>
                    <option>SD</option><option>SMP</option>
                    <option>SMA/SMK</option><option>D1/D2/D3</option>
                    <option>S1/D4</option><option>S2</option><option>S3</option>
                </select>
            </div>

            <!-- Status Kawin -->
            <div>
                <label class="{{ $labelClass }}">Status Perkawinan</label>
                <select name="status_perkawinan" required class="{{ $inputClass }}">
                    <option value="">Pilih</option>
                    <option>Belum Menikah</option>
                    <option>Menikah</option>
                    <option>Janda</option>
                    <option>Duda</option>
                </select>
            </div>

            <!-- Pekerjaan -->
            <div>
                <label class="{{ $labelClass }}">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="{{ $inputClass }}" value="{{ old('pekerjaan') }}">
            </div>

            <!-- Telepon -->
            <div>
                <label class="{{ $labelClass }}">Nomor Telepon</label>
                <input type="text" name="no_telepon" class="{{ $inputClass }}" value="{{ old('no_telepon') }}">
            </div>

            <!-- Email -->
            <div>
                <label class="{{ $labelClass }}">Email</label>
                <input type="email" name="email" class="{{ $inputClass }}" value="{{ old('email') }}">
            </div>

            <!-- Status Merokok -->
            <div>
                <label class="{{ $labelClass }}">Status Merokok</label>
                <div class="flex gap-4 w-full">
                    <label class="bg-cyan-200 rounded-xl border-2 border-cyan-300 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-cyan-400 has-[:checked]:text-black has-[:checked]:border-cyan-500
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="status_merokok" value="MEROKOK" class="hidden"> Merokok
                    </label>
                    <label class="bg-cyan-200 rounded-xl border-2 border-cyan-300 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-cyan-400 has-[:checked]:text-black has-[:checked]:border-cyan-500
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="status_merokok" value="MEROKOK" class="hidden" checked> Tidak Merokok
                    </label>
                </div>
            </div>

            <!-- Nama Ayah -->
            <div>
                <label class="{{ $labelClass }}">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="{{ $inputClass }}" value="{{ old('nama_ayah') }}">
            </div>

            <!-- Nama Ibu -->
            <div>
                <label class="{{ $labelClass }}">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="{{ $inputClass }}" value="{{ old('nama_ibu') }}">
            </div>

            <!-- Riwayat Penyakit -->
            <div class="">
                <label class="{{ $labelClass }}">Riwayat Penyakit</label>
                <input type="text" name="riwayat_penyakit" class="{{ $inputClass }}">{{ old('riwayat_penyakit') }}</input>
            </div>

            <!-- Cek Kesehatan -->
            <div>
                <label class="{{ $labelClass }}">Cek Kesehatan</label>
                <select name="cek_kesehatan" class="{{ $inputClass }}">
                    <option value="">Pilih</option>
                    <option>SETIAP BULAN</option>
                    <option>3 BULAN SEKALI</option>
                    <option>6 BULAN SEKALI</option>
                    <option>SETAHUN SEKALI</option>
                    <option>TIDAK PERNAH</option>
                </select>
            </div>

            <!-- Asuransi -->
            <div>
                <label class="{{ $labelClass }}">Asuransi Kesehatan</label>
                <select name="asuransi_kesehatan" class="{{ $inputClass }}">
                    <option value="">Pilih</option>
                    <option>BPJS KESEHATAN</option>
                    <option>BPJS PRIBADI</option>
                    <option>ASURANSI SWASTA</option>
                    <option>TIDAK MEMILIKI</option>
                </select>
            </div>

            <!-- BPJS TK -->
            <div>
                <label class="{{ $labelClass }}">BPJS Ketenagakerjaan</label>
                <div class="flex gap-3 w-full">
                    <label class="bg-emerald-100 rounded-xl border-2 border-emerald-200 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-emerald-400 has-[:checked]:text-black has-[:checked]:border-emerald-600
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="bpjs_ketenagakerjaan" value="YA" class="hidden"> Ya
                    </label>
                    <label class="bg-emerald-100 rounded-xl border-2 border-emerald-200 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-emerald-400 has-[:checked]:text-black has-[:checked]:border-emerald-600
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="bpjs_ketenagakerjaan" value="TIDAK" class="hidden" checked> Tidak
                    </label>
                </div>
            </div>

            <!-- Tambah Anak -->
            <div>
                <label class="{{ $labelClass }}">Ingin Tambah Anak</label>
                <div class="flex gap-3 w-full">
                    <label class="bg-rose-100 rounded-xl border-2 border-rose-200 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-rose-300 has-[:checked]:text-black has-[:checked]:border-rose-400
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="tambah_anak" value="MEMILIKI" class="hidden"> Memiliki
                    </label>
                    <label class="bg-rose-100 rounded-xl border-2 border-rose-200 cursor-pointer w-1/2 transition font-bold
                                has-[:checked]:bg-rose-300 has-[:checked]:text-black has-[:checked]:border-rose-400
                                active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                        <input type="radio" name="tambah_anak" value="TIDAK MEMILIKI" class="hidden" checked> Tidak
                    </label>
                </div>
            </div>

            <!-- Jumlah Anak -->
            <div>
                <label class="{{ $labelClass }}">Jumlah Anak</label>
                <input type="number" name="jumlah_anak" class="{{ $inputClass }}" min="0" value="{{ old('jumlah_anak',0) }}">
            </div>

            <!-- Alat Kontrasepsi -->
            <div>
                <label class="{{ $labelClass }}">Alat Kontrasepsi</label>
                <select name="alat_kontrasepsi" class="{{ $inputClass }}">
                    <option value="">Pilih</option>
                    <option>KONDOM</option>
                    <option>IUD/SPIRAL</option>
                    <option>PIL</option>
                    <option>SUNTIK</option>
                    <option>IMPLANT</option>
                    <option>STERIL</option>
                    <option>TIDAK ADA</option>
                </select>
            </div>

            <!-- Alamat -->
            <div class="">
                <label class="{{ $labelClass }}">Alamat Lengkap</label>
                <textarea name="alamat" rows="1" class="{{ $inputClass }}">{{ old('alamat') }}</textarea>
            </div>

        </div>

        <!-- Submit -->
        <div class="flex justify-center pt-2 w-full">
            <button type="submit" class=" w-3/4 p-4 bg-gradient-to-r from-sky-600 to-sky-800 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition">
                Simpan Data
            </button>
        </div>

    </form>

</div>
@endsection
