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
                'nik' => '123',
                'nama' => 'admin',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2004-05-19',
                'alamat' => 'Jl. Marsose K-191',
                'agama' => 'Islam',
                'id_user' => 1,
            ],
            [
                'nik' => '234',
                'nama' => 'admin',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2004-05-19',
                'alamat' => 'Jl. Marsose K-191',
                'agama' => 'Islam',
                'id_user' => 2,
            ],
            [
                'nik' => '345',
                'nama' => 'admin',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2004-05-19',
                'alamat' => 'Jl. Marsose K-191',
                'agama' => 'Islam',
                'id_user' => 3,
            ],
        ];

        DB::table('warga')->insert($wargas);
    }
}
