<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\LaporanPengaduan;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Alternatif',
            'list' => ['Home,', 'Alternatif']
        ];

        $activeMenu = 'alternatif';
        $alternatifs = Alternatif::all();
        $juduls = LaporanPengaduan::where('status', 'diterima')->get();

        return view('super-admin.laporan_spk.alternatif.index', [
            'breadcrumb' => $breadcrumb,
            'alternatifs' => $alternatifs,
            'juduls' => $juduls,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode_alternatif' => 'required|max:5',
            'id_laporan' => 'required',
        ]);
        
        Alternatif::create([
            'kode_alternatif' => $validate['kode_alternatif'],
            'id_laporan' => $validate['id_laporan'],
        ]);

        return redirect()->route('alternatif.index')->with('success', 'Laporan pengaduan berhasil ditambahkan');
    }
}
