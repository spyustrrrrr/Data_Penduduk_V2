<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resident extends Model
{
    protected $fillable = [
        'kk_id',
        'nik',
        'nama',
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
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pindah' => 'date',
    ];

    public function kk(): BelongsTo
    {
        return $this->belongsTo(KK::class);
    }
}
