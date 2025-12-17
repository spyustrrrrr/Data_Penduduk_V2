<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\KK;
use App\Models\ActivityLog;

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

        // Ambil 5 log aktivitas terbaru
        $pengumuman = ActivityLog::with('user')
            ->latest('created_at')
            ->take(5)
            ->get()
            ->map(function ($log) {
                return [
                    'description' => $log->description,
                    'user' => $log->user ? $log->user->name : 'System',
                    'time' => $log->created_at->diffForHumans(),
                    'action' => $log->action,
                ];
            });

        return view('dashboard', [
            'totalWarga' => $totalWarga,
            'totalKK' => $totalKK,
            'totalLaki' => $totalLaki,
            'totalPerempuan' => $totalPerempuan,
            'pengumuman' => $pengumuman,
        ]);
    }
}