<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'nama' => 'superadmin',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2004-05-19',
                'alamat' => 'Jl. Marsose K-191',
                'agama' => 'Islam',
                'no_rt' => 'RT01',
                'status_keluarga' => 'kepala_keluarga',
                'status_kependudukan' => 'asli',
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
                'no_rt' => 'RT01',
                'status_keluarga' => 'kepala_keluarga',
                'status_kependudukan' => 'asli',
                'id_user' => 2,
            ],
            [
                'nik' => '345',
                'nama' => 'warga',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2004-05-19',
                'alamat' => 'Jl. Marsose K-191',
                'agama' => 'Islam',
                'no_rt' => 'RT01',
                'status_keluarga' => 'kepala_keluarga',
                'status_kependudukan' => 'asli',
                'id_user' => 3,
            ],
        ];
        DB::table('warga')->insert($wargas);

        $warga = [];
        $names = [
            'Asep', 'Budi', 'Cici', 'Dedi', 'Euis', 'Fajar', 'Gina', 'Hadi', 
            'Iwan', 'Joko', 'Kiki', 'Lina', 'Maman', 'Nina', 'Oman', 'Pipit', 
            'Qori', 'Rina', 'Susi', 'Toni'
        ];
        $places = [
            'Malang', 'Surabaya', 'Kediri', 'Blitar', 'Jember', 'Banyuwangi', 
            'Pasuruan', 'Probolinggo', 'Madiun', 'Lumajang'
        ];
        $religions = ['Islam', 'Katolik', 'Hindu', 'Budha', 'Kristen', 'Konghucu'];
        $rts = ['01', '02', '03', '04', '05'];
        $genders = ['laki-laki', 'perempuan'];
        $statKelu = ['kepala_keluarga', 'istri', 'anak', 'lainnya'];
        $statPen = ['pendatang', 'asli'];
        
        for ($i = 0; $i <= 26; $i++) {

            $dateOfBirth = date('Y-m-d', strtotime('+' . rand(0, 365 * 50) . ' days', strtotime('1970-01-01')));

            $warga[] = [
                'nik' => Str::random(16, '0123456789'),
                'nama' => $names[array_rand($names)],
                'jenis_kelamin' => $genders[array_rand($genders)],
                'tempat_lahir' => $places[array_rand($places)],
                'tanggal_lahir' => $dateOfBirth,
                'alamat' => 'Jl. Marsose K-191 NO. ' . rand(100, 999),
                'agama' => $religions[array_rand($religions)],
                'no_rt' => $rts[array_rand($rts)],
                'status_keluarga' => $statKelu[array_rand($statKelu)],
                'status_kependudukan' => $statPen[array_rand($statPen)],
                'id_user' => $i + 4,
            ];
        }

        DB::table('warga')->insert($warga);
    }
}
