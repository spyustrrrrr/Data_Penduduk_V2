@extends('layouts.app')

@section('title', 'Kartu Keluarga')

@section('content')
<!-- Modern KK list with improved styling and better layout -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h3 class="text-gray-600 text-sm font-medium mb-1">Manajemen Kartu Keluarga</h3>
        <p class="text-gray-500 text-sm">Total: <span class="font-semibold text-gray-900">{{ $kks->total() }}</span> kartu keluarga</p>
    </div>
    <a href="{{ route('kks.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition font-medium">
        <i class="fas fa-plus"></i>
        Tambah KK
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">No. KK</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Alamat</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">RT/RW</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Kelurahan</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Kecamatan</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Anggota</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($kks as $kk)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $kk->no_kk }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $kk->alamat }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $kk->rt }}/{{ $kk->rw }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $kk->kelurahan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $kk->kecamatan }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-800 rounded-full font-semibold text-xs">
                                {{ $kk->residents_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex gap-2">
                                <a href="{{ route('kks.edit', $kk) }}" class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('kks.destroy', $kk) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus KK ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fas fa-inbox text-4xl text-gray-300"></i>
                                <p class="text-gray-500 font-medium">Tidak ada data kartu keluarga</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $kks->links() }}
</div>
@endsection
