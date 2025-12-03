@extends('layouts.app')

@section('title', 'Grafik')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h3 class="text-3xl font-bold text-white">Pilih Kategori</h3>
    </div>

    <!-- Category Buttons -->
    <div class="flex gap-4">
        <button onclick="showChart('umur')" id="btn-umur" class="bg-teal-500 hover:bg-teal-600 text-white font-bold px-6 py-3 rounded-xl transition">
            Umur
        </button>
        <button onclick="showChart('pendidikan')" id="btn-pendidikan" class="bg-white hover:bg-gray-100 text-gray-900 font-bold px-6 py-3 rounded-xl transition">
            Pendidikan
        </button>
        <button onclick="showChart('pekerjaan')" id="btn-pekerjaan" class="bg-white hover:bg-gray-100 text-gray-900 font-bold px-6 py-3 rounded-xl transition">
            Pekerjaan
        </button>
        <button onclick="showChart('status')" id="btn-status" class="bg-white hover:bg-gray-100 text-gray-900 font-bold px-6 py-3 rounded-xl transition">
            Status
        </button>
    </div>

    <!-- Chart Container -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <!-- Distribusi Umur Chart -->
        <div id="chart-umur" class="chart-section">
            <h3 class="text-2xl font-bold text-center mb-8">Distribusi Umur</h3>
            <div style="height: 400px; max-width: 600px; margin: 0 auto;">
                <canvas id="umurChart"></canvas>
            </div>
        </div>

        <!-- Pendidikan Terakhir Chart -->
        <div id="chart-pendidikan" class="chart-section hidden">
            <h3 class="text-2xl font-bold text-center mb-8">Pendidikan Terakhir</h3>
            <div style="height: 400px; max-width: 600px; margin: 0 auto;">
                <canvas id="pendidikanChart"></canvas>
            </div>
        </div>

        <!-- Pekerjaan Chart -->
        <div id="chart-pekerjaan" class="chart-section hidden">
            <h3 class="text-2xl font-bold text-center mb-8">Pekerjaan</h3>
            <div style="height: 400px; max-width: 600px; margin: 0 auto;">
                <canvas id="pekerjaanChart"></canvas>
            </div>
        </div>

        <!-- Status Perkawinan Chart -->
        <div id="chart-status" class="chart-section hidden">
            <h3 class="text-2xl font-bold text-center mb-8">Status Perkawinan</h3>
            <div style="height: 400px; max-width: 600px; margin: 0 auto;">
                <canvas id="statusChart"></canvas>
            </div>
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
    const colors = [
        '#3B82F6', // Blue
        '#10B981', // Green
        '#F59E0B', // Orange
        '#EF4444', // Red
        '#8B5CF6', // Purple
        '#EC4899', // Pink
    ];

    // Chart instances
    let umurChartInstance, pendidikanChartInstance, pekerjaanChartInstance, statusChartInstance;

    // 1. Grafik Distribusi Umur (Pie)
    const ctxUmur = document.getElementById('umurChart').getContext('2d');
    umurChartInstance = new Chart(ctxUmur, {
        type: 'doughnut',
        data: {
            labels: umurData.labels,
            datasets: [{
                data: umurData.values,
                backgroundColor: colors,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // 2. Grafik Pendidikan (Pie)
    const ctxPendidikan = document.getElementById('pendidikanChart').getContext('2d');
    pendidikanChartInstance = new Chart(ctxPendidikan, {
        type: 'doughnut',
        data: {
            labels: pendidikanData.labels,
            datasets: [{
                data: pendidikanData.values,
                backgroundColor: colors,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // 3. Grafik Pekerjaan (Pie)
    const ctxPekerjaan = document.getElementById('pekerjaanChart').getContext('2d');
    pekerjaanChartInstance = new Chart(ctxPekerjaan, {
        type: 'doughnut',
        data: {
            labels: pekerjaanData.labels,
            datasets: [{
                data: pekerjaanData.values,
                backgroundColor: colors,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // 4. Grafik Status Perkawinan (Pie)
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    statusChartInstance = new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: statusData.labels,
            datasets: [{
                data: statusData.values,
                backgroundColor: colors,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Function to show chart
    function showChart(chartName) {
        // Hide all charts
        document.querySelectorAll('.chart-section').forEach(section => {
            section.classList.add('hidden');
        });

        // Remove active state from all buttons
        document.querySelectorAll('button[id^="btn-"]').forEach(btn => {
            btn.classList.remove('bg-teal-500', 'text-white');
            btn.classList.add('bg-white', 'text-gray-900');
        });

        // Show selected chart
        document.getElementById(`chart-${chartName}`).classList.remove('hidden');

        // Add active state to selected button
        const activeBtn = document.getElementById(`btn-${chartName}`);
        activeBtn.classList.remove('bg-white', 'text-gray-900');
        activeBtn.classList.add('bg-teal-500', 'text-white');
    }

    // Initialize with Umur chart visible
    showChart('umur');
</script>
@endpush
@endsection