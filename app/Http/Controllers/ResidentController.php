<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\KK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{
    /**
     * Menampilkan daftar penduduk dengan filter dan pencarian.
     */
    public function index(Request $request)
    {
        $query = Resident::with('kk');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            // Memastikan join hanya dilakukan sekali jika ada search
            $query->join('kks', 'residents.kk_id', '=', 'kks.id')
                  ->where(function ($q) use ($search) {
                      $q->where('residents.nama', 'like', "%$search%")
                        ->orWhere('residents.nik', 'like', "%$search%")
                        ->orWhere('kks.no_kk', 'like', "%$search%");
                  })
                  ->select('residents.*'); // Penting untuk menghindari konflik kolom 'id'
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
        
        // [BARU] Filter by pendidikan
        if ($request->filled('pendidikan')) {
            $query->where('pendidikan', $request->pendidikan);
        }

        $residents = $query->paginate(7)->appends($request->query());
        $kks = KK::all();

        return view('residents.index', compact('residents', 'kks'));
    }

    /**
     * Menampilkan form untuk membuat penduduk baru.
     */
    public function create()
    {
        $kks = KK::all();
        return view('residents.create', compact('kks'));
    }

    /**
     * Menyimpan penduduk baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kk_id' => 'required|exists:kks,id',
            'nik' => 'required|string|unique:residents',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'alamat' => 'required|string|max:255',
            
            // Aturan validasi yang diperbarui
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah,Janda,Duda',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pendidikan' => 'nullable|in:SD,SMP,SMA/SMK,D1/D2/D3,S1/D4,S2,S3',
            
            'pekerjaan' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email|unique:residents',

            // Validasi untuk bidang baru
            'golongan_darah' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'status_merokok' => 'nullable|in:MEROKOK,TIDAK MEROKOK',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'riwayat_penyakit' => 'nullable|string',
            'cek_kesehatan' => 'nullable|in:SETIAP BULAN,3 BULAN SEKALI,6 BULAN SEKALI,SETAHUN SEKALI,TIDAK PERNAH',
            'asuransi_kesehatan' => 'nullable|in:BPJS KESEHATAN,BPJS PRIBADI,ASURANSI SWASTA,TIDAK MEMILIKI',
            'bpjs_ketenagakerjaan' => 'nullable|in:MEMILIKI,TIDAK MEMILIKI',
            'tambah_anak' => 'nullable|in:YA,TIDAK',
            'jumlah_anak' => 'nullable|integer|min:0',
            'alat_kontrasepsi' => 'nullable|in:KONDOM,IUD/SPIRAL,PIL,SUNTIK,IMPLANT,STERIL,TIDAK ADA',
        ]);

        Resident::create($validated);

        return redirect()->route('residents.index')->with('success', 'Penduduk berhasil ditambahkan');
    }

    /**
     * [BARU] Menampilkan detail data penduduk.
     */
    public function show(Resident $resident)
    {
        // $resident sudah di-load oleh Route Model Binding
        return view('residents.show', compact('resident'));
    }

    /**
     * Menampilkan form untuk mengedit data penduduk.
     */
    public function edit(Resident $resident)
    {
        $kks = KK::all();
        return view('residents.edit', compact('resident', 'kks'));
    }

    /**
     * Memperbarui data penduduk di database.
     */
    public function update(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'kk_id' => 'required|exists:kks,id',
            'nik' => 'required|string|unique:residents,nik,' . $resident->id,
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'alamat' => 'required|string|max:255',

            // Aturan validasi yang diperbarui
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah,Janda,Duda',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pendidikan' => 'nullable|in:SD,SMP,SMA/SMK,D1/D2/D3,S1/D4,S2,S3',

            'pekerjaan' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email|unique:residents,email,' . $resident->id,

            // Validasi untuk bidang baru
            'golongan_darah' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'status_merokok' => 'nullable|in:MEROKOK,TIDAK MEROKOK',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'riwayat_penyakit' => 'nullable|string',
            'cek_kesehatan' => 'nullable|in:SETIAP BULAN,3 BULAN SEKALI,6 BULAN SEKALI,SETAHUN SEKALI,TIDAK PERNAH',
            'asuransi_kesehatan' => 'nullable|in:BPJS KESEHATAN,BPJS PRIBADI,ASURANSI SWASTA,TIDAK MEMILIKI',
            'bpjs_ketenagakerjaan' => 'nullable|in:MEMILIKI,TIDAK MEMILIKI',
            'tambah_anak' => 'nullable|in:YA,TIDAK',
            'jumlah_anak' => 'nullable|integer|min:0',
            'alat_kontrasepsi' => 'nullable|in:KONDOM,IUD/SPIRAL,PIL,SUNTIK,IMPLANT,STERIL,TIDAK ADA',
        ]);

        $resident->update($validated);

        return redirect()->route('residents.index')->with('success', 'Penduduk berhasil diperbarui');
    }

    /**
     * Menghapus data penduduk dari database.
     */
    public function destroy(Resident $resident)
    {
        $resident->delete();
        return redirect()->route('residents.index')->with('success', 'Penduduk berhasil dihapus');
    }

    /**
     * Mengekspor data penduduk ke CSV.
     */
    public function export(Request $request)
    {
        $query = Resident::with('kk');

        // Menggunakan filter yang sama dengan 'index'
        if ($request->filled('search')) {
            $search = $request->search;
            $query->join('kks', 'residents.kk_id', '=', 'kks.id')
                  ->where(function ($q) use ($search) {
                      $q->where('residents.nama', 'like', "%$search%")
                        ->orWhere('residents.nik', 'like', "%$search%")
                        ->orWhere('kks.no_kk', 'like', "%$search%");
                  })
                  ->select('residents.*');
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

        if ($request->filled('pendidikan')) {
            $query->where('pendidikan', $request->pendidikan);
        }

        $residents = $query->get();

        // [UPDATE] Menambahkan kolom baru ke CSV
        $csv = "NIK,Nama,Jenis Kelamin,Tanggal Lahir,Tempat Lahir,Status Perkawinan,Agama,Pendidikan,Pekerjaan,Nama Ayah,Nama Ibu,Gol. Darah,No. KK\n";

        foreach ($residents as $resident) {
            $csv .= "\"{$resident->nik}\",\"{$resident->nama}\",\"{$resident->jenis_kelamin}\",\"{$resident->tanggal_lahir->format('Y-m-d')}\",\"{$resident->tempat_lahir}\",\"{$resident->status_perkawinan}\",\"{$resident->agama}\",\"{$resident->pendidikan}\",\"{$resident->pekerjaan}\",\"{$resident->nama_ayah}\",\"{$resident->nama_ibu}\",\"{$resident->golongan_darah}\",\"{$resident->kk->no_kk}\"\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="penduduk_' . date('Y-m-d') . '.csv"',
        ]);
    }
}