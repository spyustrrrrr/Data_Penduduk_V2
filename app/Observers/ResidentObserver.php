<?php

namespace App\Observers;

use App\Models\Resident;
use App\Models\ActivityLog;

class ResidentObserver
{
    /**
     * Handle the Resident "created" event.
     */
    public function created(Resident $resident): void
    {
        $kkInfo = $resident->kk ? " di KK {$resident->kk->no_kk}" : "";
        
        ActivityLog::log(
            action: 'created',
            model: 'Resident',
            modelId: $resident->id,
            description: "Menambahkan data warga: {$resident->nama} (NIK: {$resident->nik}){$kkInfo}",
            newData: $resident->only(['nama', 'nik', 'jenis_kelamin', 'alamat', 'kk_id'])
        );
    }

    /**
     * Handle the Resident "updated" event.
     */
    public function updated(Resident $resident): void
    {
        // Ambil data yang berubah
        $changes = $resident->getChanges();
        $original = $resident->getOriginal();

        // Filter hanya field penting
        $importantFields = ['nama', 'nik', 'alamat', 'jenis_kelamin', 'status_perkawinan', 'pekerjaan'];
        $changedFields = array_intersect_key($changes, array_flip($importantFields));

        if (!empty($changedFields)) {
            $description = "Memperbarui data warga: {$resident->nama}";
            
            // Tambahkan detail perubahan
            $details = [];
            foreach ($changedFields as $field => $newValue) {
                $oldValue = $original[$field] ?? '-';
                $details[] = ucfirst(str_replace('_', ' ', $field)) . ": {$oldValue} → {$newValue}";
            }
            
            if (!empty($details)) {
                $description .= " (" . implode(', ', $details) . ")";
            }

            ActivityLog::log(
                action: 'updated',
                model: 'Resident',
                modelId: $resident->id,
                description: $description,
                oldData: array_intersect_key($original, $changedFields),
                newData: $changedFields
            );
        }
    }

    /**
     * Handle the Resident "deleted" event.
     */
    public function deleted(Resident $resident): void
    {
        ActivityLog::log(
            action: 'deleted',
            model: 'Resident',
            modelId: $resident->id,
            description: "Menghapus data warga: {$resident->nama} (NIK: {$resident->nik})",
            oldData: $resident->only(['nama', 'nik', 'jenis_kelamin', 'alamat'])
        );
    }
}