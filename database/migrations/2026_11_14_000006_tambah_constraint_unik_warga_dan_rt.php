<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $akunGanda = DB::table('warga')
            ->select('id_user')
            ->groupBy('id_user')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('id_user');

        if ($akunGanda->isNotEmpty()) {
            throw new RuntimeException('Akun berikut dipakai lebih dari satu warga, rapikan dulu: id_user ' . $akunGanda->implode(', '));
        }

        Schema::table('warga', function (Blueprint $table) {
            $table->unique('id_user');
            $table->dropIndex(['id_user']);
        });

        Schema::table('rt', function (Blueprint $table) {
            $table->unique(['id_rw', 'no_rt']);
            $table->dropUnique(['no_rt']);
        });
    }

    public function down(): void
    {
        Schema::table('rt', function (Blueprint $table) {
            $table->unique('no_rt');
            $table->dropUnique(['id_rw', 'no_rt']);
        });

        Schema::table('warga', function (Blueprint $table) {
            $table->index('id_user');
            $table->dropUnique(['id_user']);
        });
    }
};
