<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KK;
use App\Models\Level;
use App\Models\RW;
use App\Models\RT;
use App\Models\Users;
use App\Models\Warga;
use Exception;
use Illuminate\Support\Facades\Hash;

class KKController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar KK',
            'list' => ['Home, Data KK']
        ];

        $activeMenu = 'datakk';
        $kks = KK::all();
        $rts = RT::all();

        return view('super-admin.data_kk.index', [
            'breadcrumb' => $breadcrumb,
            'kks' => $kks,
            'rts' => $rts,
            'activeMenu' => $activeMenu
        ]);
    }

    public function cek_rt()
    {
        $RTResult = RT::select('no_rt')->get();
    
        if ($RTResult) {
            return response()->json(['rts' => $RTResult]);
        } else {
            return response()->json(['error' => 'No RT not found'], 404);
        }
    }

    public function cek_kk()
    {
        $KKResult =KK::select('no_kk')->get();
    
        if ($KKResult) {
            return response()->json(['kks' => $KKResult]);
        } else {
            return response()->json(['error' => 'No KK not found'], 404);
        }
    }

    public function show($id)
    {
        $kk = KK::findOrFail($id);
        $wargas = Warga::where('id_kk', $kk->id_kk)->get();

        $breadcrumb = (object) [
            'title' => 'Detail KK',
            'list' => ['Home', 'Data KK', 'Detail KK - ' . $kk->no_kk]
        ];
    
        $activeMenu = 'datakk';
    
        return view('super-admin.data_kk.detail', [
            'breadcrumb' => $breadcrumb,
            'kk' => $kk,
            'wargas' => $wargas,
            'activeMenu' => $activeMenu
        ]);
    }

    public function show_warga($id_kk, $id)
    {
        $kk = KK::findOrFail($id_kk);
        $warga = Warga::where('id_kk', $kk->id_kk)
        ->findOrFail($id);
        $level = Level::all();

        $breadcrumb = (object) [
            'title' => 'Detail KK',
            'list' => ['Home', 'Data KK', 'Detail KK - ' . $kk->no_kk, 'Data Warga', 'Detail Warga - ' . $warga->nik]
        ];
    
        $activeMenu = 'datakk';
    
        return view('super-admin.data_kk.detail_warga.detail', [
            'breadcrumb' => $breadcrumb,
            'kk' => $kk,
            'level' => $level,
            'warga' => $warga,
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
            'no_kk' => 'required|unique:kk',
            'kepala_keluarga' => 'required',
            'alamat' => 'required',
            'no_rt' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
        ]);

        $no_rt = $validate['no_rt'];

        $rt = RT::where('no_rt', $no_rt)->first();

        if($rt){
            $id_rt = $rt->id_rt;
        }

        $level = Level::whereIn('level_nama', ['Warga', 'warga'])->firstOrFail();

        $user = Users::firstOrCreate(
            ['username' => $validate['nik']],
            [
                'password' => Hash::make($validate['nik']),
                'id_level' => $level->id_level,
            ]
        );

        $kk = KK::create([
            'no_kk' => $validate['no_kk'],
            'kepala_keluarga' => $validate['kepala_keluarga'],
            'alamat' => $validate['alamat'],
            'id_rt' => $id_rt,
        ]);

        Warga::updateOrCreate(
            ['nik' => $validate['nik']],
            [
                'nama' => $validate['kepala_keluarga'],
                'jenis_kelamin' => $validate['jenis_kelamin'],
                'tempat_lahir' => $validate['tempat_lahir'],
                'tanggal_lahir' => $validate['tanggal_lahir'],
                'agama' => $validate['agama'],
                'alamat' => $validate['alamat'],
                'no_rt' => $no_rt,
                'id_user' => $user->id_user,
                'id_kk' => $kk->id_kk,
            ]
        );
        
        return redirect()->route('kk.index')->with('success', 'Data KK Berhasil Disimpan');
    }

    public function store_warga($id, Request $request)
    {
        $validate = $request->validate([
            'nik' => 'required|unique:warga,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
        ]);

        $kk = KK::findOrFail($id);
        
        $level = Level::whereIn('level_nama', ['Warga', 'warga'])->firstOrFail();

        $user = Users::firstOrCreate(
            ['username' => $validate['nik']],
            [
                'password' => Hash::make($validate['nik']),
                'id_level' => $level->id_level,
            ]
        );

        Warga::create([
            'nik' => $validate['nik'],
            'nama' => $validate['nama'],
            'jenis_kelamin' => $validate['jenis_kelamin'],
            'tempat_lahir' => $validate['tempat_lahir'],
            'tanggal_lahir' => $validate['tanggal_lahir'],
            'agama' => $validate['agama'],
            'alamat' => $kk->alamat,
            'id_user' => $user->id_user,
            'id_kk' => $kk->id_kk,
        ]);

        return redirect()->route('kk.show', $id)->with('success', 'Warga berhasil ditambahkan');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kk' => 'required|unique:kk,no_kk,' . $id .',id_kk',
            'kepala_keluarga' => 'required',
            'alamat' => 'required',
            'no_rt' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
        ]);
        
        $no_rt = $request->no_rt;

        $rt = RT::where('no_rt', $no_rt)->first();

        if($rt){
            $id_rt = $rt->id_rt;
        }

        $kk = KK::findOrFail($id)->update([
            'no_kk' => $request->no_kk,
            'kepala_keluarga' => $request->kepala_keluarga,
            'alamat' => $request->alamat,
            'id_rt' => $id_rt,
        ]);

        $warga = Warga::where('id_kk', $id)->first();

        if($warga){
            $warga->update([
                'nama' => $request->kepala_keluarga,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'no_rt' => $no_rt,
            ]);
        }

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil diperbarui');
    }

    public function destroy($No_KK)
    {
        $dataKK = KK::findOrFail($No_KK);
        $dataKK->delete();
        return redirect()->route('data_kk.index')->with('success', 'Data KK berhasil dihapus');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');
        
        if (empty($selectedIdsJson)) {
           return redirect()->route('data_kk.index')->with('error'. 'Data Warga Tidak Ditemukan');
        }
        
        $selectedIds = json_decode($selectedIdsJson, true);
        
        try {
            $deletedKKs = KK::whereIn('id_kk', $selectedIds)->delete();
            
            if ($deletedKKs > 0) {
                return redirect()->route('data_kk.index')->with('success'. 'Semua Data Warga Berhasil Dihapus');
            } else {
                return redirect()->route('data_kk.index')->with('error'. 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect()->route('data_kk.index')->with('error'. 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
