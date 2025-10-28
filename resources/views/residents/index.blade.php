@extends('layouts.app')

@section('title', 'Data Penduduk')

@section('content')
<!-- Modern header with action buttons and improved layout -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h3 class="text-gray-600 text-sm font-medium mb-1">Manajemen Data</h3>
        <p class="text-gray-500 text-sm">Total: <span class="font-semibold text-gray-900">{{ $residents->total() }}</span> penduduk</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('residents.export', request()->query()) }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition font-medium">
            <i class="fas fa-download"></i>
            Export Excel
        </a>
        <a href="{{ route('residents.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition font-medium">
            <i class="fas fa-plus"></i>
            Tambah Penduduk
        </a>
    </div>
</div>

<!-- Improved filter section with better styling and layout -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex items-center gap-2 mb-4">
        <i class="fas fa-filter text-blue-600"></i>
        <h3 class="font-semibold text-gray-900">Filter & Pencarian</h3>
    </div>
    
    <form method="GET" action="{{ route('residents.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                <input type="text" name="search" placeholder="Nama, NIK, atau No. KK" value="{{ request('search') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition">
                    <option value="">Semua</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
                <select name="status_perkawinan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition">
                    <option value="">Semua</option>
                    <option value="Belum Kawin" {{ request('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ request('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ request('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ request('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                <select name="agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition">
                    <option value="">Semua</option>
                    <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition font-medium flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i>
                    Filter
                </button>
                <a href="{{ route('residents.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition font-medium text-gray-700">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Modern table with improved styling and better visual hierarchy -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 sticky left-0 bg-gray-50">NIK</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Jenis Kelamin</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tanggal Lahir</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Agama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">No. KK</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 sticky right-0 bg-gray-50">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($residents as $resident)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 sticky left-0 bg-white hover:bg-blue-50">{{ $resident->nik }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $resident->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <span class="inline-flex items-center gap-2">
                                @if ($resident->jenis_kelamin == 'Laki-laki')
                                    <i class="fas fa-mars text-blue-600"></i>
                                @else
                                    <i class="fas fa-venus text-pink-600"></i>
                                @endif
                                {{ $resident->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $resident->tanggal_lahir->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                @if ($resident->status_perkawinan == 'Belum Kawin') bg-blue-100 text-blue-800
                                @elseif ($resident->status_perkawinan == 'Kawin') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif
                            ">
                                {{ $resident->status_perkawinan }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $resident->agama }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $resident->kk->no_kk }}</td>
                        <td class="px-6 py-4 text-sm sticky right-0 bg-white hover:bg-blue-50">
                            <div class="flex gap-2">
                                <a href="{{ route('residents.edit', $resident) }}" class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('residents.destroy', $resident) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fas fa-inbox text-4xl text-gray-300"></i>
                                <p class="text-gray-500 font-medium">Tidak ada data penduduk</p>
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
    {{ $residents->links() }}
</div>
@endsection
