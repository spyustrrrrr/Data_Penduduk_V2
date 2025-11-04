@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h3 class="text-2xl font-bold text-gray-900 mb-2">Dashboard</h3>
    <p class="text-gray-600">Selamat datang di Sistem Pendataan Penduduk</p>
</div>

<!-- Statistik Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Warga -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <span class="text-3xl font-bold">{{ $totalWarga }}</span>
        </div>
        <h3 class="text-lg font-semibold">Total Warga</h3>
        <p class="text-blue-100 text-sm">Penduduk terdaftar</p>
    </div>

    <!-- Total KK -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                <i class="fas fa-home text-2xl"></i>
            </div>
            <span class="text-3xl font-bold">{{ $totalKK }}</span>
        </div>
        <h3 class="text-lg font-semibold">Total KK</h3>
        <p class="text-green-100 text-sm">Kartu Keluarga</p>
    </div>

    <!-- Laki-laki -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                <i class="fas fa-mars text-2xl"></i>
            </div>
            <span class="text-3xl font-bold">{{ $totalLaki }}</span>
        </div>
        <h3 class="text-lg font-semibold">Laki-laki</h3>
        <p class="text-purple-100 text-sm">Penduduk pria</p>
    </div>

    <!-- Perempuan -->
    <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                <i class="fas fa-venus text-2xl"></i>
            </div>
            <span class="text-3xl font-bold">{{ $totalPerempuan }}</span>
        </div>
        <h3 class="text-lg font-semibold">Perempuan</h3>
        <p class="text-pink-100 text-sm">Penduduk wanita</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">
        <i class="fas fa-bolt text-yellow-500 mr-2"></i>Quick Actions
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('residents.create') }}" class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition border border-blue-200">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-plus text-white"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">Tambah Penduduk</h4>
                <p class="text-sm text-gray-600">Daftarkan warga baru</p>
            </div>
        </a>

        <a href="{{ route('kks.create') }}" class="flex items-center gap-3 p-4 bg-green-50 hover:bg-green-100 rounded-lg transition border border-green-200">
            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-home text-white"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">Tambah KK</h4>
                <p class="text-sm text-gray-600">Buat kartu keluarga baru</p>
            </div>
        </a>

        <a href="{{ route('charts.index') }}" class="flex items-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition border border-purple-200">
            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-bar text-white"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">Lihat Grafik</h4>
                <p class="text-sm text-gray-600">Statistik penduduk</p>
            </div>
        </a>
    </div>
</div>

<!-- Pengumuman (jika ada) -->
@if(count($pengumuman) > 0)
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">
        <i class="fas fa-bullhorn text-blue-600 mr-2"></i>Pengumuman
    </h3>
    <div class="space-y-3">
        @foreach($pengumuman as $item)
        <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
            <h4 class="font-semibold text-gray-900">{{ $item['title'] }}</h4>
            <p class="text-sm text-gray-600">{{ $item['content'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection