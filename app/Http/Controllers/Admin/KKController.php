<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KK;
use App\Models\Level;
use App\Models\RT;
use App\Models\Users;
use App\Models\Warga;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KKController extends Controller
{
    public function index($no_rt)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar KK',
            'list' => ['Home, Data KK']
        ];

        $activeMenu = 'datakk';

        $rt = '0'.$no_rt;
        $rts = RT::all();

        $kks = KK::join('rt', 'kk.id_rt', '=', 'rt.id_rt')
        ->where('rt.no_rt', $rt)
        ->get();
        
        return view('admin.data_kk.index', [
            'rtNumber' => $no_rt,
            'breadcrumb' => $breadcrumb,
            'rts' => $rts,
            'kks' => $kks,
            'activeMenu' => $activeMenu
        ]);
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

    public function show($no_rt, $id)
    {
        $kk = KK::findOrFail($id);
        $wargas = Warga::where('id_kk', $kk->id_kk)->get();

        $breadcrumb = (object) [
            'title' => 'Detail KK',
            'list' => ['Home', 'Data KK', 'Detail KK - ' . $kk->no_kk]
        ];
    
        $activeMenu = 'datakk';
    
        return view('admin.data_kk.detail', [
            'rtNumber' => $no_rt,
            'breadcrumb' => $breadcrumb,
            'kk' => $kk,
            'wargas' => $wargas,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $no_rt)
    {
        $validate = $request->validate([
            'no_kk' => 'required|unique:kk',
            'kepala_keluarga' => 'required',
            'alamat' => 'required',
        ]);

        $temp_no_rt = '0'.$no_rt;

        $rt = RT::where('no_rt', $temp_no_rt)->first();

        if($rt){
            $id_rt = $rt->id_rt;
        }

        KK::create([
            'no_kk' => $validate['no_kk'],
            'kepala_keluarga' => $validate['kepala_keluarga'],
            'alamat' => $validate['alamat'],
            'id_rt' => $id_rt,
        ]);
        
        return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data KK Berhasil Disimpan');
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

        return redirect()->route('kk-admin.show', $id)->with('success', 'Warga berhasil ditambahkan');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $no_rt, $id)
    {
        $request->validate([
            'no_kk' => 'required|unique:kk,no_kk,' . $id .',id_kk',
            'kepala_keluarga' => 'required',
            'alamat' => 'required',
        ]);
        
        $temp_no_rt = '0'.$no_rt;

        $rt = RT::where('no_rt', $temp_no_rt)->first();

        if($rt){
            $id_rt = $rt->id_rt;
        }
        
        KK::findOrFail($id)->update([
            'no_kk' => $request->no_kk,
            'kepala_keluarga' => $request->kepala_keluarga,
            'alamat' => $request->alamat,
            'id_rt' => $id_rt,
        ]);

        return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data KK berhasil diperbarui');
    }

    public function destroy($no_rt, $id)
    {
        $dataKK = KK::findOrFail($id);
        $dataKK->delete();
        return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data KK berhasil dihapus');
    }

    public function deleteSelected(Request $request, $no_rt)
    {
        $selectedIdsJson = $request->input('selectedIds');
        
        if (empty($selectedIdsJson)) {
           return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error'. 'Data Warga Tidak Ditemukan');
        }
        
        $selectedIds = json_decode($selectedIdsJson, true);
        
        try {
            $deletedKKs = KK::whereIn('id_kk', $selectedIds)->delete();
            
            if ($deletedKKs > 0) {
                return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success'. 'Semua Data Warga Berhasil Dihapus');
            } else {
                return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error'. 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error'. 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
