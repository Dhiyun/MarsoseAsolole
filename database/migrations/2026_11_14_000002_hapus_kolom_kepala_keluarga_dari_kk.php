<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kk', function (Blueprint $table) {
            $table->dropColumn('kepala_keluarga');
        });
    }

    public function down(): void
    {
        Schema::table('kk', function (Blueprint $table) {
            $table->string('kepala_keluarga', 100)->nullable()->after('no_kk');
        });

        DB::table('kk')->update([
            'kepala_keluarga' => DB::raw("(SELECT nama FROM warga WHERE warga.id_kk = kk.id_kk AND warga.status_keluarga = 'kepala_keluarga' LIMIT 1)"),
        ]);
    }
};
