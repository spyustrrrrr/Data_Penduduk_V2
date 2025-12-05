@extends('layouts.app')

@section('title', 'Detail Penduduk: ' . $resident->nama)

@section('content')
<div class="max-w-4xl">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Detail Penduduk</h2>
            <p class="text-lg text-gray-600">{{ $resident->nama }}</p>
        </div>
        <a href="{{ route('residents.index') }}" class="inline-flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-900 px-5 py-2 rounded-lg transition font-semibold">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 space-y-8">

        <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-blue-600">
                <i class="fas fa-id-card text-blue-600 mr-2"></i>Identitas Dasar
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div class="md:col-span-2">
                    <dt class="text-sm font-semibold text-gray-600">Nama Lengkap</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->nama }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">NIK</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->nik }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">No. Kartu Keluarga</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->kk->no_kk }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-semibold text-gray-600">Alamat</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->alamat }}</dd>
                </div>
            </div>
        </div>

        <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-blue-600">
                <i class="fas fa-user text-blue-600 mr-2"></i>Data Pribadi
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Tempat Lahir</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->tempat_lahir }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Tanggal Lahir</dt>
                    <dd class="text-lg text-gray-900">{{ optional($resident->tanggal_lahir)->format('d M Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Jenis Kelamin</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->jenis_kelamin }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Usia</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->usia }} Tahun</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Agama</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->agama }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Status Perkawinan</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->status_perkawinan }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Pendidikan Terakhir</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->pendidikan ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Pekerjaan</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->pekerjaan ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">No. Telepon</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->no_telepon ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Email</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->email ?? '-' }}</dd>
                </div>
            </div>
        </div>

        <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-green-600">
                <i class="fas fa-heartbeat text-green-600 mr-2"></i>Data Kesehatan
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Golongan Darah</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->golongan_darah ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Status Merokok</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->status_merokok ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Cek Kesehatan</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->cek_kesehatan ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Asuransi Kesehatan</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->asuransi_kesehatan ?? '-' }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-semibold text-gray-600">Riwayat Penyakit</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->riwayat_penyakit ?? '-' }}</dd>
                </div>
            </div>
        </div>

        <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b-2 border-purple-600">
                <i class="fas fa-users text-purple-600 mr-2"></i>Data Keluarga & Lainnya
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Nama Ayah</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->nama_ayah ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Nama Ibu</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->nama_ibu ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">BPJS Ketenagakerjaan</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->bpjs_ketenagakerjaan ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Keinginan Menambah Anak</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->tambah_anak ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Jumlah Anak</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->jumlah_anak ?? '0' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-600">Alat Kontrasepsi</dt>
                    <dd class="text-lg text-gray-900">{{ $resident->alat_kontrasepsi ?? '-' }}</dd>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
