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
            // Dampak
            ['id_kriteria' => 1, 'rentang' => 'Rendah', 'nilai' => 1, 'bobot_normalisasi' => 0.33],
            ['id_kriteria' => 1, 'rentang' => 'Medium', 'nilai' => 2, 'bobot_normalisasi' => 0.66],
            ['id_kriteria' => 1, 'rentang' => 'Tinggi', 'nilai' => 3, 'bobot_normalisasi' => 1],
            
            // Biaya
            ['id_kriteria' => 2, 'rentang' => '0 - 500000', 'nilai' => 5, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 2, 'rentang' => '> 500000 && <= 1000000', 'nilai' => 4, 'bobot_normalisasi' => 0.8],
            ['id_kriteria' => 2, 'rentang' => '> 1000000 && <= 2000000', 'nilai' => 3, 'bobot_normalisasi' => 0.6],
            ['id_kriteria' => 2, 'rentang' => '> 2000000 && <= 3000000', 'nilai' => 2, 'bobot_normalisasi' => 0.4],
            ['id_kriteria' => 2, 'rentang' => '> 3000000', 'nilai' => 1, 'bobot_normalisasi' => 0.2],


            // Jenis Laporan
            ['id_kriteria' => 3, 'rentang' => 'Infrastruktur', 'nilai' => 3, 'bobot_normalisasi' => 0.6],
            ['id_kriteria' => 3, 'rentang' => 'Keamanan', 'nilai' => 5, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 3, 'rentang' => 'Kesehatan', 'nilai' => 4, 'bobot_normalisasi' => 0.8],
            ['id_kriteria' => 3, 'rentang' => 'Lingkungan', 'nilai' => 1, 'bobot_normalisasi' => 0.2],
            ['id_kriteria' => 3, 'rentang' => 'Layanan Masyarakat', 'nilai' => 2, 'bobot_normalisasi' => 0.4],

            // SDM
            ['id_kriteria' => 4, 'rentang' => '<= 1', 'nilai' => 4, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 4, 'rentang' => '> 1 && <= 5', 'nilai' => 3, 'bobot_normalisasi' => 0.75],
            ['id_kriteria' => 4, 'rentang' => '> 5 && <= 10', 'nilai' => 2, 'bobot_normalisasi' => 0.5],
            ['id_kriteria' => 4, 'rentang' => '> 10', 'nilai' => 1, 'bobot_normalisasi' => 0.25],
            
            // Durasi Pekerjaan
            ['id_kriteria' => 5, 'rentang' => '< 7 hari', 'nilai' => 4, 'bobot_normalisasi' => 1],
            ['id_kriteria' => 5, 'rentang' => '> 7 && <= 14 hari', 'nilai' => 3, 'bobot_normalisasi' => 0.75],
            ['id_kriteria' => 5, 'rentang' => '> 14 hari && <= 30 hari', 'nilai' => 2, 'bobot_normalisasi' => 0.5],
            ['id_kriteria' => 5, 'rentang' => '> 30 hari', 'nilai' => 1, 'bobot_normalisasi' => 0.25],

        ];

        DB::table('detail_kriterias')->insert($details);
    }
}
