<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\LaporanPengaduan;
use Exception;
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
        $juduls = LaporanPengaduan::where('status', 'diterima')
            ->whereNotIn('id_laporan', Alternatif::pluck('id_laporan'))
            ->get();

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

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'kode_alternatif' => 'required|max:5',
            'id_laporan' => 'required',
        ]);

        $alternatif = Alternatif::findOrFail($id);
        $alternatif->kode_alternatif = $validate['kode_alternatif'];
        $alternatif->id_laporan = $validate['id_laporan'];
        $alternatif->save();

        return redirect()->route('alternatif.index')->with('success', 'Laporan pengaduan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $check = Alternatif::find($id);
        if (!$check) {
            return redirect()->route('alternatif.index')->with('error' . 'Data kriteria Tidak Ditemukan');
        }

        try {
            Alternatif::destroy($id);

            return redirect()->route('alternatif.index')->with('success' . 'Data kriteria Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('alternatif.index')->with('error' . 'Data kriteria Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelectedKriteria(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('alternatif.index')->with('error', 'No Alternatif selected for deletion.');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedKriterias = Alternatif::whereIn('id_alternatif', $selectedIds)->delete();

            if ($deletedKriterias > 0) {
                return redirect()->route('alternatif.index')->with('success', 'Selected Alternatif deleted successfully.');
            } else {
                return redirect()->route('alternatif.index')->with('error', 'Failed to delete selected Alternatif due to related records.');
            }
        } catch (Exception $e) {
            return redirect()->route('alternatif.index')->with('error', 'Failed to delete selected Alternatif due to related records.');
        }
    }
}
