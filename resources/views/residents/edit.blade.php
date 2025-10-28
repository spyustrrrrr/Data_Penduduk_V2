@extends('layouts.app')

@section('title', 'Edit Penduduk')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Edit Penduduk</h2>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form method="POST" action="{{ route('residents.update', $resident) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-2">Kartu Keluarga</label>
                <select name="kk_id" required class="w-full border rounded px-3 py-2">
                    @foreach ($kks as $kk)
                        <option value="{{ $kk->id }}" {{ $resident->kk_id == $kk->id ? 'selected' : '' }}>
                            {{ $kk->no_kk }} - {{ $kk->alamat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">NIK</label>
                <input type="text" name="nik" value="{{ $resident->nik }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Nama</label>
                <input type="text" name="nama" value="{{ $resident->nama }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" required class="w-full border rounded px-3 py-2">
                    <option value="Laki-laki" {{ $resident->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $resident->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ $resident->tanggal_lahir->format('Y-m-d') }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ $resident->tempat_lahir }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Status Perkawinan</label>
                <select name="status_perkawinan" required class="w-full border rounded px-3 py-2">
                    <option value="Belum Kawin" {{ $resident->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ $resident->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ $resident->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ $resident->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">Agama</label>
                <select name="agama" required class="w-full border rounded px-3 py-2">
                    <option value="Islam" {{ $resident->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $resident->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ $resident->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ $resident->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ $resident->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ $resident->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ $resident->pekerjaan }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Pendidikan</label>
                <input type="text" name="pendidikan" value="{{ $resident->pendidikan }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">No. Telepon</label>
                <input type="text" name="no_telepon" value="{{ $resident->no_telepon }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ $resident->email }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('residents.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
        </div>
    </form>
</div>
@endsection
