<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-500">Total Warga</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $totalWarga }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-500">Total KK Terdaftar</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $totalKK }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-500">Jumlah Laki-laki</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $totalLaki }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-500">Jumlah Perempuan</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $totalPerempuan }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Pengumuman Terkini</h3>
                    
                    @if(count($pengumuman) > 0)
                        <ul class="space-y-4">
                            @foreach($pengumuman as $item)
                                <li class="border-b pb-2">
                                    <h4 class="font-medium">{{ $item->judul }}</h4>
                                    <p class="text-sm text-gray-600">{{ $item->isi }}</p>
                                    <span class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Belum ada pengumuman terkini.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>