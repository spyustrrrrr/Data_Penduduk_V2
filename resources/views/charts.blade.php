@extends('layouts.app')

@section('title', 'Grafik & Statistik')

@section('content')
<div class="mb-8">
    <h3 class="text-2xl font-bold text-gray-900 mb-2">Grafik & Statistik Penduduk</h3>
    <p class="text-gray-600">Visualisasi data penduduk dalam bentuk grafik</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Status Perkawinan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-900">
            <i class="fas fa-ring text-blue-600 mr-2"></i>Status Perkawinan
        </h3>
        <div style="height: 300px;">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
    
    <!-- Pendidikan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-900">
            <i class="fas fa-graduation-cap text-green-600 mr-2"></i>Pendidikan
        </h3>
        <div style="height: 300px;">
            <canvas id="pendidikanChart"></canvas>
        </div>
    </div>

    <!-- Rentang Umur -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 lg:col-span-2">
        <h3 class="text-lg font-semibold mb-4 text-gray-900">
            <i class="fas fa-birthday-cake text-purple-600 mr-2"></i>Rentang Umur
        </h3>
        <div style="height: 350px;">
            <canvas id="umurChart"></canvas>
        </div>
    </div>

    <!-- Pekerjaan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 lg:col-span-2">
        <h3 class="text-lg font-semibold mb-4 text-gray-900">
            <i class="fas fa-briefcase text-orange-600 mr-2"></i>Pekerjaan (Top 10)
        </h3>
        <div style="height: 350px;">
            <canvas id="pekerjaanChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Data dari controller
    const statusData = {!! $statusChart !!};
    const pendidikanData = {!! $pendidikanChart !!};
    const umurData = {!! $umurChart !!};
    const pekerjaanData = {!! $pekerjaanChart !!};
    
    // Warna untuk charts
    const pieColors = [
        '#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#3B82F6', '#6B7280',
        '#8B5CF6', '#EC4899', '#14B8A6', '#F97316'
    ];

    // 1. Grafik Status Perkawinan (Pie)
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'pie',
        data: {
            labels: statusData.labels,
            datasets: [{
                data: statusData.values,
                backgroundColor: pieColors,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // 2. Grafik Pendidikan (Doughnut)
    const ctxPendidikan = document.getElementById('pendidikanChart').getContext('2d');
    new Chart(ctxPendidikan, {
        type: 'doughnut',
        data: {
            labels: pendidikanData.labels,
            datasets: [{
                data: pendidikanData.values,
                backgroundColor: pieColors,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // 3. Grafik Rentang Umur (Bar)
    const ctxUmur = document.getElementById('umurChart').getContext('2d');
    new Chart(ctxUmur, {
        type: 'bar',
        data: {
            labels: umurData.labels,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: umurData.values,
                backgroundColor: '#3B82F6',
                borderColor: '#1D4ED8',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // 4. Grafik Pekerjaan (Bar Horizontal)
    const ctxPekerjaan = document.getElementById('pekerjaanChart').getContext('2d');
    new Chart(ctxPekerjaan, {
        type: 'bar',
        data: {
            labels: pekerjaanData.labels,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: pekerjaanData.values,
                backgroundColor: '#10B981',
                borderColor: '#059669',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
@endsection