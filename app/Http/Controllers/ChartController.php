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
        // Bucket umur: Bayi (0-1), Balita (1-5), Anak-anak (6-10), Remaja (11-18), Dewasa (19-59), Lansia (60+)
        $umurData = DB::table('residents')
            ->select(DB::raw("
                CASE
                    WHEN (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) >= 0 AND (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) < 6 THEN 'Balita (0-5 Tahun)'
                    WHEN (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) >= 6 AND (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) < 11 THEN 'Anak-anak (6-10 Tahun)'
                    WHEN (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) >= 11 AND (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) < 19 THEN 'Remaja (11-18 Tahun)'
                    WHEN (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) >= 19 AND (TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE())/12) < 60 THEN 'Dewasa (19-59 Tahun)'
                    ELSE 'Lansia (60+ Tahun)'
                END as rentang_umur,
                count(*) as total
            "))
            ->groupBy('rentang_umur')
            // Urutkan berdasarkan umur minimum tiap grup (dalam bulan)
            ->orderByRaw("MIN(TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE()))")
            ->get();
        $umurChart = $this->formatChartData($umurData, 'rentang_umur');

                // 4. Data Grafik Status jenis kelamin (Pie Chart)
        $kelaminChart = DB::table('residents')
            ->groupBy('jenis_kelamin')
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->get();
        $kelaminChart = $this->formatChartData($kelaminChart, 'jenis_kelamin');
        // Kirim semua data ke view
        return view('charts', [
            'statusChart' => json_encode($statusChart),
            'pendidikanChart' => json_encode($pendidikanChart),
            'umurChart' => json_encode($umurChart),
            'kelaminChart' => json_encode($kelaminChart),
        ]);
    }}

