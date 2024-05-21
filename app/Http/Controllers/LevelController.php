<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home, Level']
        ];

        $activeMenu = 'level';
        $level = Level::all();

        return view('super-admin.level.index', [
            'breadcrumb' => $breadcrumb,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
       //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        Level::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data Level Berhasil Disimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $level = Level::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list'  => ['Home', 'Level', 'Edit']
        ];

        $activeMenu = 'level';

        return view('super-admin.level.edit', [
            'breadcrumb' => $breadcrumb,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100',
        ]);

        Level::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data Level Berhasil Diubah');
    }

    public function destroy($id)
    {
        $check = Level::find($id);
        if(!$check) {
            return redirect('/level')->with('error'. 'Data Level Tidak Ditemukan');
        }

        try{
            Level::destroy($id);

            return redirect('/level')->with('success'. 'Data Level Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error'. 'Data Level Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');
        
        if (empty($selectedIdsJson)) {
            return redirect('/level')->with('error'. 'Data Level Tidak Ditemukan');
        }
        
        $selectedIds = json_decode($selectedIdsJson, true);
        
        try {
            $deletedLevels = Level::whereIn('id_level', $selectedIds)->delete();
            
            if ($deletedLevels > 0) {
                return redirect('/level')->with('success'. 'Semua Data Level Berhasil Dihapus');
            } else {
                return redirect('/level')->with('error'. 'Data Level Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect('/level')->with('error'. 'Data Level Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
