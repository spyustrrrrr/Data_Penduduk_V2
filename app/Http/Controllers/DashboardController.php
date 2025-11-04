<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\KK;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalWarga = Resident::count();
        $totalKK = KK::count();
        $totalLaki = Resident::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Resident::where('jenis_kelamin', 'Perempuan')->count();

        // Anda bisa tambahkan logika untuk mengambil pengumuman di sini
        // $pengumuman = Pengumuman::latest()->take(5)->get();
        $pengumuman = []; // Placeholder, ganti dengan data asli nanti

        return view('dashboard', [
            'totalWarga' => $totalWarga,
            'totalKK' => $totalKK,
            'totalLaki' => $totalLaki,
            'totalPerempuan' => $totalPerempuan,
            'pengumuman' => $pengumuman,
        ]);
    }
}