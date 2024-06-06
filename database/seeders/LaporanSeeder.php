<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $laporans = [
            [
                'id_laporan' => 1,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Infratruktur',
                'gambar' => 'path/to/image.jpg',
                'keterangan' => 'Kerusakan pipa air PDAM di Jalan Melati',
                'status' => 'menunggu',
                'id_warga' => 5,
            ],
            [
                'id_laporan' => 2,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Keamanan',
                'gambar' => 'path/to/image.jpg',
                'keterangan' => 'Gangguan suara dari tempat hiburan malam di Jalan Mawar',
                'status' => 'menunggu',
                'id_warga' => 8,
            ],
            [
                'id_laporan' => 3,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Lingkungan',  // Change jenis_laporan and keterangan for variety
                'gambar' => 'path/to/image2.jpg',
                'keterangan' => 'Penumpukan sampah di area perumahan',
                'status' => 'menunggu',
                'id_warga' => 7,
            ],
            [
                'id_laporan' => 4,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Keamanan',
                'gambar' => 'path/to/image3.jpg',
                'keterangan' => 'Laporan lampu jalan mati di persimpangan',
                'status' => 'menunggu',
                'id_warga' => 6,
            ],
            [
                'id_laporan' => 5,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Layanan Masyarakat',
                'gambar' => 'path/to/image4.jpg',
                'keterangan' => 'Taman bermain anak rusak di Taman Melati',
                'status' => 'menunggu',
                'id_warga' => 1,
            ],
            [
                'id_laporan' => 6,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Lingkungan',
                'gambar' => 'path/to/image5.jpg',
                'keterangan' => 'Saluran air di Jalan Mawar tersumbat',
                'status' => 'menunggu',
                'id_warga' => 8,
            ],
            [
                'id_laporan' => 7,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Keamanan', // Change jenis_laporan and keterangan for variety
                'gambar' => 'path/to/image6.jpg',
                'keterangan' => 'Pos ronda di Jalan Melati tidak ada petugasnya',
                'status' => 'menunggu',
                'id_warga' => 6,
            ],
            [
                'id_laporan' => 8,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Infrastruktur',
                'gambar' => 'path/to/image7.jpg',
                'keterangan' => 'Jalan berlubang di Jalan Mawar',
                'status' => 'menunggu',
                'id_warga' => 19,
            ],
            [
                'id_laporan' => 9,
                'tanggal_proses' => '2024-06-04',
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Infrastruktur',
                'gambar' => 'path/to/image8.jpg',
                'keterangan' => 'Kerusakan lampu penerangan jalan di Jalan Melati',
                'status' => 'diterima',
                'id_warga' => 20,
            ],
            [
                'id_laporan' => 10,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'jenis_laporan' => 'Infrastruktur',
                'gambar' => 'path/to/image8.jpg',
                'keterangan' => 'Kerusakan lampu penerangan jalan di Jalan Melati',
                'status' => 'menunggu',
                'id_warga' => 12,
            ],

        ];

        DB::table('laporan_pengaduan')->insert($laporans);
    }
}
