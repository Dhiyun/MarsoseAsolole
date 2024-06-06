<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;;
use Illuminate\Http\Request;
use App\Models\LaporanPengaduan;
use App\Models\Warga;
use App\Models\RW;
use Exception;
use Illuminate\Support\Facades\Auth;

class LaporanPengaduanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Laporan Pengaduan',
            'list' => ['Home,', 'Laporan Pengaduan']
        ];

        $activeMenu = 'laporan';
        $laporansP = LaporanPengaduan::all();

        return view('super-admin.laporan_pengaduan.index', [
            'breadcrumb' => $breadcrumb,
            'laporansP' => $laporansP,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required',
            'jenis_laporan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('gambar'), $imageName);
            $imagePath = 'gambar/' . $imageName;
        }
        
        LaporanPengaduan::create([
            'judul' => $validate['judul'],
            'jenis_laporan' => $validate['jenis_laporan'],
            'gambar' => $imagePath,
            'keterangan' => $validate['keterangan'],
            'status' => 'menunggu',
            'id_warga' => Auth::user()->id_user,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan pengaduan berhasil ditambahkan');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $laporanPengaduan = LaporanPengaduan::findOrFail($id);

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

    public function update_status(Request $request)
    {
        $id_laporan = $request->input('id_laporan');

        $laporanPengaduan = LaporanPengaduan::findOrFail($id_laporan);

        $request->validate([
            'tanggal_proses' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'status' => 'required|in:ditolak,diterima,selesai',
        ]);

        $tanggal_proses = $request->input('tanggal_proses');
        $tanggal_selesai = $request->input('tanggal_selesai');
        
        if($laporanPengaduan->status == 'ditolak') {
            $tanggal_proses = $tanggal_proses ? $tanggal_proses : null;
            $tanggal_selesai = $tanggal_selesai ? $tanggal_selesai : null;
        }
        
        $laporanPengaduan->update([
            'tanggal_proses' => $tanggal_proses,
            'tanggal_selesai' => $tanggal_selesai,
            'status' => $request->input('status')
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan pengaduan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $check = LaporanPengaduan::find($id);
        if(!$check) {
            return redirect()->route('laporan.index')->with('error'. 'Laporan Pengaduan Tidak Ditemukan');
        }

        try{
            LaporanPengaduan::destroy($id);

            return redirect()->route('laporan.index')->with('success'. 'Laporan Pengaduan Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('laporan.index')->with('error'. 'Laporan Pengaduan Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');
        
        if (empty($selectedIdsJson)) {
            return redirect()->route('laporan.index')->with('error'. 'Laporan Pengaduan Tidak Ditemukan');
        }
        
        $selectedIds = json_decode($selectedIdsJson, true);
        
        try {
            $deletedWargas = LaporanPengaduan::whereIn('id_warga', $selectedIds)->delete();
            
            if ($deletedWargas > 0) {
                return redirect()->route('laporan.index')->with('success'. 'Semua Laporan Pengaduan Berhasil Dihapus');
            } else {
                return redirect()->route('laporan.index')->with('error'. 'Laporan Pengaduan Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect()->route('laporan.index')->with('error'. 'Laporan Pengaduan Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
