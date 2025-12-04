@extends('layouts.app')

@section('title', 'Tabel Warga')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold text-white">TABLE WARGA</h3>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="flex items-center gap-2 mb-4">
            <i class="fas fa-filter text-sky-800"></i>
            <h3 class="font-semibold text-gray-900">Filter & Pencarian</h3>
        </div>

        <form method="GET" action="{{ route('residents.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                    <input type="text" name="search" placeholder="Nama, NIK, atau No. KK" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
                    <select name="status_perkawinan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-800 focus:border-transparent transition">
                        <option value="">Semua</option>
                        <option value="Belum Menikah" {{ request('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Menikah" {{ request('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Janda" {{ request('status_perkawinan') == 'Janda' ? 'selected' : '' }}>Janda</option>
                        <option value="Duda" {{ request('status_perkawinan') == 'Duda' ? 'selected' : '' }}>Duda</option>
                    </select>
                </div>

                <div>
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

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan</label>
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

                <div class="lg:col-span-2 flex items-end gap-2">
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

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">

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
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->tanggal_lahir->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->usia }} Tahun</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->jenis_kelamin }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->agama }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold
                                    @if ($resident->status_perkawinan == 'Belum Menikah') bg-blue-100 text-blue-800
                                    @elseif ($resident->status_perkawinan == 'Menikah') bg-green-100 text-green-800
                                    @elseif ($resident->status_perkawinan == 'Janda') bg-yellow-100 text-yellow-800
                                    @elseif ($resident->status_perkawinan == 'Duda') bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $resident->status_perkawinan }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->pendidikan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->pekerjaan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->no_telepon ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->email ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->golongan_darah ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->status_merokok ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->cek_kesehatan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->asuransi_kesehatan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                <div class="max-w-[150px]">
                                    <p class="truncate" title="{{ $resident->riwayat_penyakit }}">{{ $resident->riwayat_penyakit ?? '-' }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->nama_ayah ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->nama_ibu ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->bpjs_ketenagakerjaan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->tambah_anak ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap text-center">{{ $resident->jumlah_anak ?? '0' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ $resident->alat_kontrasepsi ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap sticky right-0 bg-white">
                                <div class="flex gap-1">
                                    <a href="{{ route('residents.show', $resident->id) }}"
                                       class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-lg text-xs font-medium transition"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
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
            <div class="flex justify-start items-start">
                <!-- Left: info -->
                <p class="text-sm text-gray-600">Menampilkan
                    <span class="font-medium">{{ $residents->firstItem() ?? 0 }}</span>
                    -
                    <span class="font-medium">{{ $residents->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-medium">{{ $residents->total() }}</span>
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
                   class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-100 transition disabled:opacity-50"
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
                           class="w-16 h-9 text-center border border-gray-200 rounded-lg bg-white text-sm focus:ring-2 focus:ring-sky-700 focus:outline-none" />
                    <span class="ml-2 text-sm text-gray-600">/ {{ $last }}</span>
                </form>

                <a href="{{ $next ?? '#' }}"
                   class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-100 transition disabled:opacity-50"
                   aria-label="Next"
                   @if(!$next) aria-disabled="true" @endif>
                    <i class="fas fa-chevron-right"></i>
                </a>
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
