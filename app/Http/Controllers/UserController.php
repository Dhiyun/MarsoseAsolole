<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Users;
use App\Models\Warga;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\NullType;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function laporan()
    {
        return view('user.laporan');
    }
    public function createlaporan()
    {
        return view('user.createlaporan');
    }
    public function surat_keterangan()
    {
        return view('user.surat_keterangan');
    }

    public function surat_pengantar()
    {
        return view('user.surat_pengantar');
    }

    // public function index()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Daftar User',
    //         'list' => ['Home, User']
    //     ];

    //     $activeMenu = 'datauser';
    //     $datauser = Users::all();
    //     $levels = Level::pluck('id_level', 'level_nama');

    //     return view('super-admin.data_user.index', [
    //         'breadcrumb' => $breadcrumb,
    //         'datauser' => $datauser,
    //         'levels' => $levels,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

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
            'username' => 'required|string|min:3|unique:user, username',
            'password' => 'required|string|max:100',
            'id_level' => 'required|exists:level,id_level',
        ]);

        Users::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_level' => $request->id_level,
        ]);

        return redirect('/datauser')->with('success', 'Data User Berhasil Disimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $level = Users::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list'  => ['Home', 'User', 'Edit']
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
            'username' => 'required|min:16|max:16|unique:user,username,' . $id .',id_user',
            'password' => 'nullable|string|max:100',
            'id_level' => 'required|exists:level,id_level',
        ]);

        $user = Users::find($id);
        $warga = Warga::where('id_user', $id)->firstOrFail();
        $level = Level::where('level_nama', 'Warga')->firstOrfail();

        $user->update([
            'username' => $request->username,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'id_level' => $request->id_level,
        ]);

        if($request->id_level != $level->id_level) {
            $request->validate([
                'periode_jabatan_awal' => 'required|date',
                'periode_jabatan_akhir' => 'required|date',
            ]);
            $warga->periode_jabatan_awal = $request->periode_jabatan_awal;
            $warga->periode_jabatan_akhir = $request->periode_jabatan_akhir;
        } else {
            $warga->periode_jabatan_awal = null;
            $warga->periode_jabatan_akhir = null;
        }

        $warga->save();

        return redirect()->route('warga.show', $id)->with('success', 'Data User Berhasil Diubah');
    }

    public function destroy($id)
    {
        $check = Users::find($id);
        if(!$check) {
            return redirect('/level')->with('error'. 'Data User Tidak Ditemukan');
        }

        try{
            Users::destroy($id);

            return redirect('/level')->with('success'. 'Data User Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error'. 'Data User Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');
        
        if (empty($selectedIdsJson)) {
            return redirect('/level')->with('error'. 'Data User Tidak Ditemukan');
        }
        
        $selectedIds = json_decode($selectedIdsJson, true);
        
        try {
            $deletedLevels = Users::whereIn('id_level', $selectedIds)->delete();
            
            if ($deletedLevels > 0) {
                return redirect('/level')->with('success'. 'Semua Data User Berhasil Dihapus');
            } else {
                return redirect('/level')->with('error'. 'Data User Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect('/level')->with('error'. 'Data User Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
