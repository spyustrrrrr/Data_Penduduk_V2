@extends('layouts.app')

@section('title', 'Input Warga')

@section('content')


<div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl p-10 ring-4 ring-sky-800">
    <!-- Heading -->
    <div class="text-center mb-10">
        <h3 class="text-4xl font-extrabold text-slate-800 tracking-wide">
            Form Input Data Warga
        </h3>
    </div>

    <form <form method="POST" action="{{ route('residents.store') }}" class="space-y-8" enctype="multipart/form-data">
        @csrf

        @php
        $inputClass = "w-full px-4 py-3 rounded-xl border border-gray-200 bg-sky-100 ring-sky-800 ring-2
        focus:bg-white focus:ring-2 focus:ring-sky-800 focus:outline-none transition focus:bg-sky-100";
        $labelClass = "block text-md font-bold text-gray-800 mb-2 ";
        @endphp

        <div class="grid gap-6">

            <!-- KK Section -->
                <h4 class="text-lg font-bold text-sky-800 mb-4 border-b-2 border-sky-800 pb-2">
                    <i class="fas fa-id-card mr-2"></i>Data Kartu Keluarga
                </h4>
                <div class="grid grid-cols-2 gap-4">
                    <!-- No. KK -->
                    <div>
                        <label class="{{ $labelClass }}">No. Kartu Keluarga *</label>
                        <input type="text" name="no_kk" required class="{{ $inputClass }}" value="{{ old('no_kk') }}" placeholder="16 digit No. KK">
                        <p class="text-xs text-gray-600 mt-1">Jika No. KK sudah ada, data warga akan masuk ke KK tersebut. Jika belum ada, sistem akan otomatis membuat KK baru.</p>
                    </div>

                    <!-- Alamat KK -->
                    <div>
                        <label class="{{ $labelClass }}">Alamat Lengkap *</label>
                        <input type="text" name="alamat" required class="{{ $inputClass }}" value="{{ old('alamat') }}" placeholder="Jl. Contoh No. 123">
                    </div>

                    <!-- RT -->
                    <div>
                        <label class="{{ $labelClass }}">RT</label>
                        <input type="text" name="rt" class="{{ $inputClass }}" value="{{ old('rt') }}" placeholder="001" maxlength="3">
                    </div>

                    <!-- RW -->
                    <div>
                        <label class="{{ $labelClass }}">RW</label>
                        <input type="text" name="rw" class="{{ $inputClass }}" value="{{ old('rw') }}" placeholder="001" maxlength="3">
                    </div>

                    <!-- Kelurahan -->
                    <div>
                        <label class="{{ $labelClass }}">Kelurahan/Desa</label>
                        <input type="text" name="kelurahan" class="{{ $inputClass }}" value="{{ old('kelurahan') }}" placeholder="Nama Kelurahan">
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label class="{{ $labelClass }}">Kecamatan</label>
                        <input type="text" name="kecamatan" class="{{ $inputClass }}" value="{{ old('kecamatan') }}" placeholder="Nama Kecamatan">
                    </div>
                </div>

            <!-- Personal Data Section -->
                <h4 class="text-lg font-bold text-sky-800 mb-4 border-b-2 border-sky-800 pb-2">
                    <i class="fas fa-user mr-2"></i>Data Pribadi
                </h4>
                <div class="grid grid-cols-2 gap-4">
                    <!-- NIK -->
                    <div>
                        <label class="{{ $labelClass }}">NIK *</label>
                        <input type="text" name="nik" required class="{{ $inputClass }}" value="{{ old('nik') }}" placeholder="16 digit NIK" maxlength="16">
                    </div>

                    <!-- Nama -->
                    <div>
                        <label class="{{ $labelClass }}">Nama Lengkap *</label>
                        <input type="text" name="nama" required class="{{ $inputClass }}" value="{{ old('nama') }}" placeholder="Nama sesuai KTP">
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label class="{{ $labelClass }}">Tempat Lahir *</label>
                        <input type="text" name="tempat_lahir" required class="{{ $inputClass }}" value="{{ old('tempat_lahir') }}" placeholder="Kota lahir">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="{{ $labelClass }}">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" required class="{{ $inputClass }}" value="{{ old('tanggal_lahir') }}">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="">
                        <label class="{{ $labelClass }}">Jenis Kelamin *</label>
                        <div class="flex gap-3 w-full">
                            <label class="bg-amber-100 rounded-xl border-2 border-amber-200 cursor-pointer w-1/2 transition font-bold
                                        has-[:checked]:bg-amber-200 has-[:checked]:text-black has-[:checked]:border-amber-300
                                        active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" class="hidden" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} checked> Laki-laki
                            </label>
                            <label class="bg-amber-100 rounded-xl border-2 border-amber-200 cursor-pointer w-1/2 transition font-bold
                                        has-[:checked]:bg-amber-200 has-[:checked]:text-black has-[:checked]:border-amber-300
                                        active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" class="hidden" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}> Perempuan
                            </label>
                        </div>
                    </div>

                    <!-- Golongan Darah -->
                    <div>
                        <label class="{{ $labelClass }}">Golongan Darah</label>
                        <select name="golongan_darah" class="{{ $inputClass }}">
                            <option value="">Pilih</option>
                            <option {{ old('golongan_darah') == 'A+' ? 'selected' : '' }}>A+</option>
                            <option {{ old('golongan_darah') == 'A-' ? 'selected' : '' }}>A-</option>
                            <option {{ old('golongan_darah') == 'B+' ? 'selected' : '' }}>B+</option>
                            <option {{ old('golongan_darah') == 'B-' ? 'selected' : '' }}>B-</option>
                            <option {{ old('golongan_darah') == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option {{ old('golongan_darah') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option {{ old('golongan_darah') == 'O+' ? 'selected' : '' }}>O+</option>
                            <option {{ old('golongan_darah') == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div>
                        <label class="{{ $labelClass }}">Agama *</label>
                        <select name="agama" required class="{{ $inputClass }}">
                            <option value="">Pilih</option>
                            <option {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>

                    <!-- Pendidikan -->
                    <div>
                        <label class="{{ $labelClass }}">Pendidikan</label>
                        <select name="pendidikan" class="{{ $inputClass }}">
                            <option value="">Pilih</option>
                            <option {{ old('pendidikan') == 'Belum Sekolah' ? 'selected' : '' }}>Belum Sekolah</option>
                            <option {{ old('pendidikan') == 'TK' ? 'selected' : '' }}>TK</option>
                            <option {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                            <option {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option {{ old('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option {{ old('pendidikan') == 'D1/D2/D3' ? 'selected' : '' }}>D1/D2/D3</option>
                            <option {{ old('pendidikan') == 'S1/D4' ? 'selected' : '' }}>S1/D4</option>
                            <option {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>

                    <!-- Status Kawin -->
                    <div>
                        <label class="{{ $labelClass }}">Status Perkawinan *</label>
                        <select name="status_perkawinan" required class="{{ $inputClass }}">
                            <option value="">Pilih</option>
                            <option {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option {{ old('status_perkawinan') == 'Janda' ? 'selected' : '' }}>Janda</option>
                            <option {{ old('status_perkawinan') == 'Duda' ? 'selected' : '' }}>Duda</option>
                        </select>
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label class="{{ $labelClass }}">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="{{ $inputClass }}" value="{{ old('pekerjaan') }}" placeholder="Jenis pekerjaan">
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label class="{{ $labelClass }}">Nomor Telepon</label>
                        <input type="text" name="no_telepon" class="{{ $inputClass }}" value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="{{ $labelClass }}">Email</label>
                        <input type="email" name="email" class="{{ $inputClass }}" value="{{ old('email') }}" placeholder="email@contoh.com">
                    </div>
                </div>
            </div>

            <!-- Health Data Section -->
                <h4 class="text-lg font-bold text-sky-800 mb-4 border-b-2 border-sky-800 pb-2">
                    <i class="fas fa-heartbeat mr-2"></i>Data Kesehatan
                </h4>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Status Merokok -->
                    <div>
                        <label class="{{ $labelClass }}">Status Merokok</label>
                        <div class="flex gap-4 w-full">
                            <label class="bg-cyan-200 rounded-xl border-2 border-cyan-300 cursor-pointer w-1/2 transition font-bold
                                        has-[:checked]:bg-cyan-400 has-[:checked]:text-black has-[:checked]:border-cyan-500
                                        active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                                <input type="radio" name="status_merokok" value="MEROKOK" class="hidden" {{ old('status_merokok') == 'MEROKOK' ? 'checked' : '' }}> Merokok
                            </label>
                            <label class="bg-cyan-200 rounded-xl border-2 border-cyan-300 cursor-pointer w-1/2 transition font-bold
                                        has-[:checked]:bg-cyan-400 has-[:checked]:text-black has-[:checked]:border-cyan-500
                                        active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                                <input type="radio" name="status_merokok" value="TIDAK MEROKOK" class="hidden" {{ old('status_merokok', 'TIDAK MEROKOK') == 'TIDAK MEROKOK' ? 'checked' : '' }}> Tidak Merokok
                            </label>
                        </div>
                    </div>

                    <!-- Nama Ayah -->
                    <div>
                        <label class="{{ $labelClass }}">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="{{ $inputClass }}" value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah">
                    </div>

                    <!-- Nama Ibu -->
                    <div>
                        <label class="{{ $labelClass }}">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="{{ $inputClass }}" value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu">
                    </div>

                    <!-- Riwayat Penyakit -->
                    <div>
                        <label class="{{ $labelClass }}">Riwayat Penyakit</label>
                        <input type="text" name="riwayat_penyakit" class="{{ $inputClass }}" value="{{ old('riwayat_penyakit') }}" placeholder="Jika ada">
                    </div>

                    <!-- Cek Kesehatan -->
                    <div>
                        <label class="{{ $labelClass }}">Cek Kesehatan</label>
                        <select name="cek_kesehatan" class="{{ $inputClass }}">
                            <option value="">Pilih</option>
                            <option {{ old('cek_kesehatan') == 'SETIAP BULAN' ? 'selected' : '' }}>SETIAP BULAN</option>
                            <option {{ old('cek_kesehatan') == '3 BULAN SEKALI' ? 'selected' : '' }}>3 BULAN SEKALI</option>
                            <option {{ old('cek_kesehatan') == '6 BULAN SEKALI' ? 'selected' : '' }}>6 BULAN SEKALI</option>
                            <option {{ old('cek_kesehatan') == 'SETAHUN SEKALI' ? 'selected' : '' }}>SETAHUN SEKALI</option>
                            <option {{ old('cek_kesehatan') == 'TIDAK PERNAH' ? 'selected' : '' }}>TIDAK PERNAH</option>
                        </select>
                    </div>

                    <!-- Asuransi -->
                    <div>
                        <label class="{{ $labelClass }}">Asuransi Kesehatan</label>
                        <select name="asuransi_kesehatan" class="{{ $inputClass }}">
                            <option value="">Pilih</option>
                            <option {{ old('asuransi_kesehatan') == 'BPJS KESEHATAN' ? 'selected' : '' }}>BPJS KESEHATAN</option>
                            <option {{ old('asuransi_kesehatan') == 'BPJS PRIBADI' ? 'selected' : '' }}>BPJS PRIBADI</option>
                            <option {{ old('asuransi_kesehatan') == 'ASURANSI SWASTA' ? 'selected' : '' }}>ASURANSI SWASTA</option>
                            <option {{ old('asuransi_kesehatan') == 'TIDAK MEMILIKI' ? 'selected' : '' }}>TIDAK MEMILIKI</option>
                        </select>
                    </div>

                    <!-- BPJS TK -->
                    <div>
                        <label class="{{ $labelClass }}">BPJS Ketenagakerjaan</label>
                        <div class="flex gap-3 w-full">
                            <label class="bg-emerald-100 rounded-xl border-2 border-emerald-200 cursor-pointer w-1/2 transition font-bold
                                        has-[:checked]:bg-emerald-400 has-[:checked]:text-black has-[:checked]:border-emerald-600
                                        active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                                <input type="radio" name="bpjs_ketenagakerjaan" value="MEMILIKI" class="hidden" {{ old('bpjs_ketenagakerjaan') == 'MEMILIKI' ? 'checked' : '' }}> Memiliki
                            </label>
                            <label class="bg-emerald-100 rounded-xl border-2 border-emerald-200 cursor-pointer w-1/2 transition font-bold
                                        has-[:checked]:bg-emerald-400 has-[:checked]:text-black has-[:checked]:border-emerald-600
                                        active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                                <input type="radio" name="bpjs_ketenagakerjaan" value="TIDAK MEMILIKI" class="hidden" {{ old('bpjs_ketenagakerjaan', 'TIDAK MEMILIKI') == 'TIDAK MEMILIKI' ? 'checked' : '' }}> Tidak Memiliki
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
                                <input type="radio" name="tambah_anak" value="YA" class="hidden" {{ old('tambah_anak') == 'YA' ? 'checked' : '' }}> Ya
                            </label>
                            <label class="bg-rose-100 rounded-xl border-2 border-rose-200 cursor-pointer w-1/2 transition font-bold
                                        has-[:checked]:bg-rose-300 has-[:checked]:text-black has-[:checked]:border-rose-400
                                        active:scale-95 p-3 flex justify-start has-[:checked]:after:content-['✓'] has-[:checked]:after:ms-2">
                                <input type="radio" name="tambah_anak" value="TIDAK" class="hidden" {{ old('tambah_anak', 'TIDAK') == 'TIDAK' ? 'checked' : '' }}> Tidak
                            </label>
                        </div>
                    </div>

                    <!-- Jumlah Anak -->
                    <div>
                        <label class="{{ $labelClass }}">Jumlah Anak</label>
                        <input type="number" name="jumlah_anak" class="{{ $inputClass }}" min="0" value="{{ old('jumlah_anak',0) }}" placeholder="0">
                    </div>

                    <!-- Alat Kontrasepsi -->
                    <div>
                        <label class="{{ $labelClass }}">Alat Kontrasepsi</label>
                        <select name="alat_kontrasepsi" class="{{ $inputClass }}">
                            <option value="">Pilih</option>
                            <option {{ old('alat_kontrasepsi') == 'KONDOM' ? 'selected' : '' }}>KONDOM</option>
                            <option {{ old('alat_kontrasepsi') == 'IUD/SPIRAL' ? 'selected' : '' }}>IUD/SPIRAL</option>
                            <option {{ old('alat_kontrasepsi') == 'PIL' ? 'selected' : '' }}>PIL</option>
                            <option {{ old('alat_kontrasepsi') == 'SUNTIK' ? 'selected' : '' }}>SUNTIK</option>
                            <option {{ old('alat_kontrasepsi') == 'IMPLANT' ? 'selected' : '' }}>IMPLANT</option>
                            <option {{ old('alat_kontrasepsi') == 'STERIL' ? 'selected' : '' }}>STERIL</option>
                            <option {{ old('alat_kontrasepsi') == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                        </select>
                    </div>
                </div>

     <!-- Foto KTP -->
    {{-- 2. Tambahkan Input Foto KTP di sini (misalnya setelah input Nama atau di akhir bagian identitas) --}}
        <div class="mt-6 border-t border-gray-100 pt-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto KTP (Opsional)</label>
                {{-- Input Upload Baru --}}
                <div class="flex-grow">
                    <input type="file" name="foto_ktp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">
                        Upload file baru untuk mengganti foto lama. Format: JPG, JPEG, PNG. Maks: 2MB.
                    </p>
                    @error('foto_ktp') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>


        <!-- Submit -->
        <div class="flex justify-center pt-2 w-full">
            <button type="submit" class="w-3/4 p-4 bg-gradient-to-r from-sky-600 to-sky-800 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition">
                <i class="fas fa-save mr-2"></i>Simpan Data
            </button>
        </div>

       
    </form>

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

    let debounceTimer;

    noKKInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);

        const noKK = this.value.trim();

        // Reset fields jika No. KK kosong
        if (noKK.length === 0) {
            resetFields();
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
                    alamatInput.readOnly = true;
                    rtInput.readOnly = true;
                    rwInput.readOnly = true;
                    kelurahanInput.readOnly = true;
                    kecamatanInput.readOnly = true;

                    // Tambah styling untuk readonly
                    [alamatInput, rtInput, rwInput, kelurahanInput, kecamatanInput].forEach(input => {
                        input.classList.add('bg-gray-100', 'cursor-not-allowed');
                        input.classList.remove('bg-sky-100');
                    });

                    // Tampilkan notifikasi
                    showNotification('success', `KK ditemukan! Anggota baru akan ditambahkan ke KK ${noKK}`);
                } else {
                    // KK belum ada, enable fields untuk input manual
                    resetFields();
                    showNotification('info', 'No. KK belum terdaftar. Silakan isi data KK baru.');
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                resetFields();
                showNotification('error', 'Terjadi kesalahan saat mengecek No. KK');
            });
    }

    function resetFields() {
        alamatInput.value = '';
        rtInput.value = '';
        rwInput.value = '';
        kelurahanInput.value = '';
        kecamatanInput.value = '';

        // Enable fields
        alamatInput.readOnly = false;
        rtInput.readOnly = false;
        rwInput.readOnly = false;
        kelurahanInput.readOnly = false;
        kecamatanInput.readOnly = false;

        // Reset styling
        [alamatInput, rtInput, rwInput, kelurahanInput, kecamatanInput].forEach(input => {
            input.classList.remove('bg-gray-100', 'cursor-not-allowed');
            input.classList.add('bg-sky-100');
        });
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
        notif.className = `kk-notification ${colors[type]} border-2 rounded-lg p-3 mb-4 flex items-center gap-2 text-sm font-semibold`;
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
