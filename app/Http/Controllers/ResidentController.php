<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\KK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    $query->where(function ($q) use ($search) {
        $q->where('residents.nama', 'like', "%$search%")
          ->orWhere('residents.nik', 'like', "%$search%")
          ->orWhere('residents.alamat', 'like', "%$search%")
          ->orWhere('residents.pekerjaan', 'like', "%$search%")
          ->orWhere('residents.tempat_lahir', 'like', "%$search%")
          ->orWhere('residents.riwayat_penyakit', 'like', "%$search%")
          ->orWhere('residents.email', 'like', "%$search%")
          ->orWhere('residents.no_telepon', 'like', "%$search%")
          ->orWhere('residents.nama_ayah', 'like', "%$search%")
          ->orWhere('residents.nama_ibu', 'like', "%$search%");
    })
    ->orWhereHas('kk', function ($k) use ($search) {
        $k->where('no_kk', 'like', "%$search%");
    });
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

        // Filter by pendidikan
        if ($request->filled('pendidikan')) {
            $query->where('pendidikan', $request->pendidikan);
        }



        // Filter by golongan darah
        if ($request->filled('golongan_darah')) {
            $query->where('golongan_darah', $request->golongan_darah);
        }

        // Filter by cek kesehatan
        if ($request->filled('cek_kesehatan')) {
            $query->where('cek_kesehatan', $request->cek_kesehatan);
        }

        // Filter by keinginan menambah anak (tambah_anak)
        if ($request->filled('tambah_anak')) {
            $query->where('tambah_anak', $request->tambah_anak);
        }

        // Filter by asuransi kesehatan
        if ($request->filled('asuransi_kesehatan')) {
            $query->where('asuransi_kesehatan', $request->asuransi_kesehatan);
        }

        // Filter by alat kontrasepsi
        if ($request->filled('alat_kontrasepsi')) {
            $query->where('alat_kontrasepsi', $request->alat_kontrasepsi);
        }

        if ($request->filled('bpjs_ketenagakerjaan')) {
            $query->where('bpjs_ketenagakerjaan', $request->bpjs_ketenagakerjaan);
        }

        if ($request->filled('status_merokok')) {
            $query->where('status_merokok', $request->status_merokok);
        }

        if ($request->filled('jumlah_anak')) {
            $query->where('jumlah_anak', $request->jumlah_anak);
        }

        // Filter by BPJS Ketenagakerjaan
        if ($request->filled('bpjs_ketenagakerjaan')) {
            $query->where('bpjs_ketenagakerjaan', $request->bpjs_ketenagakerjaan);
        }

        // Filter by status merokok
        if ($request->filled('status_merokok')) {
            $query->where('status_merokok', $request->status_merokok);
        }



        // Filter by age range (umur)
        if ($request->filled('age_from') || $request->filled('age_to')) {
            $today = Carbon::today();

            if ($request->filled('age_from') && $request->filled('age_to')) {
                $ageFrom = (int) $request->age_from;
                $ageTo = (int) $request->age_to;
                if ($ageFrom > $ageTo) {
                    [$ageFrom, $ageTo] = [$ageTo, $ageFrom];
                }

                // ageFrom = minimum age, ageTo = maximum age
                // tanggal_lahir between (today - ageTo years) and (today - ageFrom years)
                $dateOlder = $today->copy()->subYears($ageTo)->endOfDay();
                $dateYounger = $today->copy()->subYears($ageFrom)->startOfDay();

                $query->whereBetween('tanggal_lahir', [$dateOlder, $dateYounger]);
            } elseif ($request->filled('age_from')) {
                $ageFrom = (int) $request->age_from;
                $dateYounger = $today->copy()->subYears($ageFrom)->startOfDay();
                // umur >= age_from -> tanggal_lahir <= dateYounger
                $query->where('tanggal_lahir', '<=', $dateYounger);
            } else {
                $ageTo = (int) $request->age_to;
                $dateOlder = $today->copy()->subYears($ageTo)->endOfDay();
                // umur <= age_to -> tanggal_lahir >= dateOlder
                $query->where('tanggal_lahir', '>=', $dateOlder);
            }
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

    // SEARCH
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('residents.nama', 'like', "%$search%")
            ->orWhere('residents.nik', 'like', "%$search%")
            ->orWhere('residents.alamat', 'like', "%$search%")
            ->orWhere('residents.pekerjaan', 'like', "%$search%")
            ->orWhere('residents.tempat_lahir', 'like', "%$search%")
            ->orWhere('residents.riwayat_penyakit', 'like', "%$search%")
            ->orWhere('residents.email', 'like', "%$search%")
            ->orWhere('residents.no_telepon', 'like', "%$search%")
            ->orWhere('residents.nama_ayah', 'like', "%$search%")
            ->orWhere('residents.nama_ibu', 'like', "%$search%");
        })
        ->orWhereHas('kk', function ($k) use ($search) {
            $k->where('no_kk', 'like', "%$search%");
        });
    }

    // FILTERS
    $filterFields = [
        'jenis_kelamin','status_perkawinan','agama','pendidikan',
        'golongan_darah','cek_kesehatan','tambah_anak',
        'asuransi_kesehatan','bpjs_ketenagakerjaan','status_merokok',
        'jumlah_anak','alat_kontrasepsi'
    ];

    // Untuk penamaan file
    $activeFilters = [];

    foreach ($filterFields as $field) {
        if ($request->filled($field)) {
            $query->where($field, $request->$field);

            // Tambahkan ke penamaan file
            $activeFilters[] = str_replace('_', ' ', $field) . '_' . $request->$field;
        }
    }

    // AGE RANGE
    if ($request->filled('age_from') || $request->filled('age_to')) {
        $today = Carbon::today();

        if ($request->filled('age_from') && $request->filled('age_to')) {
            $ageFrom = (int) $request->age_from;
            $ageTo   = (int) $request->age_to;
            if ($ageFrom > $ageTo) {
                [$ageFrom, $ageTo] = [$ageTo, $ageFrom];
            }

            $dateOlder   = $today->copy()->subYears($ageTo)->endOfDay();
            $dateYounger = $today->copy()->subYears($ageFrom)->startOfDay();
            $query->whereBetween('tanggal_lahir', [$dateOlder, $dateYounger]);

            $activeFilters[] = "umur_{$ageFrom}_{$ageTo}";
        }
        elseif ($request->filled('age_from')) {
            $dateYounger = $today->copy()->subYears((int)$request->age_from)->startOfDay();
            $query->where('tanggal_lahir', '<=', $dateYounger);

            $activeFilters[] = "umur_min_{$request->age_from}";
        }
        else {
            $dateOlder = $today->copy()->subYears((int)$request->age_to)->endOfDay();
            $query->where('tanggal_lahir', '>=', $dateOlder);

            $activeFilters[] = "umur_max_{$request->age_to}";
        }
    }

    $residents = $query->get();

    // CSV CONTENT
    $csv = "NIK,Nama,Jenis Kelamin,Tanggal Lahir,Tempat Lahir,Status Perkawinan,Agama,Pendidikan,Pekerjaan,Nama Ayah,Nama Ibu,Gol. Darah,No. KK\n";

    foreach ($residents as $resident) {
        $dob = optional($resident->tanggal_lahir)->format('Y-m-d');
        $csv .= "\"{$resident->nik}\",\"{$resident->nama}\",\"{$resident->jenis_kelamin}\",\"{$dob}\",\"{$resident->tempat_lahir}\",\"{$resident->status_perkawinan}\",\"{$resident->agama}\",\"{$resident->pendidikan}\",\"{$resident->pekerjaan}\",\"{$resident->nama_ayah}\",\"{$resident->nama_ibu}\",\"{$resident->golongan_darah}\",\"{$resident->kk->no_kk}\"\n";
    }

    // FILE NAME HANDLER
    $date = date('Y-m-d');

    if (count($activeFilters) === 0 && !$request->filled('search')) {
        $fileName = "data_warga_{$date}.csv";
    } else {
        $filterName = implode('_', $activeFilters);

        if ($request->filled('search')) {
            $filterName = "search_{$request->search}_" . $filterName;
        }

        // Hilangkan karakter tak aman di nama file
        $filterName = preg_replace('/[^A-Za-z0-9_\-]/', '', $filterName);

        $fileName = "data_warga_{$filterName}_{$date}.csv";
    }

    return response($csv)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
}


}
