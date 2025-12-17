<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('action'); // 'created', 'updated', 'deleted'
            $table->string('model'); // 'Resident', 'KK'
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('description'); // Deskripsi singkat
            $table->json('old_data')->nullable(); // Data lama (untuk update/delete)
            $table->json('new_data')->nullable(); // Data baru (untuk create/update)
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};