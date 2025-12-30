@extends('layouts.app')

@section('title', 'Tambah Admin Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Button & Header -->
    <div class="mb-8">
        <a href="{{ route('admins.index') }}" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-medium mb-4 group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            <span>Kembali ke Daftar Admin</span>
        </a>
        <h1 class="text-4xl font-bold text-gray-900">Tambah Admin Baru</h1>
        <p class="text-gray-600 mt-2">Buat akun admin baru untuk mengelola data warga</p>
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

    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admins.store') }}" class="space-y-8">
            @csrf

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
                            value="{{ old('name') }}" 
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
                            value="{{ old('email') }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent transition"
                            placeholder="contoh@email.com">
                        <p class="text-gray-600 text-sm mt-2">Email ini akan digunakan sebagai username untuk login</p>
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
                            <i class="fas fa-key mr-2 text-amber-600"></i>Kata Sandi *
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent transition"
                            placeholder="Minimal 8 karakter">
                        <div class="mt-3 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-blue-900 text-sm flex items-start gap-2">
                                <i class="fas fa-info-circle mt-0.5 flex-shrink-0"></i>
                                <span>Password akan diatur oleh Super Admin. Admin tidak perlu mengetahui password ini sebelumnya.</span>
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

            <!-- Form Section: Permissions -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                        <i class="fas fa-shield-alt text-green-600"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Izin Akses</h2>
                </div>

                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-900 text-sm flex items-start gap-2">
                        <i class="fas fa-check-circle mt-0.5 flex-shrink-0"></i>
                        <span>Admin baru akan dibuat dengan akses <strong>Terbatas (Baca Saja)</strong>. Super Admin dapat mengubah izin edit kapan saja.</span>
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button 
                    type="submit" 
                    class="flex-1 bg-sky-600 text-white px-6 py-3 rounded-lg hover:bg-sky-700 transition font-semibold flex items-center justify-center gap-2 shadow-lg">
                    <i class="fas fa-check-circle"></i>
                    <span>Buat Admin</span>
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

    <!-- Info Box -->
    <div class="mt-8 bg-gradient-to-r from-sky-50 to-blue-50 rounded-lg p-6 border border-sky-200">
        <div class="flex gap-4">
            <div class="flex-shrink-0">
                <i class="fas fa-lightbulb text-sky-600 text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Tips untuk Super Admin</h3>
                <ul class="text-gray-700 text-sm space-y-1">
                    <li><i class="fas fa-check text-green-600 mr-2"></i>Gunakan email yang mudah diingat sebagai username</li>
                    <li><i class="fas fa-check text-green-600 mr-2"></i>Catat password untuk diberikan kepada admin</li>
                    <li><i class="fas fa-check text-green-600 mr-2"></i>Anda dapat mengubah izin admin kapan saja di halaman daftar admin</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
