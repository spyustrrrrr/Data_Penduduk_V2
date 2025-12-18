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
        <button onclick="showChart('kelamin')" id="btn-kelamin" class="bg-white hover:bg-sky-700 text-gray-700 font-bold px-6 py-3 rounded-xl transition">
            Jenis Kelamin
        </button>
        <button onclick="showChart('umur')" id="btn-umur" class="bg-white hover:bg-sky-700 text-gray-700 font-bold px-6 py-3 rounded-xl transition">
            Usia
        </button>
        <button onclick="showChart('pendidikan')" id="btn-pendidikan" class="bg-white hover:bg-sky-700 text-gray-700 font-bold px-6 py-3 rounded-xl transition">
            Pendidikan
        </button>
        <button onclick="showChart('status')" id="btn-status" class="bg-white hover:bg-sky-700 text-gray-700 font-bold px-6 py-3 rounded-xl transition">
            Status Pernikahan
        </button>
    </div>

    <!-- Chart Container -->
    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <!-- Template Chart + Description -->
        <div id="chart-kelamin" class="chart-section">
            <div class="flex flex-row gap-6">
                <div class="w-1/3 flex flex-col justify-start">
                    @php $kelaminData = json_decode($kelaminChart, true); @endphp
                    <h3 class="text-2xl font-bold mb-4">Data Jenis Kelamin warga</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">Grafik ini menggambarkan sebaran warga berdasarkan jenis kelamin dengan detail sebagai berikut: .</p>
                    <ul class="text-gray-800 space-y-1 text-md">
                        @foreach($kelaminData['labels'] as $i => $label)
                            <li><strong>{{ $label }}</strong>: {{ $kelaminData['values'][$i] }} orang</li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-2/3 min-h-[350px]"><div id="kelaminChart"></div></div>
            </div>
        </div>

    <!-- Template Chart + Description -->
        <div id="chart-umur" class="chart-section hidden">
            <div class="flex flex-row gap-6">
                <div class="w-1/3 flex flex-col justify-start">
                    @php $umurData = json_decode($umurChart, true); @endphp
                    <h3 class="text-2xl font-bold mb-4">Data Umur warga</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">Grafik ini menggambarkan sebaran warga berdasarkan kelompok usia dengan detail sebagai berikut: .</p>
                    <ul class="text-gray-800 space-y-1 text-md">
                        @foreach($umurData['labels'] as $i => $label)
                            <li>kategori usia <strong>{{ $label }}</strong> berjumlah {{ $umurData['values'][$i] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-2/3 min-h-[350px]"><div id="umurChart"></div></div>
            </div>
        </div>


    <!-- Pendidikan -->
    <div id="chart-pendidikan" class="chart-section hidden">
        <div class="flex flex-row gap-6">
            <div class="w-1/3 flex flex-col justify-start">
                <h3 class="text-2xl font-bold mb-4">Data Pendidikan Warga</h3>
                <p class="text-gray-700 leading-relaxed mb-4">Grafik ini menggambarkan sebaran warga berdasarkan Tingkat Pendidikan Terakhir Warga dengan detail sebagai berikut: </p>

                @php $pendidikanData = json_decode($pendidikanChart, true); @endphp

                <ul class="text-gray-800 space-y-1 text-md">
                    @foreach($pendidikanData['labels'] as $i => $label)
                        <li><strong>{{ $label }}</strong>: {{ $pendidikanData['values'][$i] }} orang</li>
                    @endforeach
                </ul>
            </div>
            <div class="w-2/3 min-h-[350px]">
                <div id="pendidikanChart"></div>
            </div>
        </div>
    </div>

    <!-- Status Perkawinan -->
    <div id="chart-status" class="chart-section hidden">
        <div class="flex flex-row gap-6">
            <div class="w-1/3 flex flex-col justify-start">
                <h3 class="text-2xl font-bold mb-4">Data Status Pernikahan Warga</h3>
                <p class="text-gray-700 leading-relaxed mb-4">Grafik ini menggambarkan sebaran warga berdasarkan Status Pernikahan Warga dengan detail sebagai berikut: </p>

                @php $statusData = json_decode($statusChart, true); @endphp

                <ul class="text-gray-800 space-y-1 text-md">
                    @foreach($statusData['labels'] as $i => $label)
                        <li><strong>{{ $label }}</strong>: {{ $statusData['values'][$i] }} orang</li>
                    @endforeach
                </ul>
            </div>
            <div class="w-2/3 min-h-[350px]">
                <div id="statusChart"></div>
            </div>
        </div>
    </div>

</div>

</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Data dari controller
    const statusData = {!! $statusChart !!};
    const pendidikanData = {!! $pendidikanChart !!};
    const umurData = {!! $umurChart !!};
    const kelaminData = {!! $kelaminChart !!};

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
// === 1. UMUR ===
    let umurChartInstance = new ApexCharts(
        document.querySelector("#umurChart"),{
            series: umurData.values,
            chart: {type: 'donut',height: 450},
            labels: umurData.labels,
            colors: colors,
            legend: { position: 'right', fontSize: '24px', gap: '5px',
                markers: { width: 16, height: 16},
                itemMargin: { vertical: 5},
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {show: true,label: 'Total',fontSize: '22px',fontWeight: 600,color: '#333',
                            formatter: function(w) {return w.globals.seriesTotals.reduce((a, b) => a + b, 0);}
                            }
                        }
                    }
                }
            }
        }
    );
    umurChartInstance.render();   // << INI YANG KAMU MAKSUDKAN "RENDER"

     // === 2. PENDIDIKAN ===
    let pendidikanChartInstance = new ApexCharts(
        document.querySelector("#pendidikanChart"),
        {
            series: pendidikanData.values,
            chart: { type: 'donut', height: 450 },
            labels: pendidikanData.labels,
            colors: colors,
                        legend: { position: 'right', fontSize: '24px', gap: '5px',
                markers: { width: 16, height: 16},
                itemMargin: {  vertical: 5},
            },
                        plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {show: true,label: 'Total',fontSize: '22px',fontWeight: 600,color: '#333',
                            formatter: function(w) {return w.globals.seriesTotals.reduce((a, b) => a + b, 0);}
                            }
                        }
                    }
                }
            }
        }
    );
    pendidikanChartInstance.render();

    // === 3. PEKERJAAN ===
    let kelaminChartInstance = new ApexCharts(
        document.querySelector("#kelaminChart"),
        {
            series: kelaminData.values,
            chart: { type: 'donut', height: 450 },
            labels: kelaminData.labels,
            colors: colors,
            legend: { position: 'right', fontSize: '24px', gap: '5px',
                markers: { width: 16, height: 16},
                itemMargin: { vertical: 5},
            },
                        plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {show: true,label: 'Total',fontSize: '22px',fontWeight: 600,color: '#333',
                            formatter: function(w) {return w.globals.seriesTotals.reduce((a, b) => a + b, 0);}
                            }
                        }
                    }
                }
            }
        }
    );
    kelaminChartInstance.render();

    // === 4. STATUS PERKAWINAN ===
    let statusChartInstance = new ApexCharts(
        document.querySelector("#statusChart"),
        {
            series: statusData.values,
            chart: { type: 'donut', height: 450 },
            labels: statusData.labels,
            colors: colors,
            legend: { position: 'right', fontSize: '24px', gap: '5px',
                markers: { width: 16, height: 16},
                itemMargin: { vertical: 5},
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {show: true,label: 'Total',fontSize: '22px',fontWeight: 600,color: '#333',
                            formatter: function(w) {return w.globals.seriesTotals.reduce((a, b) => a + b, 0);}
                            }
                        }
                    }
                }
            }
        }
    );
    statusChartInstance.render();

     // === FUNGSI SHOW CHART TETAP SAMA ===
    function showChart(chartName) {
        document.querySelectorAll('.chart-section').forEach(section => {
            section.classList.add('hidden');
        });

        document.querySelectorAll('button[id^="btn-"]').forEach(btn => {
            btn.classList.remove('bg-sky-800', 'text-white');
            btn.classList.add('bg-white', 'text-gray-900');
        });

        document.getElementById(`chart-${chartName}`).classList.remove('hidden');

        const activeBtn = document.getElementById(`btn-${chartName}`);
        activeBtn.classList.remove('bg-white', 'text-gray-900');
        activeBtn.classList.add('bg-sky-800', 'text-white');
    }

    showChart('kelamin'); // Tampilkan chart jenis kelamin secara default
</script>
@endpush
@endsection
