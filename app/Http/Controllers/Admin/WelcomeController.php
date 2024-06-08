<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPengaduan;
use App\Models\RT;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index($rt)
    {
        $breadcrumb = (object) [
            'title' => 'Home',
            'list' => ['Dashboard']
        ];

        $activeMenu = 'dashboard';
        // $user = Auth::user();

        if (Auth::check()) {
            $user = Auth::user();

            // Menghitung total id_laporan di tabel laporan_pengaduan
            $totalLaporan = LaporanPengaduan::count();

            // Menghitung total id_laporan di tabel Warga
            $totalWarga = Warga::count();

            // Menghitung total id_laporan di tabel laporan_pengaduan
            $totalRT = RT::count();

            $rejectedLaporan = LaporanPengaduan::where('status', 'ditolak')->count();

            return view('admin.welcome', [
                'rtNumber' => $rt,
                'user' => $user,
                'breadcrumb' => $breadcrumb,
                'activeMenu' => $activeMenu,
                'totalLaporan' => $totalLaporan,
                'totalWarga' => $totalWarga,
                'totalRT' => $totalRT,
                'rejectedLaporan' => $rejectedLaporan,
            ]);
        } else {
            return redirect()->route('login');
        }
    }
}
