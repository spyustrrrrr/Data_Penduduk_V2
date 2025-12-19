<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KK extends Model
{
    protected $table = 'kks';

    protected $fillable = [
        'no_kk',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
    ];

    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class, 'kk_id');
    }
}
