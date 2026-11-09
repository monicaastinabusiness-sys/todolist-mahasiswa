<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->foreignId('pengguna_id')
                ->nullable()
                ->after('id')
                ->constrained('pengguna')
                ->nullOnDelete();

            $table->foreignId('mata_kuliah_id')
                ->nullable()
                ->after('pengguna_id')
                ->constrained('mata_kuliah')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['pengguna_id']);
            $table->dropForeign(['mata_kuliah_id']);

            $table->dropColumn([
                'pengguna_id',
                'mata_kuliah_id',
            ]);
        });
    }
};
