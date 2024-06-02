<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $details = [
            // Biaya
            ['id_kriteria' => 1, 'rentang' => '0 - 500.000', 'nilai' => 5, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 1, 'rentang' => '> 500.000 && <= 1.000.000', 'nilai' => 4, 'bobot_normalisasi' => 0.8],
            ['id_kriteria' => 1, 'rentang' => '> 1.000.000 && <= 2.000.000', 'nilai' => 3, 'bobot_normalisasi' => 0.6],
            ['id_kriteria' => 1, 'rentang' => '> 2.000.000 && <= 3.000.000', 'nilai' => 2, 'bobot_normalisasi' => 0.4],
            ['id_kriteria' => 1, 'rentang' => '> 3.000.000', 'nilai' => 1, 'bobot_normalisasi' => 0.2],

            // Dampak
            ['id_kriteria' => 2, 'rentang' => 'Rendah', 'nilai' => 1, 'bobot_normalisasi' => 0.33],
            ['id_kriteria' => 2, 'rentang' => 'Medium', 'nilai' => 2, 'bobot_normalisasi' => 0.66],
            ['id_kriteria' => 2, 'rentang' => 'Tinggi', 'nilai' => 3, 'bobot_normalisasi' => 1],

            // Jenis Laporan
            ['id_kriteria' => 3, 'rentang' => 'Infrastruktur', 'nilai' => 3, 'bobot_normalisasi' => 0.6],
            ['id_kriteria' => 3, 'rentang' => 'Keamanan', 'nilai' => 5, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 3, 'rentang' => 'Kesehatan', 'nilai' => 4, 'bobot_normalisasi' => 0.8],
            ['id_kriteria' => 3, 'rentang' => 'Lingkungan', 'nilai' => 1, 'bobot_normalisasi' => 0.2],
            ['id_kriteria' => 3, 'rentang' => 'Layanan Masyarakat', 'nilai' => 2, 'bobot_normalisasi' => 0.4],

            // Durasi Pekerjaan
            ['id_kriteria' => 4, 'rentang' => '1 - 7 hari', 'nilai' => 4, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 4, 'rentang' => '> 7 - 14 hari', 'nilai' => 3, 'bobot_normalisasi' => 0.75],
            ['id_kriteria' => 4, 'rentang' => '>14 hari - 1 bulan', 'nilai' => 2, 'bobot_normalisasi' => 0.5],
            ['id_kriteria' => 4, 'rentang' => '> 1 bulan', 'nilai' => 1, 'bobot_normalisasi' => 0.25],

            // SDM
            ['id_kriteria' => 5, 'rentang' => '1', 'nilai' => 4, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 5, 'rentang' => '> 1 && <= 5', 'nilai' => 3, 'bobot_normalisasi' => 0.75],
            ['id_kriteria' => 5, 'rentang' => '> 5 && <= 10', 'nilai' => 2, 'bobot_normalisasi' => 0.5],
            ['id_kriteria' => 5, 'rentang' => '>10', 'nilai' => 1, 'bobot_normalisasi' => 0.25],
        ];

        DB::table('detail_kriterias')->insert($details);
    }
}
