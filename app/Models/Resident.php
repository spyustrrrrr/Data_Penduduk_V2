<?php

namespace App\Models; // <-- PERBAIKAN NAMESPACE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use App\Models\KK; // <-- PERBAIKAN (MENAMBAHKAN IMPORT KK)

class Resident extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kk_id',
        'nik',
        'nama',
        'foto_ktp',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'status_perkawinan',
        'agama',
        'pekerjaan',
        'pendidikan',
        'no_telepon',
        'email',
        'alamat_sebelumnya',
        'tanggal_pindah',
        'alamat',

        // Bidang baru
        'golongan_darah',
        'status_merokok',
        'nama_ayah',
        'nama_ibu',
        'riwayat_penyakit',
        'cek_kesehatan',
        'asuransi_kesehatan',
        'bpjs_ketenagakerjaan',
        'tambah_anak',
        'jumlah_anak',
        'alat_kontrasepsi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pindah' => 'date',
    ];

    /**
     * Relasi ke model KK.
     */
    public function kk(): BelongsTo
    {
        return $this->belongsTo(KK::class);
    }

    /**
     * Accessor untuk menghitung usia.
     * Akan bisa dipanggil dengan $resident->usia
     */
    protected function usia(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::parse($attributes['tanggal_lahir'])->age,
        );
    }
}