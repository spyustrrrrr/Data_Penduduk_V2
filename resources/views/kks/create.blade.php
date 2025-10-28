@extends('layouts.app')

@section('title', 'Tambah Kartu Keluarga')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Tambah Kartu Keluarga</h2>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form method="POST" action="{{ route('kks.store') }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-2">No. Kartu Keluarga</label>
                <input type="text" name="no_kk" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Alamat</label>
                <input type="text" name="alamat" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">RT</label>
                <input type="text" name="rt" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">RW</label>
                <input type="text" name="rw" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Kelurahan</label>
                <input type="text" name="kelurahan" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">Kecamatan</label>
                <input type="text" name="kecamatan" required class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('kks.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
        </div>
    </form>
</div>
@endsection
