@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Button & Header -->
    <div class="mb-8">
        <a href="{{ route('admins.index') }}" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-medium mb-4 group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            <span>Kembali ke Daftar Admin</span>
        </a>
        <h1 class="text-4xl font-bold text-gray-900">Edit Admin</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi dan pengaturan akun admin</p>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 flex items-start gap-4">
            <i class="fas fa-exclamation-circle text-red-600 text-xl mt-0.5"></i>
            <div>
                <h3 class="font-semibold text-red-900 mb-2">Validasi Gagal</h3>
                <ul class="text-red-700 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <i class="fas fa-circle-xmark text-xs"></i>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Admin Info Card -->
    <div class="bg-gradient-to-r from-sky-50 to-blue-50 rounded-lg p-6 mb-8 border border-sky-200">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-sky-600 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-white text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Admin yang diedit</p>
                <h2 class="text-2xl font-bold text-gray-900">{{ $admin->name }}</h2>
                <p class="text-gray-600 text-sm mt-1">
                    <i class="fas fa-envelope mr-1"></i>{{ $admin->email }}
                </p>
            </div>
            <div class="ml-auto">
                @if ($admin->can_edit)
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-300">
                        <i class="fas fa-check-circle"></i>
                        <span>Dapat Edit</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-800 border border-gray-300">
                        <i class="fas fa-lock"></i>
                        <span>Hanya Baca</span>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admins.update', $admin) }}" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Form Section: Admin Information -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-sky-100 flex items-center justify-center">
                        <i class="fas fa-user text-sky-600"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Informasi Admin</h2>
                </div>

                <div class="space-y-6">
                    <!-- Name Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            <i class="fas fa-signature mr-2 text-sky-600"></i>Nama Lengkap *
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $admin->name) }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent transition"
                            placeholder="Masukkan nama lengkap admin">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            <i class="fas fa-envelope mr-2 text-sky-600"></i>Email / Username *
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $admin->email) }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent transition"
                            placeholder="contoh@email.com">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200"></div>

            <!-- Form Section: Security -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-lock text-amber-600"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Keamanan</h2>
                </div>

                <div class="space-y-6">
                    <!-- Password Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            <i class="fas fa-key mr-2 text-amber-600"></i>Kata Sandi Baru
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent transition"
                            placeholder="Biarkan kosong jika tidak ingin mengubah password">
                        <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-yellow-900 text-sm flex items-start gap-2">
                                <i class="fas fa-exclamation-triangle mt-0.5 flex-shrink-0"></i>
                                <span>Kosongkan jika tidak ingin mengubah password. Masukkan password baru jika ingin mereset password admin.</span>
                            </p>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200"></div>

            <!-- Form Section: Current Permissions -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                        <i class="fas fa-shield-alt text-green-600"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Status Izin Akses</h2>
                </div>

                <div class="space-y-4">
                    <!-- Current Status -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-blue-900 text-sm flex items-start gap-2">
                            <i class="fas fa-info-circle mt-0.5 flex-shrink-0"></i>
                            <span>
                                Status izin akses saat ini: <strong>
                                    @if($admin->can_edit)
                                        Admin dapat mengedit data warga
                                    @else
                                        Admin hanya dapat melihat data warga (Baca Saja)
                                    @endif
                                </strong>
                            </span>
                        </p>
                    </div>

                    <!-- Quick Toggle Info -->
                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-900 text-sm flex items-start gap-2">
                            <i class="fas fa-check-circle mt-0.5 flex-shrink-0"></i>
                            <span>Gunakan tombol <strong>Cabut/Berikan Izin</strong> di halaman daftar admin untuk mengubah status izin akses dengan cepat.</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button 
                    type="submit" 
                    class="flex-1 bg-sky-600 text-white px-6 py-3 rounded-lg hover:bg-sky-700 transition font-semibold flex items-center justify-center gap-2 shadow-lg">
                    <i class="fas fa-save"></i>
                    <span>Simpan Perubahan</span>
                </button>
                <a 
                    href="{{ route('admins.index') }}" 
                    class="flex-1 bg-gray-200 text-gray-900 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-times-circle"></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="mt-8 bg-red-50 rounded-lg p-6 border border-red-200">
        <h3 class="font-bold text-red-900 mb-3 flex items-center gap-2">
            <i class="fas fa-warning"></i>
            Zona Berbahaya
        </h3>
        <p class="text-red-800 text-sm mb-4">
            Hapus akun admin ini secara permanen. Tindakan ini tidak dapat dibatalkan.
        </p>
        <form method="POST" action="{{ route('admins.destroy', $admin) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin {{ $admin->name }}? Tindakan ini tidak dapat dibatalkan.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-semibold flex items-center gap-2">
                <i class="fas fa-trash"></i>
                <span>Hapus Admin</span>
            </button>
        </form>
    </div>
</div>
@endsection
