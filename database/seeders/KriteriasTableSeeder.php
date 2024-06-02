<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriterias')->insert([
            ['nama_kriteria' => 'Dampak', 'jenis_kriteria' => 'Benefit'],
            ['nama_kriteria' => 'Biaya', 'jenis_kriteria' => 'Cost'],
            ['nama_kriteria' => 'Jenis Laporan', 'jenis_kriteria' => 'Benefit'],
            ['nama_kriteria' => 'SDM', 'jenis_kriteria' => 'Cost'],
            ['nama_kriteria' => 'Durasi Pekerjaan', 'jenis_kriteria' => 'Cost'],
        ]);
    }
}
