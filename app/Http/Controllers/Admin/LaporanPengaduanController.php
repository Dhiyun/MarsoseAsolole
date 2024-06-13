<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPengaduan;
use Illuminate\Http\Request;

class LaporanPengaduanController extends Controller
{
    public function index($rt)
    {
        $breadcrumb = (object) [
            'title' => 'Data Laporan Pengaduan RT ' . $rt,
            'list' => ['Home,', 'History Laporan Pengaduan']
        ];

        $activeMenu = 'historylaporan';
        $laporansP = LaporanPengaduan::all();

        return view('admin.laporan_pengaduan.history', [
            'rtNumber' => $rt,
            'breadcrumb' => $breadcrumb,
            'laporansP' => $laporansP,
            'activeMenu' => $activeMenu
        ]);
    }
}
