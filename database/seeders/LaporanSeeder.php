<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = [];
        $jenis_laporan = ['Infrastruktur', 'Kebersihan', 'Keamanan', 'Pelayanan Masyarakat', 'Kesehatan'];
        $judul = [
            'Kerusakan pipa air PDAM di Jalan Melati',
            'Sampah menumpuk di lingkungan RT 03',
            'Lampu jalan mati di RW 05',
            'Pelayanan kelurahan yang kurang memuaskan',
            'Pengaduan terkait jalan berlubang di Jalan Kenanga',
            'Pengaduan mengenai keamanan lingkungan di RT 02',
            'Laporan mengenai kebersihan pasar tradisional',
            'Keluhan terhadap pelayanan kesehatan di puskesmas',
            'Pengaduan terkait pengurusan KTP yang lambat',
            'Kerusakan taman kota di RW 01'
        ];
        $keterangan = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorem exercitationem voluptatum harum odio culpa, molestias sapiente facilis facere optio maiores dolore necessitatibus neque? ';
        $status = ['menunggu', 'ditolak', 'diterima', 'diproses', 'selesai'];
        $image_urls = [
            'https://via.placeholder.com/150',
            'https://via.placeholder.com/200',
            'https://via.placeholder.com/250',
            'https://via.placeholder.com/300',
            'https://via.placeholder.com/350',
            'https://via.placeholder.com/400',
            'https://via.placeholder.com/450',
            'https://via.placeholder.com/500',
            'https://via.placeholder.com/550',
            'https://via.placeholder.com/600'
        ];
        
        for ($i = 0; $i < 10; $i++) {
            $createdAt = date('Y-m-d H:i:s', strtotime('2024-01-01') + rand(0, 365 * 24 * 60 * 60));

            $laporan[] = [
                'id_laporan' => $i + 1,
                'tanggal_proses' => null,
                'tanggal_selesai' => null,
                'judul' => $judul[$i],
                'jenis_laporan' => $jenis_laporan[array_rand($jenis_laporan)],
                'gambar' => $image_urls[array_rand($image_urls)],
                'keterangan' => $keterangan,
                'status' => $status[0],
                'id_warga' => rand(1, 20),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        DB::table('laporan_pengaduan')->insert($laporan);
    }
}
