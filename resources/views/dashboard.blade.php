@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div>
        <h3 class="text-3xl font-bold text-gray-900">SELAMAT DATANG DI APLIKASI GERGAJI</h3>
        <p class="text-gray-600 mt-2 font-bold">BERANDA</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card 1: Jumlah Warga -->
        <div class="bg-gradient-to-br from-sky-700 to-sky-800 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold mb-2">Jumlah Warga</h3>
                <div class="text-6xl font-bold my-4">{{ $totalWarga }}</div>
            </div>
        </div>

        <!-- Card 2: KK Terdaftar -->
        <div class="bg-gradient-to-br from-sky-700 to-sky-800 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold mb-2">KK Terdaftar</h3>
                <div class="text-6xl font-bold my-4">{{ $totalKK }}</div>
            </div>
        </div>

        <!-- Card 3: Jumlah Laki-Laki & Perempuan -->
        <div class="bg-gradient-to-br from-sky-700 to-sky-800 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold mb-2">Jumlah Laki-Laki</h3>
                <div class="text-6xl font-bold my-4">{{ $totalLaki}}</div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-sky-700 to-sky-800 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-xl font-semibold mb-2">Jumlah Perempuan</h3>
                <div class="text-6xl font-bold my-4">{{$totalPerempuan }}</div>
            </div>
        </div>
    </div>

    <!-- Pengumuman Terkini Section -->
    <div class="bg-gradient-to-br from-sky-700 to-sky-800 rounded-2xl shadow-lg p-8">
        <div class="flex items-center mb-6">
            <div class="bg-sky-100 rounded-3xl p-3 mr-3">
                <i class="fas fa-bullhorn text-sky-800 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-white">Riwayat Pembaruan</h3>
        </div>

        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 space-y-3 max-h-[350px] overflow-y-auto">
            @forelse($pengumuman as $item)
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 border border-white/30 hover:bg-white/30 transition">
                    <div class="flex items-start gap-3">
                        <!-- Icon berdasarkan action -->
                        <div class="flex-shrink-0 mt-1">
                            @if($item['action'] === 'created')
                                <i class="fas fa-plus-circle text-green-300 text-lg"></i>
                            @elseif($item['action'] === 'updated')
                                <i class="fas fa-edit text-yellow-300 text-lg"></i>
                            @elseif($item['action'] === 'deleted')
                                <i class="fas fa-trash text-red-300 text-lg"></i>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <p class="text-white text-sm font-medium">{{ $item['description'] }}</p>
                            <div class="flex items-center gap-3 mt-2 text-xs text-white/80">
                                <span><i class="fas fa-user mr-1"></i>{{ $item['user'] }}</span>
                                <span><i class="fas fa-clock mr-1"></i>{{ $item['time'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-6 border border-white/30 text-center">
                    <i class="fas fa-inbox text-white/50 text-3xl mb-3"></i>
                    <p class="text-white text-sm">Belum ada aktivitas terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection