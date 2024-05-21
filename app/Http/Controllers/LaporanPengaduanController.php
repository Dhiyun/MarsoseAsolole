<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPengaduan;
use App\Models\Warga;
use App\Models\RW;

class LaporanPengaduanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Laporan',
            'list' => ['Laporan Pengaduan']
        ];

        $activeMenu = 'laporan';
        $laporanP = LaporanPengaduan::all();

        return view('super-admin.laporan_pengaduan.index', [
            'breadcrumb' => $breadcrumb,
            'laporanP' => $laporanP,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        $warga = Warga::all();
        $rw = RW::all();
        return view('laporan_pengaduan.create', compact('warga', 'rw'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_laporan' => 'nullable',
            'jenis_laporan' => 'nullable',
            'gambar' => 'nullable',
            'keterangan' => 'nullable',
            'status' => 'nullable',
            'NIK' => 'nullable',
            'No_RW' => 'nullable',
        ]);

        LaporanPengaduan::create($request->all());
        return redirect()->route('laporan_pengaduan.index')->with('success', 'Laporan pengaduan berhasil ditambahkan');
    }

    public function edit($ID_Laporan)
    {
        $laporanPengaduan = LaporanPengaduan::findOrFail($ID_Laporan);
        $warga = Warga::all();
        $rw = RW::all();
        return view('laporan_pengaduan.edit', compact('laporanPengaduan', 'warga', 'rw'));
    }

    public function update(Request $request, $ID_Laporan)
    {
        $laporanPengaduan = LaporanPengaduan::findOrFail($ID_Laporan);

        $request->validate([
            'tanggal_laporan' => 'nullable',
            'jenis_laporan' => 'nullable',
            'gambar' => 'nullable',
            'keterangan' => 'nullable',
            'status' => 'nullable|in:ditolak,diterima,selesai',
            'NIK' => 'nullable',
            'No_RW' => 'nullable',
        ]);

        $laporanPengaduan->update($request->all());
        return redirect()->route('laporan_pengaduan.index')->with('success', 'Laporan pengaduan berhasil diperbarui');
    }

    public function destroy($ID_Laporan)
    {
        $laporanPengaduan = LaporanPengaduan::findOrFail($ID_Laporan);
        $laporanPengaduan->delete();
        return redirect()->route('laporan_pengaduan.index')->with('success', 'Laporan pengaduan berhasil dihapus');
    }
}
