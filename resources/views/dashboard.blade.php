<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\KK;
use Illuminate\Support\Facades\DB; // <-- DB mungkin tidak terpakai, tapi tidak masalah

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     */
    public function index()
    {
        // 1. Statistik Utama
        $totalWarga = Resident::count();
        $totalKK = KK::count();
        $totalLaki = Resident::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Resident::where('jenis_kelamin', 'Perempuan')->count();

        // 2. Pengumuman
        // Anda bisa tambahkan logika untuk mengambil pengumuman di sini
        $pengumuman = []; // Placeholder

        // Kirim semua data ke view
        return view('dashboard', [
            'totalWarga' => $totalWarga,
            'totalKK' => $totalKK,
            'totalLaki' => $totalLaki,
            'totalPerempuan' => $totalPerempuan,
            'pengumuman' => $pengumuman,
        ]);
    }
}