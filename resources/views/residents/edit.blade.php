@extends('layouts.app')

@section('title', 'Edit Penduduk')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-10">
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Edit Data Penduduk</h3>
            <p class="text-gray-600">Perbarui informasi penduduk dengan data yang akurat.</p>
        </div>

        <form method="POST" action="{{ route('residents.update', $resident) }}" class="space-y-8 m-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-blue-600">
                    <i class="fas fa-id-card text-blue-600 mr-2"></i>Identitas Dasar
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">No. Kartu Keluarga <span class="text-red-600">*</span></label>
                        <input type="text" name="no_kk" required value="{{ old('no_kk', $resident->kk->no_kk ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="16 digit No. KK">
                        <p class="text-xs text-gray-600 mt-1">Jika No. KK berubah dan belum ada, sistem akan otomatis membuat KK baru.</p>
                        @error('no_kk') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIK <span class="text-red-600">*</span></label>
                        <input type="text" name="nik" required value="{{ old('nik', $resident->nik) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="16 digit NIK">
                        @error('nik') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-600">*</span></label>
                        <input type="text" name="nama" required value="{{ old('nama', $resident->nama) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Nama lengkap sesuai KTP">
                        @error('nama') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat <span class="text-red-600">*</span></label>
                        <input type="text" name="alamat" required value="{{ old('alamat', $resident->alamat ?? $resident->kk->alamat ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Alamat lengkap">
                        @error('alamat') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">RT</label>
                        <input type="text" name="rt" value="{{ old('rt', $resident->kk->rt ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="001" maxlength="3">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">RW</label>
                        <input type="text" name="rw" value="{{ old('rw', $resident->kk->rw ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="001" maxlength="3">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kelurahan/Desa</label>
                        <input type="text" name="kelurahan" value="{{ old('kelurahan', $resident->kk->kelurahan ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Nama Kelurahan">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $resident->kk->kecamatan ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Nama Kecamatan">
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-blue-600">
                    <i class="fas fa-user text-blue-600 mr-2"></i>Data Pribadi
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-600">*</span></label>
                        <select name="jenis_kelamin" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $resident->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $resident->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Golongan Darah</label>
                        <select name="golongan_darah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition">
                            <option value="">-- Pilih Golongan Darah --</option>
                            <option value="A+" {{ old('golongan_darah', $resident->golongan_darah) == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('golongan_darah', $resident->golongan_darah) == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('golongan_darah', $resident->golongan_darah) == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('golongan_darah', $resident->golongan_darah) == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ old('golongan_darah', $resident->golongan_darah) == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('golongan_darah', $resident->golongan_darah) == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ old('golongan_darah', $resident->golongan_darah) == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('golongan_darah', $resident->golongan_darah) == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir <span class="text-red-600">*</span></label>
                        <input type="text" name="tempat_lahir" required value="{{ old('tempat_lahir', $resident->tempat_lahir) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Kota/Kabupaten">
                        @error('tempat_lahir') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir <span class="text-red-600">*</span></label>
                        <input type="date" name="tanggal_lahir" required value="{{ old('tanggal_lahir', optional($resident->tanggal_lahir)->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition">
                        @error('tanggal_lahir') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Agama <span class="text-red-600">*</span></label>
                        <select name="agama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition">
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam" {{ old('agama', $resident->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama', $resident->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama', $resident->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama', $resident->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama', $resident->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama', $resident->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Perkawinan <span class="text-red-600">*</span></label>
                        <select name="status_perkawinan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition">
                            <option value="">-- Pilih Status Kawin --</option>
                            <option value="Belum Menikah" {{ old('status_perkawinan', $resident->status_perkawinan) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ old('status_perkawinan', $resident->status_perkawinan) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Janda" {{ old('status_perkawinan', $resident->status_perkawinan) == 'Janda' ? 'selected' : '' }}>Janda</option>
                            <option value="Duda" {{ old('status_perkawinan', $resident->status_perkawinan) == 'Duda' ? 'selected' : '' }}>Duda</option>
                        </select>
                        @error('status_perkawinan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pendidikan Terakhir</label>
                        <select name="pendidikan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition">
                            <option value="">-- Pilih Pendidikan Terakhir --</option>
                            <option value="Belum Sekolah" {{ old('pendidikan', $resident->pendidikan) == 'Belum Sekolah' ? 'selected' : '' }}>Belum Sekolah</option>
                            <option value="TK" {{ old('pendidikan', $resident->pendidikan) == 'TK' ? 'selected' : '' }}>TK</option>
                            <option value="SD" {{ old('pendidikan', $resident->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('pendidikan', $resident->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA/SMK" {{ old('pendidikan', $resident->pendidikan) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D1/D2/D3" {{ old('pendidikan', $resident->pendidikan) == 'D1/D2/D3' ? 'selected' : '' }}>D1/D2/D3</option>
                            <option value="S1/D4" {{ old('pendidikan', $resident->pendidikan) == 'S1/D4' ? 'selected' : '' }}>S1/D4</option>
                            <option value="S2" {{ old('pendidikan', $resident->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('pendidikan', $resident->pendidikan) == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $resident->pekerjaan) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Profesi/Pekerjaan">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $resident->no_telepon) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Nomor telepon">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $resident->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition" placeholder="Alamat email">
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-green-600">
                    <i class="fas fa-heartbeat text-green-600 mr-2"></i>Data Kesehatan
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Merokok</label>
                        <select name="status_merokok" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition">
                            <option value="">Pilih</option>
                            <option value="MEROKOK" {{ old('status_merokok', $resident->status_merokok) == 'MEROKOK' ? 'selected' : '' }}>Merokok</option>
                            <option value="TIDAK MEROKOK" {{ old('status_merokok', $resident->status_merokok) == 'TIDAK MEROKOK' ? 'selected' : '' }}>Tidak Merokok</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cek Kesehatan</label>
                        <select name="cek_kesehatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition">
                            <option value="">-- Pilih Frekuensi Cek Kesehatan --</option>
                            <option value="SETIAP BULAN" {{ old('cek_kesehatan', $resident->cek_kesehatan) == 'SETIAP BULAN' ? 'selected' : '' }}>Setiap Bulan</option>
                            <option value="3 BULAN SEKALI" {{ old('cek_kesehatan', $resident->cek_kesehatan) == '3 BULAN SEKALI' ? 'selected' : '' }}>3 Bulan Sekali</option>
                            <option value="6 BULAN SEKALI" {{ old('cek_kesehatan', $resident->cek_kesehatan) == '6 BULAN SEKALI' ? 'selected' : '' }}>6 Bulan Sekali</option>
                            <option value="SETAHUN SEKALI" {{ old('cek_kesehatan', $resident->cek_kesehatan) == 'SETAHUN SEKALI' ? 'selected' : '' }}>Setahun Sekali</option>
                            <option value="TIDAK PERNAH" {{ old('cek_kesehatan', $resident->cek_kesehatan) == 'TIDAK PERNAH' ? 'selected' : '' }}>Tidak Pernah</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Asuransi Kesehatan</label>
                        <select name="asuransi_kesehatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition">
                            <option value="">-- Pilih Asuransi Kesehatan --</option>
                            <option value="BPJS KESEHATAN" {{ old('asuransi_kesehatan', $resident->asuransi_kesehatan) == 'BPJS KESEHATAN' ? 'selected' : '' }}>BPJS Kesehatan</option>
                            <option value="BPJS PRIBADI" {{ old('asuransi_kesehatan', $resident->asuransi_kesehatan) == 'BPJS PRIBADI' ? 'selected' : '' }}>BPJS Pribadi</option>
                            <option value="ASURANSI SWASTA" {{ old('asuransi_kesehatan', $resident->asuransi_kesehatan) == 'ASURANSI SWASTA' ? 'selected' : '' }}>Asuransi Swasta</option>
                            <option value="TIDAK MEMILIKI" {{ old('asuransi_kesehatan', $resident->asuransi_kesehatan) == 'TIDAK MEMILIKI' ? 'selected' : '' }}>Tidak Memiliki</option>
                        </select>
                    </div>
                    <div class="">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Riwayat Penyakit</label>
                        <input name="riwayat_penyakit" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition" placeholder="Jika ada, sebutkan riwayat penyakit...">{{ old('riwayat_penyakit', $resident->riwayat_penyakit) }}</input>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-purple-600">
                    <i class="fas fa-users text-purple-600 mr-2"></i>Data Keluarga & Lainnya
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ayah</label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $resident->nama_ayah) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition" placeholder="Nama ayah">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $resident->nama_ibu) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition" placeholder="Nama ibu">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">BPJS Ketenagakerjaan</label>
                        <select name="bpjs_ketenagakerjaan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition">
                            <option value="">Pilih</option>
                            <option value="MEMILIKI" {{ old('bpjs_ketenagakerjaan', $resident->bpjs_ketenagakerjaan) == 'MEMILIKI' ? 'selected' : '' }}>Memiliki</option>
                            <option value="TIDAK MEMILIKI" {{ old('bpjs_ketenagakerjaan', $resident->bpjs_ketenagakerjaan) == 'TIDAK MEMILIKI' ? 'selected' : '' }}>Tidak Memiliki</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keinginan Menambah Anak</label>
                        <select name="tambah_anak" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition">
                            <option value="">Pilih</option>
                            <option value="YA" {{ old('tambah_anak', $resident->tambah_anak) == 'YA' ? 'selected' : '' }}>Ya</option>
                            <option value="TIDAK" {{ old('tambah_anak', $resident->tambah_anak) == 'TIDAK' ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Anak</label>
                        <input type="number" name="jumlah_anak" value="{{ old('jumlah_anak', $resident->jumlah_anak) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition" placeholder="Jumlah anak">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alat Kontrasepsi</label>
                        <select name="alat_kontrasepsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition">
                            <option value="">-- Pilih alat kontrasepsi --</option>
                            <option value="KONDOM" {{ old('alat_kontrasepsi', $resident->alat_kontrasepsi) == 'KONDOM' ? 'selected' : '' }}>Kondom</option>
                            <option value="IUD/SPIRAL" {{ old('alat_kontrasepsi', $resident->alat_kontrasepsi) == 'IUD/SPIRAL' ? 'selected' : '' }}>IUD/Spiral</option>
                            <option value="PIL" {{ old('alat_kontrasepsi', $resident->alat_kontrasepsi) == 'PIL' ? 'selected' : '' }}>Pil</option>
                            <option value="SUNTIK" {{ old('alat_kontrasepsi', $resident->alat_kontrasepsi) == 'SUNTIK' ? 'selected' : '' }}>Suntik</option>
                            <option value="IMPLANT" {{ old('alat_kontrasepsi', $resident->alat_kontrasepsi) == 'IMPLANT' ? 'selected' : '' }}>Implant</option>
                            <option value="STERIL" {{ old('alat_kontrasepsi', $resident->alat_kontrasepsi) == 'STERIL' ? 'selected' : '' }}>Steril</option>
                            <option value="TIDAK ADA" {{ old('alat_kontrasepsi', $resident->alat_kontrasepsi) == 'TIDAK ADA' ? 'selected' : '' }}>Tidak Ada</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- 2. Tambahkan Input Foto KTP di sini (misalnya setelah input Nama atau di akhir bagian identitas) --}}
        <div class="mt-6 border-t border-gray-100 pt-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto KTP (Opsional)</label>
            
            <div class="flex items-start gap-6">
                {{-- Preview Foto Lama --}}
                @if($resident->foto_ktp)
                    <div class="w-32 flex-shrink-0">
                        <p class="text-xs text-gray-500 mb-1">Foto Saat Ini:</p>
                        <img src="{{ asset('storage/' . $resident->foto_ktp) }}" class="w-full rounded-lg shadow-sm border border-gray-200">
                    </div>
                @endif

                {{-- Input Upload Baru --}}
                <div class="flex-grow">
                    <input type="file" name="foto_ktp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">
                        Upload file baru untuk mengganti foto lama. Format: JPG, JPEG, PNG. Maks: 2MB.
                    </p>
                    @error('foto_ktp') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition font-semibold">
                    <i class="fas fa-save"></i>
                    Perbarui Data
                </button>
                <a href="{{ route('residents.index') }}" class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-gray-50 px-6 py-3 rounded-lg transition font-semibold">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const noKKInput = document.querySelector('input[name="no_kk"]');
    const alamatInput = document.querySelector('input[name="alamat"]');
    const rtInput = document.querySelector('input[name="rt"]');
    const rwInput = document.querySelector('input[name="rw"]');
    const kelurahanInput = document.querySelector('input[name="kelurahan"]');
    const kecamatanInput = document.querySelector('input[name="kecamatan"]');

    const originalNoKK = noKKInput.value; // Simpan No. KK asli
    let debounceTimer;

    noKKInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);

        const noKK = this.value.trim();

        // Jika kembali ke No. KK asli, enable semua field
        if (noKK === originalNoKK) {
            enableFields();
            return;
        }

        // Reset fields jika No. KK kosong
        if (noKK.length === 0) {
            enableFields();
            return;
        }

        // Tunggu 500ms sebelum melakukan request
        debounceTimer = setTimeout(() => {
            if (noKK.length >= 10) { // Minimal 10 digit untuk mulai cek
                fetchKKData(noKK);
            }
        }, 500);
    });

    function fetchKKData(noKK) {
        // Tampilkan loading indicator
        showLoading();

        fetch(`/api/kk/check/${encodeURIComponent(noKK)}`)
            .then(response => response.json())
            .then(data => {
                hideLoading();

                if (data.exists) {
                    // KK sudah ada, isi field dengan data KK
                    alamatInput.value = data.kk.alamat || '';
                    rtInput.value = data.kk.rt || '';
                    rwInput.value = data.kk.rw || '';
                    kelurahanInput.value = data.kk.kelurahan || '';
                    kecamatanInput.value = data.kk.kecamatan || '';

                    // Disable fields agar tidak bisa diubah
                    disableFields();

                    // Tampilkan notifikasi
                    showNotification('success', `KK ditemukan! Warga akan dipindahkan ke KK ${noKK} (${data.kk.jumlah_anggota} anggota)`);
                } else {
                    // KK belum ada, enable fields untuk input manual
                    enableFields();
                    showNotification('info', 'No. KK belum terdaftar. Silakan isi data KK baru.');
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                enableFields();
                showNotification('error', 'Terjadi kesalahan saat mengecek No. KK');
            });
    }

    function disableFields() {
        alamatInput.readOnly = true;
        rtInput.readOnly = true;
        rwInput.readOnly = true;
        kelurahanInput.readOnly = true;
        kecamatanInput.readOnly = true;

        [alamatInput, rtInput, rwInput, kelurahanInput, kecamatanInput].forEach(input => {
            input.classList.add('bg-gray-100', 'cursor-not-allowed');
        });
    }

    function enableFields() {
        alamatInput.readOnly = false;
        rtInput.readOnly = false;
        rwInput.readOnly = false;
        kelurahanInput.readOnly = false;
        kecamatanInput.readOnly = false;

        [alamatInput, rtInput, rwInput, kelurahanInput, kecamatanInput].forEach(input => {
            input.classList.remove('bg-gray-100', 'cursor-not-allowed');
        });

        // Hapus notifikasi jika ada
        const existingNotif = document.querySelector('.kk-notification');
        if (existingNotif) {
            existingNotif.remove();
        }
    }

    function showLoading() {
        noKKInput.classList.add('animate-pulse');
    }

    function hideLoading() {
        noKKInput.classList.remove('animate-pulse');
    }

    function showNotification(type, message) {
        // Hapus notifikasi sebelumnya jika ada
        const existingNotif = document.querySelector('.kk-notification');
        if (existingNotif) {
            existingNotif.remove();
        }

        const colors = {
            success: 'bg-green-50 border-green-200 text-green-800',
            info: 'bg-blue-50 border-blue-200 text-blue-800',
            error: 'bg-red-50 border-red-200 text-red-800'
        };

        const icons = {
            success: '✓',
            info: 'ℹ',
            error: '⚠'
        };

        const notif = document.createElement('div');
        notif.className = `kk-notification ${colors[type]} border-2 rounded-lg p-3 mt-2 flex items-center gap-2 text-sm font-semibold`;
        notif.innerHTML = `
            <span class="text-lg">${icons[type]}</span>
            <span>${message}</span>
        `;

        // Insert setelah input No. KK
        noKKInput.parentElement.appendChild(notif);

        // Auto remove setelah 5 detik
        setTimeout(() => {
            notif.remove();
        }, 5000);
    }
});
</script>
@endpush
@endsection
