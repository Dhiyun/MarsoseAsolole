<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->unsignedBigInteger('id_warga');
            $table->unsignedBigInteger('id_level');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->timestamps();

            $table->index(['id_warga', 'periode_awal']);
            $table->foreign('id_warga')
                ->references('id_warga')
                ->on('warga')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_level')
                ->references('id_level')
                ->on('level')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        DB::statement("
            INSERT INTO jabatan (id_warga, id_level, periode_awal, periode_akhir, created_at, updated_at)
            SELECT warga.id_warga, user.id_level, warga.periode_jabatan_awal,
                   COALESCE(warga.periode_jabatan_akhir, warga.periode_jabatan_awal), NOW(), NOW()
            FROM warga
            JOIN user ON user.id_user = warga.id_user
            JOIN level ON level.id_level = user.id_level
            WHERE warga.periode_jabatan_awal IS NOT NULL
              AND level.level_kode <> 'WRG'
        ");

        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn(['periode_jabatan_awal', 'periode_jabatan_akhir']);
        });
    }

    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->date('periode_jabatan_awal')->nullable()->after('status_kependudukan');
            $table->date('periode_jabatan_akhir')->nullable()->after('periode_jabatan_awal');
        });

        DB::statement("
            UPDATE warga
            JOIN jabatan ON jabatan.id_jabatan = (
                SELECT j.id_jabatan FROM jabatan j
                WHERE j.id_warga = warga.id_warga
                ORDER BY j.periode_awal DESC
                LIMIT 1
            )
            SET warga.periode_jabatan_awal = jabatan.periode_awal,
                warga.periode_jabatan_akhir = jabatan.periode_akhir
        ");

        Schema::dropIfExists('jabatan');
    }
};
