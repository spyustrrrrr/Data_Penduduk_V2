<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident; // PASTIKAN INI ADA
use Illuminate\Support\Facades\DB; // PASTIKAN INI ADA

class ChartController extends Controller
{
    /**
     * Helper untuk memformat data untuk Chart.js
     */
    private function formatChartData($data, $labelKey, $dataKey = 'total')
    {
        // Ganti label null/kosong menjadi 'Tidak Diisi'
        $labels = $data->pluck($labelKey)->map(fn ($item) => $item ?? 'Tidak Diisi');
        $values = $data->pluck($dataKey);

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    /**
     * Menampilkan halaman grafik.
     */
    public function index()
    {
        // 1. Data Grafik Status Perkawinan (Pie Chart)
        $statusData = DB::table('residents')
            ->groupBy('status_perkawinan')
            ->select('status_perkawinan', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->get();
        $statusChart = $this->formatChartData($statusData, 'status_perkawinan');

        // 2. Data Grafik Pendidikan (Pie Chart)
        $pendidikanData = DB::table('residents')
            ->where('pendidikan', '!=', '') // Abaikan string kosong
            ->groupBy('pendidikan')
            ->select('pendidikan', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->get();
        $pendidikanChart = $this->formatChartData($pendidikanData, 'pendidikan');

        // 3. Data Grafik Rentang Umur (Bar Chart)
        $umurData = DB::table('residents')
            ->select(DB::raw("
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 10 THEN '0-10 Tahun'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 20 THEN '11-20 Tahun'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 30 THEN '21-30 Tahun'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 40 THEN '31-40 Tahun'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 50 THEN '41-50 Tahun'
                    ELSE '51+ Tahun'
                END as rentang_umur,
                count(*) as total
            "))
            ->groupBy('rentang_umur')
            // Urutkan berdasarkan urutan rentang umur, bukan jumlah
            ->orderByRaw("MIN(TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()))")
            ->get();
        $umurChart = $this->formatChartData($umurData, 'rentang_umur');
        
        // 4. Data Grafik Pekerjaan (Bar Chart - Top 10)
        $pekerjaanData = DB::table('residents')
            ->where('pekerjaan', '!=', '') // Abaikan string kosong
            ->groupBy('pekerjaan')
            ->select('pekerjaan', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        $pekerjaanChart = $this->formatChartData($pekerjaanData, 'pekerjaan');

        // Kirim semua data ke view
        return view('charts', [
            'statusChart' => json_encode($statusChart),
            'pendidikanChart' => json_encode($pendidikanChart),
            'umurChart' => json_encode($umurChart),
            'pekerjaanChart' => json_encode($pekerjaanChart),
        ]);
    }
}