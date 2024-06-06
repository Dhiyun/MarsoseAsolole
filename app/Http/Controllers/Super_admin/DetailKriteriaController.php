<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;;
use App\Models\DetailKriteria;
use App\Models\Kriteria;
use App\Models\LaporanSpk;
use Exception;
use Illuminate\Http\Request;

class DetailKriteriaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Kriteria',
            'list' => ['Home, Kriteria, Detail Kriteria']
        ];

        $activeMenu = 'detail_kriteria';
        $details = DetailKriteria::all();
        $kriterias = Kriteria::all();

        return view('super-admin.detail_kriteria.index', [
            'breadcrumb' => $breadcrumb,
            'details' => $details,
            'kriterias' => $kriterias,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        // Lakukan validasi
        $validate = $request->validate([
            'id_kriteria' => 'required',
            'rentang' => 'required|string|max:255',
            'nilai' => 'required|integer',
            'bobot_normalisasi' => 'required|numeric|between:0,999.99',
        ]);

        // Simpan DetailKriteria dengan data yang telah dimodifikasi
        DetailKriteria::create([
            'id_kriteria' => $validate['id_kriteria'],
            'rentang' => $validate['rentang'],
            'nilai' => $validate['nilai'],
            'bobot_normalisasi' => $validate['bobot_normalisasi'],
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('detail_kriteria.index')->with('success', 'Detail Kriteria berhasil dibuat.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'rentang' => 'required|string|max:255',
            'nilai' => 'required|integer',
            'bobot_normalisasi' => 'required|numeric|between:0,999.99',
        ]);

        $detail = DetailKriteria::findOrFail($id);
        $detail->update($request->all());

        return redirect()->route('super-admin.detail_kriteria.index')->with('success', 'Detail Kriteria updated successfully.');
    }

    public function destroy($id)
    {
        $check = Kriteria::find($id);
        if (!$check) {
            return redirect()->route('kriteria.index')->with('error' . 'Data kriteria Tidak Ditemukan');
        }

        try {
            Kriteria::destroy($id);

            return redirect()->route('kriteria.index')->with('success' . 'Data kriteria Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kriteria.index')->with('error' . 'Data kriteria Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelectedKriteria(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('kriteria.index')->with('error', 'No Kriteria selected for deletion.');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedKriterias = Kriteria::whereIn('id_kriteria', $selectedIds)->delete();

            if ($deletedKriterias > 0) {
                return redirect()->route('kriteria.index')->with('success', 'Selected Kriteria deleted successfully.');
            } else {
                return redirect()->route('kriteria.index')->with('error', 'Failed to delete selected Kriteria due to related records.');
            }
        } catch (Exception $e) {
            return redirect()->route('kriteria.index')->with('error', 'Failed to delete selected Kriteria due to related records.');
        }
    }
}
