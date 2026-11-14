<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $relasi = [
        ['user', 'id_level', 'level', 'id_level'],
        ['warga', 'id_user', 'user', 'id_user'],
        ['rt', 'id_rw', 'rw', 'id_rw'],
        ['kk', 'id_rt', 'rt', 'id_rt'],
        ['laporan_pengaduan', 'id_warga', 'warga', 'id_warga'],
        ['surat', 'id_warga', 'warga', 'id_warga'],
    ];

    public function up(): void
    {
        $this->ubahAturanHapus('restrict');
    }

    public function down(): void
    {
        $this->ubahAturanHapus('cascade');
    }

    private function ubahAturanHapus(string $aturan): void
    {
        foreach ($this->relasi as [$tabel, $kolom, $tabelInduk, $kolomInduk]) {
            Schema::table($tabel, function (Blueprint $table) use ($kolom, $tabelInduk, $kolomInduk, $aturan) {
                $table->dropForeign([$kolom]);
                $table->foreign($kolom)
                    ->references($kolomInduk)
                    ->on($tabelInduk)
                    ->onDelete($aturan)
                    ->onUpdate('cascade');
            });
        }
    }
};
