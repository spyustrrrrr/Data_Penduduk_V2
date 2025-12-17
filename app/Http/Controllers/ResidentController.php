<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\KK;
use App\Models\ActivityLog;
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

        // Filter by age range (umur)
        if ($request->filled('age_from') || $request->filled('age_to')) {
            $today = Carbon::today();

            if ($request->filled('age_from') && $request->filled('age_to')) {
                $ageFrom = (int) $request->age_from;
                $ageTo = (int) $request->age_to;
                if ($ageFrom > $ageTo) {
                    [$ageFrom, $ageTo] = [$ageTo, $ageFrom];
                }

                $dateOlder = $today->copy()->subYears($ageTo)->endOfDay();
                $dateYounger = $today->copy()->subYears($ageFrom)->startOfDay();

                $query->whereBetween('tanggal_lahir', [$dateOlder, $dateYounger]);
            } elseif ($request->filled('age_from')) {
                $ageFrom = (int) $request->age_from;
                $dateYounger = $today->copy()->subYears($ageFrom)->startOfDay();
                $query->where('tanggal_lahir', '<=', $dateYounger);
            } else {
                $ageTo = (int) $request->age_to;
                $dateOlder = $today->copy()->subYears($ageTo)->endOfDay();
                $query->where('tanggal_lahir', '>=', $dateOlder);
            }
        }

        $residents = $query->paginate(10)->appends($request->query());
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
     * Menyimpan penduduk baru ke database dengan auto-create KK jika belum ada.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string',
            'nik' => 'required|string|unique:residents',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah,Janda,Duda',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pendidikan' => 'nullable|in:SD,SMP,SMA/SMK,D1/D2/D3,S1/D4,S2,S3',
            'pekerjaan' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email|unique:residents',
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

        DB::beginTransaction();
        try {
            // Cek apakah No KK sudah ada
            $kk = KK::where('no_kk', $validated['no_kk'])->first();

            // Jika belum ada, buat KK baru TANPA trigger observer
            if (!$kk) {
                // Matikan observer sementara untuk KK
                KK::withoutEvents(function () use ($validated, &$kk) {
                    $kk = KK::create([
                        'no_kk' => $validated['no_kk'],
                        'alamat' => $validated['alamat'],
                        'rt' => $validated['rt'] ?? '00',
                        'rw' => $validated['rw'] ?? '00',
                        'kelurahan' => $validated['kelurahan'] ?? 'Belum Diisi',
                        'kecamatan' => $validated['kecamatan'] ?? 'Belum Diisi',
                    ]);
                });

                // Manual log untuk KK baru
                ActivityLog::log(
                    action: 'created',
                    model: 'KK',
                    modelId: $kk->id,
                    description: "Membuat Kartu Keluarga baru: {$kk->no_kk} (otomatis dari input warga)",
                    newData: $kk->only(['no_kk', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan'])
                );
            }

            // Hapus field yang tidak ada di table residents
            unset($validated['no_kk'], $validated['rt'], $validated['rw'], $validated['kelurahan'], $validated['kecamatan']);

            // Set kk_id
            $validated['kk_id'] = $kk->id;

            // Buat resident baru (observer akan log otomatis)
            Resident::create($validated);

            DB::commit();
            return redirect()->route('residents.index')->with('success', 'Penduduk berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Menampilkan detail data penduduk.
     */
    public function show(Resident $resident)
    {
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
     * Memperbarui data penduduk di database dengan update KK jika diperlukan.
     */
    public function update(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string',
            'nik' => 'required|string|unique:residents,nik,' . $resident->id,
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah,Janda,Duda',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pendidikan' => 'nullable|in:SD,SMP,SMA/SMK,D1/D2/D3,S1/D4,S2,S3',
            'pekerjaan' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email|unique:residents,email,' . $resident->id,
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

        DB::beginTransaction();
        try {
            $oldKkId = $resident->kk_id;

            // Cek apakah No KK sudah ada
            $kk = KK::where('no_kk', $validated['no_kk'])->first();

            // Jika belum ada, buat KK baru TANPA trigger observer
            if (!$kk) {
                KK::withoutEvents(function () use ($validated, &$kk) {
                    $kk = KK::create([
                        'no_kk' => $validated['no_kk'],
                        'alamat' => $validated['alamat'],
                        'rt' => $validated['rt'] ?? '00',
                        'rw' => $validated['rw'] ?? '00',
                        'kelurahan' => $validated['kelurahan'] ?? 'Belum Diisi',
                        'kecamatan' => $validated['kecamatan'] ?? 'Belum Diisi',
                    ]);
                });

                // Manual log
                ActivityLog::log(
                    action: 'created',
                    model: 'KK',
                    modelId: $kk->id,
                    description: "Membuat Kartu Keluarga baru: {$kk->no_kk} (dari pemindahan warga)",
                    newData: $kk->only(['no_kk', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan'])
                );
            } else {
                // Update data KK yang sudah ada (observer akan log otomatis)
                $kk->update([
                    'alamat' => $validated['alamat'],
                    'rt' => $validated['rt'] ?? $kk->rt,
                    'rw' => $validated['rw'] ?? $kk->rw,
                    'kelurahan' => $validated['kelurahan'] ?? $kk->kelurahan,
                    'kecamatan' => $validated['kecamatan'] ?? $kk->kecamatan,
                ]);
            }

            // Hapus field yang tidak ada di table residents
            unset($validated['no_kk'], $validated['rt'], $validated['rw'], $validated['kelurahan'], $validated['kecamatan']);

            // Set kk_id
            $validated['kk_id'] = $kk->id;

            // Update resident (observer akan log otomatis)
            $resident->update($validated);

            // Cek KK lama, jika sudah tidak punya warga, hapus
            if ($oldKkId != $kk->id) {
                $oldKk = KK::find($oldKkId);
                if ($oldKk && $oldKk->residents()->count() == 0) {
                    $oldKk->delete(); // Observer akan log otomatis
                }
            }

            DB::commit();
            return redirect()->route('residents.index')->with('success', 'Penduduk berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Menghapus data penduduk dari database.
     * KK akan otomatis terhapus jika sudah tidak punya warga.
     */
    public function destroy(Resident $resident)
    {
        DB::beginTransaction();
        try {
            $kkId = $resident->kk_id;

            // Hapus resident
            $resident->delete();

            // Cek apakah KK masih punya warga
            $kk = KK::find($kkId);
            if ($kk && $kk->residents()->count() == 0) {
                $kk->delete();
            }

            DB::commit();
            return redirect()->route('residents.index')->with('success', 'Penduduk berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
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

        $activeFilters = [];

        foreach ($filterFields as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->$field);
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

            $filterName = preg_replace('/[^A-Za-z0-9_\-]/', '', $filterName);
            $fileName = "data_warga_{$filterName}_{$date}.csv";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
    }
}