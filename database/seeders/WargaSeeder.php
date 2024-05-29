<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wargas = [
            [
                'nik' => 'admin',
                'nama' => 'admin',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2004-05-19',
                'alamat' => 'Jl. Marsose K-191',
                'agama' => 'Islam',
                'id_user' => 1,
            ],
        ];

        DB::table('warga')->insert($wargas);
    }
}
