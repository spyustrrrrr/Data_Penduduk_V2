@extends('layouts.app')

@section('title', 'Manajemen Admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Kelola Admin</h1>
            <p class="text-gray-600 mt-2">Kelola akun admin dan izin akses untuk mengedit data</p>
        </div>
        <a href="{{ route('admins.create') }}" class="bg-sky-900 text-white px-6 py-3 rounded-lg hover:bg-sky-700 transition flex items-center gap-2 w-fit shadow-lg">
            <i class="fas fa-plus"></i>
            <span>Tambah Admin Baru</span>
        </a>
    </div>

    <!-- Added success/error message alerts -->
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-4">
            <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
            <div>
                <h3 class="font-semibold text-green-900">Berhasil</h3>
                <p class="text-green-700 text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start gap-4">
            <i class="fas fa-exclamation-circle text-red-600 text-xl mt-0.5"></i>
            <div>
                <h3 class="font-semibold text-red-900">Terjadi Kesalahan</h3>
                <p class="text-red-700 text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Admin List Table with modern styling -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-sky-900 to-sky-800 px-6 py-4 border-b border-sky-200">
            <div class="flex items-center gap-3">
                <i class="fas fa-users text-white text-lg"></i>
                <h2 class="text-lg font-bold text-white">Daftar Admin ({{ $admins->total() }})</h2>
            </div>
        </div>

        <!-- Responsive Table -->
        @if ($admins->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Admin</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status Izin</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($admins as $index => $admin)
                            <tr class="hover:bg-sky-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ ($admins->currentPage() - 1) * $admins->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center">
                                            <i class="fas fa-user text-sky-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $admin->name }}</p>
                                            <p class="text-xs text-gray-500">ID: {{ $admin->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <code class="bg-lime-300 px-3 py-1 rounded text-sm font-bold">{{ $admin->email }}</code>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($admin->can_edit)
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-300">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Diizinkan</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-800 border border-gray-300">
                                            <i class="fas fa-lock"></i>
                                            <span>Terbatas</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <!-- Edit button -->
                                        <a href="{{ route('admins.edit', $admin) }}" class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition text-xs font-medium flex items-center gap-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                            <span class="hidden sm:inline">Edit</span>
                                        </a>

                                        <!-- Toggle permission button -->
                                        <form method="POST" action="{{ route('admins.toggle-edit', $admin) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-2 rounded-lg {{ $admin->can_edit ? 'bg-orange-100 text-orange-700 hover:bg-orange-200' : 'bg-purple-100 text-purple-700 hover:bg-purple-200' }} transition text-xs font-medium flex items-center gap-1" title="{{ $admin->can_edit ? 'Cabut Izin' : 'Berikan Izin' }}">
                                                <i class="fas fa-toggle-{{ $admin->can_edit ? 'on' : 'off' }}"></i>
                                                <span class="hidden sm:inline">{{ $admin->can_edit ? 'Cabut' : 'Berikan' }}</span>
                                            </button>
                                        </form>

                                        <!-- Delete button -->
                                        <form method="POST" action="{{ route('admins.destroy', $admin) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin {{ $admin->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition text-xs font-medium flex items-center gap-1" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                                <span class="hidden sm:inline">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200">
                {{ $admins->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="px-6 py-12 text-center">
                <div class="inline-block mb-4">
                    <i class="fas fa-inbox text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Admin</h3>
                <p class="text-gray-600 mb-6">Mulai dengan membuat akun admin baru</p>
                <a href="{{ route('admins.create') }}" class="bg-sky-600 text-white px-6 py-2 rounded-lg hover:bg-sky-700 transition inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Admin</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Admin Statistics Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Admin -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-sky-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Admin</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $admins->total() }}</p>
                </div>
                <div class="bg-sky-100 rounded-full p-4">
                    <i class="fas fa-users text-sky-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Admin Aktif (Diizinkan Edit) -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Admin Diizinkan Edit</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $admins->where('can_edit', true)->count() }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Admin Terbatas -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Admin Terbatas (Baca Saja)</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $admins->where('can_edit', false)->count() }}</p>
                </div>
                <div class="bg-orange-100 rounded-full p-4">
                    <i class="fas fa-lock text-orange-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced styling for pagination links -->
<style>
    .pagination {
        @apply flex items-center justify-center gap-2 mt-6;
    }
    .pagination a,
    .pagination span {
        @apply px-4 py-2 rounded-lg border border-gray-200 text-sm font-medium transition;
    }
    .pagination a {
        @apply hover:bg-sky-50 hover:border-sky-300 hover:text-sky-600;
    }
    .pagination .active span {
        @apply bg-sky-600 text-white border-sky-600;
    }
    .pagination .disabled {
        @apply opacity-50 cursor-not-allowed;
    }
</style>
@endsection
