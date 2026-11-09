<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menyelaraskan struktur tabel dengan model, controller, dan laporan (Bab 4).
 * Aman dijalankan di database lama maupun baru: setiap langkah dicek dulu.
 */
return new class extends Migration
{
    public function up(): void
    {
        // 1. pengguna: kolom "nama" menjadi "nama_pengguna"
        if (Schema::hasColumn('pengguna', 'nama') && ! Schema::hasColumn('pengguna', 'nama_pengguna')) {
            Schema::table('pengguna', function (Blueprint $table) {
                $table->renameColumn('nama', 'nama_pengguna');
            });
        }

        // 2. mata_kuliah: kolom "nama_mata_kuliah" menjadi "nama_matkul"
        if (Schema::hasColumn('mata_kuliah', 'nama_mata_kuliah') && ! Schema::hasColumn('mata_kuliah', 'nama_matkul')) {
            Schema::table('mata_kuliah', function (Blueprint $table) {
                $table->renameColumn('nama_mata_kuliah', 'nama_matkul');
            });
        }

        // 3. tugas: kolom nama_tugas dihapus
        if (Schema::hasColumn('tugas', 'nama_tugas')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->dropColumn('nama_tugas');
            });
        }

        // 4. tugas: kolom relasi ke pengguna dan mata_kuliah
        if (! Schema::hasColumn('tugas', 'pengguna_id')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->foreignId('pengguna_id')->nullable()->after('id')
                    ->constrained('pengguna')->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('tugas', 'mata_kuliah_id')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->foreignId('mata_kuliah_id')->nullable()->after('pengguna_id')
                    ->constrained('mata_kuliah')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Sengaja kosong: migrasi ini hanya menyelaraskan struktur.
    }
};