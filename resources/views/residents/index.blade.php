@extends('layouts.app')

@section('title', 'Tabel Warga')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold text-white">REKAP DATA WARGA</h3>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl h-full shadow-xl p-6 mb-6 overflow-hidden transition-all">
        <div class="flex items-center justify-between gap-2 mb-4 z-10 bg-white" id="filter-switch">
            <div class="flex items-center gap-2">
                <i class="fas fa-filter text-sky-800"></i>
                <h3 class="font-semibold text-gray-900">Filter & Pencarian</h3>
            </div>
            <div>
                <button id="toggleFiltersBtn" type="button"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-900 text-gray-50 hover:bg-sky-800 active:scale-110 transition">
                    ▼
                </button>
            </div>
        </div>

        <form id="filtersPanel" method="GET" action="{{ route('residents.index') }}"
        class="{{ request()->query() ? '' : 'hidden' }} space-y-4 animate__animated animate__fadeIn animate__faster">
            <div class="grid grid-cols-3 gap-4">
                <div class="">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                    <input type="text" name="search" placeholder="Nama, NIK, No.KK, Tempat Lahir, Alamat, DLL" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                </div>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                    <select name="agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
                    <select name="status_perkawinan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="Belum Menikah" {{ request('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Menikah" {{ request('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Janda" {{ request('status_perkawinan') == 'Janda' ? 'selected' : '' }}>Janda</option>
                        <option value="Duda" {{ request('status_perkawinan') == 'Duda' ? 'selected' : '' }}>Duda</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan Terakhir</label>
                    <select name="pendidikan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="SD" {{ request('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ request('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA/SMK" {{ request('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="D1/D2/D3" {{ request('pendidikan') == 'D1/D2/D3' ? 'selected' : '' }}>D1/D2/D3</option>
                        <option value="S1/D4" {{ request('pendidikan') == 'S1/D4' ? 'selected' : '' }}>S1/D4</option>
                        <option value="S2" {{ request('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ request('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Golongan Darah</label>
                    <select name="golongan_darah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="A+" {{ request('golongan_darah') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ request('golongan_darah') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ request('golongan_darah') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ request('golongan_darah') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ request('golongan_darah') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ request('golongan_darah') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ request('golongan_darah') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ request('golongan_darah') == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                </div>

                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cek Kesehatan</label>
                    <select name="cek_kesehatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="SETIAP BULAN" {{ request('cek_kesehatan') == 'SETIAP BULAN' ? 'selected' : '' }}>Setiap Bulan</option>
                        <option value="3 BULAN SEKALI" {{ request('cek_kesehatan') == '3 BULAN SEKALI' ? 'selected' : '' }}>3 Bulan Sekali</option>
                        <option value="6 BULAN SEKALI" {{ request('cek_kesehatan') == '6 BULAN SEKALI' ? 'selected' : '' }}>6 Bulan Sekali</option>
                        <option value="SETAHUN SEKALI" {{ request('cek_kesehatan') == 'SETAHUN SEKALI' ? 'selected' : '' }}>Setahun Sekali</option>
                        <option value="TIDAK PERNAH" {{ request('cek_kesehatan') == 'TIDAK PERNAH' ? 'selected' : '' }}>Tidak Pernah</option>
                    </select>
                </div>
            </div>
        <div class="flex gap-4">
            <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Asuransi Kesehatan</label>
                    <select name="asuransi_kesehatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="BPJS KESEHATAN" {{ request('asuransi_kesehatan') == 'BPJS KESEHATAN' ? 'selected' : '' }}>BPJS Kesehatan</option>
                        <option value="BPJS PRIBADI" {{ request('asuransi_kesehatan') == 'BPJS PRIBADI' ? 'selected' : '' }}>BPJS Pribadi</option>
                        <option value="ASURANSI SWASTA" {{ request('asuransi_kesehatan') == 'ASURANSI SWASTA' ? 'selected' : '' }}>Asuransi Swasta</option>
                        <option value="TIDAK MEMILIKI" {{ request('asuransi_kesehatan') == 'TIDAK MEMILIKI' ? 'selected' : '' }}>Tidak Memiliki</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">BPJS Ketenagakerjaan</label>
                    <select name="bpjs_ketenagakerjaan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="MEMILIKI" {{ request('bpjs_ketenagakerjaan') == 'MEMILIKI' ? 'selected' : '' }}>Memiliki</option>
                        <option value="TIDAK MEMILIKI" {{ request('bpjs_ketenagakerjaan') == 'TIDAK MEMILIKI' ? 'selected' : '' }}>Tidak Memiliki</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keinginan Menambah Anak</label>
                    <select name="tambah_anak" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="YA" {{ request('tambah_anak') == 'YA' ? 'selected' : '' }}>YA</option>
                        <option value="TIDAK" {{ request('tambah_anak') == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alat Kontrasepsi</label>
                    <select name="alat_kontrasepsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="KONDOM" {{ request('alat_kontrasepsi') == 'KONDOM' ? 'selected' : '' }}>Kondom</option>
                        <option value="IUD/SPIRAL" {{ request('alat_kontrasepsi') == 'IUD/SPIRAL' ? 'selected' : '' }}>IUD / Spiral</option>
                        <option value="PIL" {{ request('alat_kontrasepsi') == 'PIL' ? 'selected' : '' }}>Pil</option>
                        <option value="SUNTIK" {{ request('alat_kontrasepsi') == 'SUNTIK' ? 'selected' : '' }}>Suntik</option>
                        <option value="IMPLANT" {{ request('alat_kontrasepsi') == 'IMPLANT' ? 'selected' : '' }}>Implant</option>
                        <option value="STERIL" {{ request('alat_kontrasepsi') == 'STERIL' ? 'selected' : '' }}>Steril</option>
                        <option value="TIDAK ADA" {{ request('alat_kontrasepsi') == 'TIDAK ADA' ? 'selected' : '' }}>Tidak Ada</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Merokok</label>
                    <select name="status_merokok" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="MEROKOK" {{ request('status_merokok') == 'MEROKOK' ? 'selected' : '' }}>Merokok</option>
                        <option value="TIDAK MEROKOK" {{ request('status_merokok') == 'TIDAK MEROKOK' ? 'selected' : '' }}>Tidak Merokok</option>
                    </select>
                </div>

                <div class="w-1/2">
                    <label for="jumlah_anak" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Anak</label>
                    <input id="jumlah_anak" name="jumlah_anak" type="number" min="0" value="{{ request('jumlah_anak') }}" placeholder="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition" />
                </div>
            </div>
                <div class=" col-span-1 flex items-end gap-3">
                    <div class="w-1/2">
                        <label for="age_from" class="block text-sm font-medium text-gray-700 mb-2">Umur (Dari)</label>
                        <input id="age_from" name="age_from" type="number" min="0" max="120" value="{{ request('age_from') }}" placeholder="umur awal"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition" />
                    </div>
                    <div class="w-1/2">
                        <label for="age_to" class="block text-sm font-medium text-gray-700 mb-2">Umur (Sampai)</label>
                        <input id="age_to" name="age_to" type="number" min="0" max="120" value="{{ request('age_to') }}" placeholder="umur akhir"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition" />
                    </div>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full bg-sky-800 hover:bg-sky-900 text-white px-4 py-2 rounded-lg transition font-medium flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i>
                        Filter
                    </button>
                    <a href="{{ route('residents.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition font-medium text-gray-700">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        (function(){
            const btn = document.getElementById('toggleFiltersBtn');
            const container = document.getElementById('filter-switch');
            const panel = document.getElementById('filtersPanel');
            if (!btn || !panel) return;

            // initialize button state based on panel visibility
            function setBtnState() {
                const hidden = panel.classList.contains('hidden') || window.getComputedStyle(panel).display === 'none';
                // when panel hidden, set padding-bottom of header to 0
                if (container) {
                    if (hidden) {
                        container.classList.remove('mb-4');
                    } else {
                        container.classList.add('mb-4');
                    }
                }
            }

            btn.addEventListener('click', function(){
                panel.classList.toggle('hidden');
                btn.classList.toggle('rotate-180');
                setBtnState();
            });

            // set initial
            document.addEventListener('DOMContentLoaded', setBtnState);
            // also call once now in case scripts are loaded late
            setBtnState();
        })();

        const el = document.getElementById('tableWrapper');

        el.addEventListener('wheel', function(e) {
            if (e.deltaY !== 0) {        // kalau scroll wheel digerakkan
                e.preventDefault();      // jangan scroll vertikal
                el.scrollLeft += e.deltaY; // geser horizontal
            }
        });
    </script>
    @endpush

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto" id="tableWrapper">
            <style>
                /* Sticky first columns setup */
                .table-sticky td.sticky {
                    position: sticky;
                    z-index: 30;
                    background: white;
                    box-shadow: 1px 0 0 rgba(0,0,0,0.04);
                }

                /* keep header gradient/background for sticky header cells */
                .table-sticky thead th.sticky {
                    position: sticky;
                    z-index: 45;
                    background: oklch(44.3% 0.11 240.79);
                }

                /* widths for sticky columns (adjust if your layout differs) */
                .table-sticky th.col-1, .table-sticky td.col-1 { left: 0; min-width: 64px; width: 64px; }
                .table-sticky th.col-2, .table-sticky td.col-2 { left: 64px; min-width: 220px; width: 220px; }
                .table-sticky th.col-3, .table-sticky td.col-3 { left: 284px; min-width: 180px; width: 180px; }
                .table-sticky th.col-4, .table-sticky td.col-4 { left: 464px; min-width: 160px; width: 160px; }

                /* ensure header stays above sticky cells when scrolling vertically */
                .table-sticky thead th { z-index: 50; }
            </style>

            <table class="w-full table-sticky">
                <thead class="bg-sky-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-bold text-sm sticky col-1">No</th>
                        <th class="px-4 py-3 text-left font-bold text-sm sticky col-2">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left font-bold text-sm sticky col-3">NIK</th>
                        <th class="px-4 py-3 text-left font-bold text-sm sticky col-4">No. Kartu Keluarga</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Alamat</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Tempat Lahir</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Tanggal Lahir</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Usia</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Agama</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Status Perkawinan</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Pendidikan Terakhir</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Pekerjaan</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">No. Telepon</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Email</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Golongan Darah</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Status Merokok</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Cek Kesehatan</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Asuransi Kesehatan</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Riwayat Penyakit</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Nama Ayah</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Nama Ibu</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">BPJS Ketenagakerjaan</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Keinginan Menambah Anak</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Jumlah Anak</th>
                        <th class="px-4 py-3 text-left font-bold text-sm">Alat Kontrasepsi</th>
                        <th class="px-4 py-3 text-left font-bold text-sm sticky right-0 bg-sky-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $badgeMap = [
                            'status_perkawinan' => [
                                'Belum Menikah' => 'bg-sky-100 text-sky-800',
                                'Menikah' => 'bg-green-100 text-green-800',
                                'Janda' => 'bg-amber-100 text-amber-800',
                                'Duda' => 'bg-gray-100 text-gray-800',
                            ],
                            'golongan_darah' => [
                                'A+' => 'bg-red-100 text-red-800',
                                'A-' => 'bg-red-200 text-red-900',
                                'B+' => 'bg-sky-100 text-sky-800',
                                'B-' => 'bg-sky-200 text-sky-900',
                                'AB+' => 'bg-purple-100 text-purple-800',
                                'AB-' => 'bg-purple-200 text-purple-900',
                                'O+' => 'bg-emerald-100 text-emerald-800',
                                'O-' => 'bg-emerald-200 text-emerald-900',
                            ],
                            'status_merokok' => [
                                'MEROKOK' => 'bg-red-100 text-red-800',
                                'TIDAK MEROKOK' => 'bg-green-100 text-green-800',
                            ],
                            'cek_kesehatan' => [
                                'SETIAP BULAN' => 'bg-sky-100 text-sky-800',
                                '3 BULAN SEKALI' => 'bg-indigo-100 text-indigo-800',
                                '6 BULAN SEKALI' => 'bg-purple-100 text-purple-800',
                                'SETAHUN SEKALI' => 'bg-amber-100 text-amber-800',
                                'TIDAK PERNAH' => 'bg-gray-100 text-gray-800',
                            ],
                            'asuransi_kesehatan' => [
                                'BPJS KESEHATAN' => 'bg-sky-100 text-sky-800',
                                'BPJS PRIBADI' => 'bg-indigo-100 text-indigo-800',
                                'ASURANSI SWASTA' => 'bg-emerald-100 text-emerald-800',
                                'TIDAK MEMILIKI' => 'bg-gray-100 text-gray-800',
                            ],
                            'bpjs_ketenagakerjaan' => [
                                'MEMILIKI' => 'bg-green-100 text-green-800',
                                'TIDAK MEMILIKI' => 'bg-gray-100 text-gray-800',
                            ],
                            'jenis_kelamin' => [
                                'Laki-laki' => 'bg-sky-100 text-sky-800',
                                'Perempuan' => 'bg-pink-100 text-pink-800',
                            ],
                            'agama' => [
                                'Islam' => 'bg-green-100 text-green-800',
                                'Kristen' => 'bg-sky-100 text-sky-800',
                                'Katolik' => 'bg-indigo-100 text-indigo-800',
                                'Hindu' => 'bg-amber-100 text-amber-800',
                                'Buddha' => 'bg-purple-100 text-purple-800',
                                'Konghucu' => 'bg-rose-100 text-rose-800',
                            ],
                            'pendidikan' => [
                                'SD' => 'bg-amber-100 text-amber-800',
                                'SMP' => 'bg-yellow-100 text-yellow-800',
                                'SMA/SMK' => 'bg-sky-100 text-sky-800',
                                'D1/D2/D3' => 'bg-indigo-100 text-indigo-800',
                                'S1/D4' => 'bg-green-100 text-green-800',
                                'S2' => 'bg-purple-100 text-purple-800',
                                'S3' => 'bg-rose-100 text-rose-800',
                            ],
                            'tambah_anak' => [
                                'YA' => 'bg-sky-100 text-sky-800',
                                'TIDAK' => 'bg-gray-100 text-gray-800',
                            ],
                            'alat_kontrasepsi' => [
                                'KONDOM' => 'bg-indigo-100 text-indigo-800',
                                'IUD/SPIRAL' => 'bg-purple-100 text-purple-800',
                                'PIL' => 'bg-amber-100 text-amber-800',
                                'SUNTIK' => 'bg-emerald-100 text-emerald-800',
                                'IMPLANT' => 'bg-sky-100 text-sky-800',
                                'STERIL' => 'bg-rose-100 text-rose-800',
                                'TIDAK ADA' => 'bg-gray-100 text-gray-800',
                            ],
                        ];
                    @endphp
                    @forelse ($residents as $index => $resident)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm whitespace-nowrap sticky col-1">{{ $residents->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-sm font-semibold whitespace-nowrap sticky col-2">{{ $resident->nama }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap sticky col-3">{{ $resident->nik }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap sticky col-4">{{ $resident->kk->no_kk ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                <div class="max-w-[200px]">
                                    <p class="truncate" title="{{ $resident->alamat }}">{{ $resident->alamat }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->tempat_lahir }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ optional($resident->tanggal_lahir)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->usia }} Tahun</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $jk = $resident->jenis_kelamin ?? ''; $jkCls = $badgeMap['jenis_kelamin'][$jk] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $jkCls }}">{{ $jk ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $ag = $resident->agama ?? ''; $agCls = $badgeMap['agama'][$ag] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $agCls }}">{{ $ag ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php
                                    $spClass = $badgeMap['status_perkawinan'][$resident->status_perkawinan ?? ''] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $spClass }}">
                                    {{ $resident->status_perkawinan }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $pd = $resident->pendidikan ?? ''; $pdCls = $badgeMap['pendidikan'][$pd] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $pdCls }}">{{ $pd ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->pekerjaan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->no_telepon ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->email ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $gd = $resident->golongan_darah ?? ''; $gdCls = $badgeMap['golongan_darah'][$gd] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $gdCls }}">{{ $gd ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $sm = $resident->status_merokok ?? ''; $smCls = $badgeMap['status_merokok'][$sm] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $smCls }}">{{ $sm ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $ck = $resident->cek_kesehatan ?? ''; $ckCls = $badgeMap['cek_kesehatan'][$ck] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $ckCls }}">{{ $ck ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $as = $resident->asuransi_kesehatan ?? ''; $asCls = $badgeMap['asuransi_kesehatan'][$as] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $asCls }}">{{ $as ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="max-w-[150px]">
                                    <p class="truncate" title="{{ $resident->riwayat_penyakit }}">{{ $resident->riwayat_penyakit ?? '-' }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->nama_ayah ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->nama_ibu ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $bpj = $resident->bpjs_ketenagakerjaan ?? ''; $bpjCls = $badgeMap['bpjs_ketenagakerjaan'][$bpj] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $bpjCls }}">{{ $bpj ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $ta = $resident->tambah_anak ?? ''; $taCls = $badgeMap['tambah_anak'][$ta] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $taCls }}">{{ $ta ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap text-center">{{ $resident->jumlah_anak ?? '0' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @php $ak = $resident->alat_kontrasepsi ?? ''; $akCls = $badgeMap['alat_kontrasepsi'][$ak] ?? 'bg-gray-100 text-gray-800'; @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $akCls }}">{{ $ak ?: '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap sticky right-0 bg-white">
                                <div class="flex gap-1">
                                    <a href="{{ route('residents.show', $resident->id) }}"
                                       class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-lg text-xs font-medium transition"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(Auth::user()->canEdit())
                                    <a href="{{ route('residents.edit', $resident->id) }}"
                                       class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-lg text-xs font-medium transition"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('residents.destroy', $resident) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-lg text-xs font-medium transition"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Restricted Access</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="27" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-inbox text-4xl text-gray-300"></i>
                                    <p class="font-medium">Tidak ada data warga</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
            <div class="flex gap-6 justify-center items-center">
            <div class="flex justify-center items-center gap-2">
                <!-- Left: info -->
                <p class="text-md text-gray-600">Menampilkan
                    <span class="font-bold">{{ $residents->firstItem() ?? 0 }}</span>
                    -
                    <span class="font-bold">{{ $residents->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-bold">{{ $residents->total() }}</span>
                </p>
            </div>

            <!-- Center: pagination controls -->
            <div class="flex gap-3 justify-start items-start">
                @php
                    $prev = $residents->previousPageUrl();
                    $next = $residents->nextPageUrl();
                    $current = $residents->currentPage();
                    $last = $residents->lastPage();
                @endphp

                <a href="{{ $prev ?? '#' }}"
                   class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200 bg-sky-700 text-gray-50 hover:bg-sky-800 transition disabled:opacity-50"
                   aria-label="Previous"
                   @if(!$prev) aria-disabled="true" @endif>
                    <i class="fas fa-chevron-left"></i>
                </a>

                <form id="gotoPageForm" method="GET" action="{{ route('residents.index') }}" class="inline-flex items-center">
                    {{-- preserve other query params --}}
                    @foreach(request()->except('page') as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach

                    <input id="pageInput" name="page" type="number" inputmode="numeric" min="1" max="{{ $last }}"
                           value="{{ $current }}"
                           class="w-12 h-9 text-center border border-gray-200 rounded-lg bg-sky-100 text-sm focus:ring-2 focus:ring-sky-700 focus:outline-none font-bold" />
                    <span class="ml-2 text-sm font-bold text-gray-600">/ {{ $last }}</span>
                </form>

                <a href="{{ $next ?? '#' }}"
                   class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200 bg-sky-700 text-gray-50 hover:bg-sky-800 transition disabled:opacity-50"
                   aria-label="Next"
                   @if(!$next) aria-disabled="true" @endif>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            </div>
            <div class="flex gap-3">
                     <a href="{{ route('residents.export', request()->query()) }}"
                         class="bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 text-white font-bold px-6 py-2 rounded-lg transition shadow-lg inline-flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    Download Excel
                </a>
                     <a href="{{ route('residents.create') }}"
                         class="bg-gradient-to-r from-sky-700 to-sky-800 hover:from-sky-800 hover:to-sky-900 text-white font-bold px-6 py-2 rounded-lg transition shadow-lg inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
