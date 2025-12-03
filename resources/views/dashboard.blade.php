@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div>
        <h3 class="text-3xl font-bold text-gray-900">SELAMAT DATANG DI APLIKASI GERGAJI</h3>
        <p class="text-gray-600 mt-2">BERANDA</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Jumlah Warga -->
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold mb-2">Jumlah Warga</h3>
                <div class="text-6xl font-bold my-4">{{ $totalWarga }}</div>
            </div>
        </div>

        <!-- Card 2: KK Terdaftar -->
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold mb-2">KK Terdaftar</h3>
                <div class="text-6xl font-bold my-4">{{ $totalKK }}</div>
            </div>
        </div>

        <!-- Card 3: Jumlah Laki-Laki & Perempuan -->
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold mb-2">Jumlah Laki-Laki & Perempuan</h3>
                <div class="text-6xl font-bold my-4">{{ $totalLaki + $totalPerempuan }}</div>
            </div>
        </div>
    </div>

    <!-- Pengumuman Terkini Section -->
    <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl shadow-lg p-8">
        <div class="flex items-center mb-6">
            <div class="bg-white rounded-lg p-3 mr-4">
                <i class="fas fa-bullhorn text-teal-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-white">Pengumuman Terkini</h3>
        </div>
        
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 space-y-3">
            @forelse($pengumuman as $item)
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 border border-white/30">
                    <p class="text-white text-sm">{{ $item }}</p>
                </div>
            @empty
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 border border-white/30">
                    <p class="text-white text-sm">Belum ada pengumuman terbaru.</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 border border-white/30">
                    <p class="text-white text-sm">Belum ada pengumuman terbaru.</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 border border-white/30">
                    <p class="text-white text-sm">Belum ada pengumuman terbaru.</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 border border-white/30">
                    <p class="text-white text-sm">Belum ada pengumuman terbaru.</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 border border-white/30">
                    <p class="text-white text-sm">Belum ada pengumuman terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection