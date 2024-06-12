<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = [];
        $jenis_laporan = [
            'Infrastruktur' => [
                'Kerusakan pipa air PDAM di Jalan Melati',
                'Lampu jalan mati di RW 05',
                'Pengaduan terkait jalan berlubang di Jalan Kenanga',
                'Kerusakan taman kota di RW 01',
                'Trotoar rusak di Jalan Anggrek'
            ],
            'Lingkungan' => [
                'Sampah menumpuk di lingkungan RT 03',
                'Laporan mengenai kebersihan pasar tradisional',
                'Polusi udara di sekitar pabrik',
                'Sungai tercemar di RW 02',
                'Penebangan pohon ilegal di hutan kota'
            ],
            'Keamanan' => [
                'Pengaduan mengenai keamanan lingkungan di RT 02',
                'Pencurian motor di RW 04',
                'Kejadian perampokan di toko kelontong',
                'Patroli keamanan yang tidak rutin',
                'Gangguan preman di pasar'
            ],
            'Layanan Masyarakat' => [
                'Pelayanan kelurahan yang kurang memuaskan',
                'Pengaduan terkait pengurusan KTP yang lambat',
                'Keterlambatan penerbitan akta kelahiran',
                'Proses pembuatan KK yang berbelit-belit',
                'Layanan kesehatan puskesmas yang lambat'
            ],
            'Kesehatan' => [
                'Keluhan terhadap pelayanan kesehatan di puskesmas',
                'Kurangnya tenaga medis di klinik desa',
                'Penyebaran penyakit demam berdarah di RT 01',
                'Ketersediaan obat di apotek kurang',
                'Pelayanan rawat inap di rumah sakit yang buruk'
            ],
        ];
        $keterangan = 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. There are many variations of passages of Lorem Ipsum available';
        $status = ['menunggu', 'ditolak', 'diterima', 'diproses', 'selesai'];

        $image_urls = [
            'https://via.placeholder.com/600'
        ];

        $index = 1;
        foreach ($jenis_laporan as $type => $titles) {
            foreach ($titles as $title) {
                $createdAt = date('Y-m-d H:i:s', strtotime('2023-01-01') + rand(0, 365 * 24 * 60 * 60));
                $laporan[] = [
                    'id_laporan' => $index,
                    'tanggal_proses' => null,
                    'tanggal_selesai' => null,
                    'judul' => $title,
                    'jenis_laporan' => $type,
                    'gambar' => $image_urls[array_rand($image_urls)],
                    'keterangan' => $keterangan,
                    'status' => $status[0],
                    'id_warga' => rand(1, 33),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
                $index++;
            }
        }

        DB::table('laporan_pengaduan')->insert($laporan);
    }
}
