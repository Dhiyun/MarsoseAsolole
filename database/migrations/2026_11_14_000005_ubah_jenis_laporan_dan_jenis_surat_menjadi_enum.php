<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $kolom = [
        ['laporan_pengaduan', 'jenis_laporan', 50, ['Infrastruktur', 'Keamanan', 'Kesehatan', 'Lingkungan', 'Layanan Masyarakat']],
        ['surat', 'jenis_surat', 30, ['Surat Keterangan', 'Surat Pengantar', 'Surat Undangan', 'Surat Pemberitahuan']],
    ];

    public function up(): void
    {
        foreach ($this->kolom as [$tabel, $kolom, $panjang, $pilihan]) {
            $tidakSesuai = DB::table($tabel)
                ->whereNotNull($kolom)
                ->whereNotIn($kolom, $pilihan)
                ->distinct()
                ->pluck($kolom);

            if ($tidakSesuai->isNotEmpty()) {
                throw new RuntimeException("Isi {$tabel}.{$kolom} berikut belum sesuai daftar baku: " . $tidakSesuai->implode(', '));
            }
        }

        foreach ($this->kolom as [$tabel, $kolom, $panjang, $pilihan]) {
            $daftar = collect($pilihan)->map(fn ($nilai) => DB::getPdo()->quote($nilai))->implode(', ');
            DB::statement("ALTER TABLE {$tabel} MODIFY {$kolom} ENUM({$daftar}) NULL");
        }
    }

    public function down(): void
    {
        foreach ($this->kolom as [$tabel, $kolom, $panjang]) {
            DB::statement("ALTER TABLE {$tabel} MODIFY {$kolom} VARCHAR({$panjang}) NULL");
        }
    }
};
