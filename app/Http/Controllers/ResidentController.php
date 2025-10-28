<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\KK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::with('kk');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%")
                  ->orWhere('kks.no_kk', 'like', "%$search%");
            })->join('kks', 'residents.kk_id', '=', 'kks.id');
        }

        // Filter by jenis_kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter by status_perkawinan
        if ($request->filled('status_perkawinan')) {
            $query->where('status_perkawinan', $request->status_perkawinan);
        }

        // Filter by agama
        if ($request->filled('agama')) {
            $query->where('agama', $request->agama);
        }

        $residents = $query->paginate(15);
        $kks = KK::all();

        return view('residents.index', compact('residents', 'kks'));
    }

    public function create()
    {
        $kks = KK::all();
        return view('residents.create', compact('kks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kk_id' => 'required|exists:kks,id',
            'nik' => 'required|unique:residents',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        Resident::create($validated);

        return redirect()->route('residents.index')->with('success', 'Penduduk berhasil ditambahkan');
    }

    public function edit(Resident $resident)
    {
        $kks = KK::all();
        return view('residents.edit', compact('resident', 'kks'));
    }

    public function update(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'kk_id' => 'required|exists:kks,id',
            'nik' => 'required|unique:residents,nik,' . $resident->id,
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $resident->update($validated);

        return redirect()->route('residents.index')->with('success', 'Penduduk berhasil diperbarui');
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();
        return redirect()->route('residents.index')->with('success', 'Penduduk berhasil dihapus');
    }

    public function export(Request $request)
    {
        $query = Resident::with('kk');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%");
        }

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('status_perkawinan')) {
            $query->where('status_perkawinan', $request->status_perkawinan);
        }

        if ($request->filled('agama')) {
            $query->where('agama', $request->agama);
        }

        $residents = $query->get();

        $csv = "NIK,Nama,Jenis Kelamin,Tanggal Lahir,Tempat Lahir,Status Perkawinan,Agama,Pekerjaan,Pendidikan,No. Telepon,Email,No. KK\n";

        foreach ($residents as $resident) {
            $csv .= "\"{$resident->nik}\",\"{$resident->nama}\",\"{$resident->jenis_kelamin}\",\"{$resident->tanggal_lahir}\",\"{$resident->tempat_lahir}\",\"{$resident->status_perkawinan}\",\"{$resident->agama}\",\"{$resident->pekerjaan}\",\"{$resident->pendidikan}\",\"{$resident->no_telepon}\",\"{$resident->email}\",\"{$resident->kk->no_kk}\"\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="penduduk_' . date('Y-m-d') . '.csv"',
        ]);
    }
}
