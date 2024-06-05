<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Exception;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kriteria',
            'list' => ['Home, Kriteria']
        ];

        $activeMenu = 'kriteria';
        $kriterias = Kriteria::all();

        return view('super-admin.kriteria.index', [
            'breadcrumb' => $breadcrumb,
            'kriterias' => $kriterias,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'jenis_kriteria' => 'required|string|max:255',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria created successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'jenis_kriteria' => 'required|string|max:255',
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($data);

        return redirect()->route('kriteria.index');
    }

    public function destroy($id)
    {
        $check = Kriteria::find($id);
        if(!$check) {
            return redirect()->route('kriteria.index')->with('error'. 'Data kriteria Tidak Ditemukan');
        }

        try{
            Kriteria::destroy($id);

            return redirect()->route('kriteria.index')->with('success'. 'Data kriteria Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kriteria.index')->with('error'. 'Data kriteria Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
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
