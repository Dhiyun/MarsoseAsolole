<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tanpaRt = DB::table('warga')
            ->leftJoin('kk', 'kk.id_kk', '=', 'warga.id_kk')
            ->leftJoin('rt', 'rt.no_rt', '=', DB::raw("LPAD(warga.no_rt, 2, '0')"))
            ->whereNull('kk.id_rt')
            ->whereNull('rt.id_rt')
            ->pluck('warga.nik');

        if ($tanpaRt->isNotEmpty()) {
            throw new RuntimeException('RT warga berikut tidak dikenali, perbaiki dulu kolom no_rt-nya: ' . $tanpaRt->implode(', '));
        }

        Schema::table('warga', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rt')->nullable()->after('agama');
        });

        DB::statement("
            UPDATE warga
            LEFT JOIN kk ON kk.id_kk = warga.id_kk
            LEFT JOIN rt ON rt.no_rt = LPAD(warga.no_rt, 2, '0')
            SET warga.id_rt = COALESCE(kk.id_rt, rt.id_rt)
        ");

        DB::statement('ALTER TABLE warga MODIFY id_rt BIGINT UNSIGNED NOT NULL');

        Schema::table('warga', function (Blueprint $table) {
            $table->foreign('id_rt')
                ->references('id_rt')
                ->on('rt')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->dropColumn('no_rt');
        });
    }

    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->string('no_rt', 4)->nullable()->after('agama');
        });

        DB::statement('UPDATE warga JOIN rt ON rt.id_rt = warga.id_rt SET warga.no_rt = rt.no_rt');

        Schema::table('warga', function (Blueprint $table) {
            $table->dropForeign(['id_rt']);
            $table->dropColumn('id_rt');
        });
    }
};
