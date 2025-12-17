<?php

namespace App\Observers;

use App\Models\KK;
use App\Models\ActivityLog;

class KKObserver
{
    /**
     * Handle the KK "created" event.
     */
    public function created(KK $kk): void
    {
        ActivityLog::log(
            action: 'created',
            model: 'KK',
            modelId: $kk->id,
            description: "Menambahkan Kartu Keluarga baru: {$kk->no_kk} - {$kk->alamat}",
            newData: $kk->only(['no_kk', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan'])
        );
    }

    /**
     * Handle the KK "updated" event.
     */
    public function updated(KK $kk): void
    {
        // Ambil data yang berubah
        $changes = $kk->getChanges();
        $original = $kk->getOriginal();

        // Filter field penting
        $importantFields = ['no_kk', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan'];
        $changedFields = array_intersect_key($changes, array_flip($importantFields));

        if (!empty($changedFields)) {
            $description = "Memperbarui Kartu Keluarga: {$kk->no_kk}";
            
            // Tambahkan detail perubahan
            $details = [];
            foreach ($changedFields as $field => $newValue) {
                $oldValue = $original[$field] ?? '-';
                $fieldName = match($field) {
                    'no_kk' => 'No. KK',
                    'alamat' => 'Alamat',
                    'rt' => 'RT',
                    'rw' => 'RW',
                    'kelurahan' => 'Kelurahan',
                    'kecamatan' => 'Kecamatan',
                    default => ucfirst(str_replace('_', ' ', $field))
                };
                $details[] = "{$fieldName}: {$oldValue} → {$newValue}";
            }
            
            if (!empty($details)) {
                $description .= " (" . implode(', ', $details) . ")";
            }

            ActivityLog::log(
                action: 'updated',
                model: 'KK',
                modelId: $kk->id,
                description: $description,
                oldData: array_intersect_key($original, $changedFields),
                newData: $changedFields
            );
        }
    }

    /**
     * Handle the KK "deleted" event.
     */
    public function deleted(KK $kk): void
    {
        ActivityLog::log(
            action: 'deleted',
            model: 'KK',
            modelId: $kk->id,
            description: "Menghapus Kartu Keluarga: {$kk->no_kk} - {$kk->alamat}",
            oldData: $kk->only(['no_kk', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan'])
        );
    }
}