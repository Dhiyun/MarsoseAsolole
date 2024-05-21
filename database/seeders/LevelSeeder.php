<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'level_kode' => 'RW',
                'level_nama' => 'RW',
            ],
            [
                'level_kode' => 'RT1',
                'level_nama' => 'RT1',
            ],
            [
                'level_kode' => 'RT2',
                'level_nama' => 'RT2',
            ],
            [
                'level_kode' => 'RT3',
                'level_nama' => 'RT3',
            ],
            [
                'level_kode' => 'RT4',
                'level_nama' => 'RT4',
            ],
            [
                'level_kode' => 'RT5',
                'level_nama' => 'RT5',
            ],
            [
                'level_kode' => 'WRG',
                'level_nama' => 'Warga',
            ],
        ];

        DB::table('level')->insert($levels);
    }
}
