<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warga = [];
        $usedNames = []; // Array untuk melacak nama yang sudah digunakan
        $maleNames = [
            'Asep Budi', 'Dedi Fajar', 'Hadi Iwan', 'Joko Maman', 'Oman Pipit',
            'Bagas Alex', 'Rio Agung', 'Irfan Hakim', 'Dany Dhika', 'Febrianti Widi',
            'Bambang Seno', 'Aris Pramono', 'Bayu Raharjo', 'Andi Susilo', 'Dimas Eka',
            'Hari Nugroho', 'Wawan Saputra', 'Yoga Prasetyo', 'Zainul Arifin', 'Dian Hidayat',
            'Adit Nugraha', 'Bobby Satria', 'Rian Fadli', 'Teguh Setiawan', 'Yudha Wahyu',
            'Rizki Pangestu', 'Fajar Pratama'
        ];

        $femaleNames = [
            'Cici Euis', 'Gina Lina', 'Nina Rina', 'Susi Caca', 'Dina Novi',
            'Laras Putri', 'Maya Dewi', 'Nanda Ayu', 'Sari Yulia', 'Indah Melati',
            'Fitri Ayu', 'Anita Desi', 'Ratna Rini', 'Sri Ayu', 'Rika Sari',
            'Eva Nur', 'Wulan Sinta', 'Maya Anggraeni', 'Fitriani Dwi', 'Umi Kartika',
            'Lina Wati', 'Nina Lestari', 'Siska Siti', 'Mega Safira', 'Erna Astuti',
            'Yuni Susanti', 'Nita Anggraeni'
        ];

        $places = [
            'Malang', 'Surabaya', 'Kediri', 'Blitar', 'Jember', 'Banyuwangi', 
            'Pasuruan', 'Probolinggo', 'Tulungagung', 'Lumajang', 'Jombang', 'Gresik'
        ];
        $religions = ['Islam', 'Katolik', 'Hindu', 'Budha', 'Kristen', 'Konghucu'];
        $rts = ['01', '02', '03', '04', '05'];
        $genders = ['laki-laki', 'perempuan'];
        $statKelu = ['kepala_keluarga', 'istri', 'anak', 'lainnya'];
        $statPen = ['pendatang', 'asli'];
        $nik = [
            '1234567890123456', '2345678901234567', '3456789012345678', '4567890123456789',
            '5678901234567890', '6789012345678901', '7890123456789012', '8901234567890123',
            '9012345678901234', '0123456789012345', '1234567890123465', '2345678901234576',
            '3456789012345687', '4567890123456798', '5678901234567809', '6789012345678910',
            '7890123456789021', '8901234567890132', '9012345678901243', '0123456789012354',
            '2345678901234687', '3456789012345798', '4567890123456809', '5678901234567910',
            '6789012345678021', '7890123456789132', '8901234567890243', '9012345678901354',
            '5432109876543210', '6543210987654321', '7654321098765432', '8765432109876543',
            '9876543210987654'
        ];

        for ($i = 0; $i < count($nik); $i++) {
            $gender = $genders[array_rand($genders)];
            do {
                $name = $gender == 'laki-laki' ? $maleNames[array_rand($maleNames)] : $femaleNames[array_rand($femaleNames)];
            } while (in_array($name, $usedNames)); // Ulangi sampai menemukan nama yang belum digunakan
            $usedNames[] = $name; // Tandai nama sebagai sudah digunakan

            $dateOfBirth = date('Y-m-d', strtotime('+' . rand(0, 365 * 50) . ' days', strtotime('1970-01-01')));

            // Set RT to be sequential for id_user 2 to 6
            $no_rt = in_array($i + 1, [2, 3, 4, 5, 6]) ? $rts[($i + 1) - 2] : $rts[array_rand($rts)];
            
            // Set status penduduk "asli" untuk id_user 1 sampai 6
            $statusPenduduk = in_array($i + 1, [1, 2, 3, 4, 5, 6]) ? 'asli' : $statPen[array_rand($statPen)];

            $warga[] = [
                'nik' => $nik[$i],
                'nama' => $name,
                'jenis_kelamin' => $gender,
                'tempat_lahir' => $places[array_rand($places)],
                'tanggal_lahir' => $dateOfBirth,
                'alamat' => 'Jl. Marsose K-191 No. ' . rand(1, 300) . ', Kesatrian, Blimbing, Kota Malang',
                'agama' => $religions[array_rand($religions)],
                'no_rt' => $no_rt,
                'status_keluarga' => $statKelu[array_rand($statKelu)],
                'status_kependudukan' => $statusPenduduk,
                'id_user' => $i + 1,
            ];
        }

        DB::table('warga')->insert($warga);
    }
}
