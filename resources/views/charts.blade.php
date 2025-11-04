<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grafik & Statistik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-4">Grafik Status Perkawinan</h3>
                        <div style="height: 300px;">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-4">Grafik Pendidikan</h3>
                        <div style="height: 300px;">
                            <canvas id="pendidikanChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-4">Grafik Rentang Umur</h3>
                        <div style="height: 350px;">
                            <canvas id="umurChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-4">Grafik Pekerjaan (Top 10)</h3>
                        <div style="height: 350px;">
                            <canvas id="pekerjaanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        // Data dari controller
        const statusData = JSON.parse('{!! $statusChart !!}');
        const pendidikanData = JSON.parse('{!! $pendidikanChart !!}');
        const umurData = JSON.parse('{!! $umurChart !!}');
        const pekerjaanData = JSON.parse('{!! $pekerjaanChart !!}');
        
        // Warna dasar untuk pie chart
        const pieColors = [
            '#4F46E5', // Indigo
            '#10B981', // Emerald
            '#F59E0B', // Amber
            '#EF4444', // Red
            '#3B82F6', // Blue
            '#6B7280', // Gray
        ];

        // 1. Render Grafik Status Perkawinan (Pie)
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

        // 2. Render Grafik Pendidikan (Doughnut)
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

        // 3. Render Grafik Rentang Umur (Bar)
        const ctxUmur = document.getElementById('umurChart').getContext('2d');
        new Chart(ctxUmur, {
            type: 'bar',
            data: {
                labels: umurData.labels,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: umurData.values,
                    backgroundColor: '#3B82F6', // Blue
                    borderColor: '#1D4ED8',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // 4. Render Grafik Pekerjaan (Bar)
        const ctxPekerjaan = document.getElementById('pekerjaanChart').getContext('2d');
        new Chart(ctxPekerjaan, {
            type: 'bar',
            data: {
                labels: pekerjaanData.labels,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: pekerjaanData.values,
                    backgroundColor: '#10B981', // Emerald
                    borderColor: '#059669',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
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
</x-app-layout>