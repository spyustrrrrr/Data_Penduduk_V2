<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('residents', function (Blueprint $table) {
        // Menambahkan kolom foto_ktp yang boleh kosong (nullable)
        $table->string('foto_ktp')->nullable()->after('alamat');
    });
}

public function down(): void
{
    Schema::table('residents', function (Blueprint $table) {
        $table->dropColumn('foto_ktp');
    });
}
};
