<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KK;
use App\Models\RW;
use App\Models\RT;
use App\Models\Warga;
use Exception;

class KKController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar KK',
            'list' => ['Home, Data KK']
        ];

        $activeMenu = 'datakk';
        $kk = KK::all();

        return view('super-admin.data_kk.index', [
            'breadcrumb' => $breadcrumb,
            'kk' => $kk,
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
        $warga = Warga::where('id_kk', $kk->id_kk)->get();

        $breadcrumb = (object) [
            'title' => 'Detail KK',
            'list' => ['Home', 'Data KK', 'Detail KK - ' . $kk->no_kk]
        ];
    
        $activeMenu = 'datakk';
    
        return view('super-admin.data_kk.detail', [
            'breadcrumb' => $breadcrumb,
            'kk' => $kk,
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
        ]);

        $no = $validate['no_rt'];

        $no_rt = 'RT' . $no;

        $rt = RT::where('no_rt', $no_rt)->first();

        if($rt){
            $id_rt = $rt->id_rt;
        }

        KK::create([
            'no_kk' => $validate['no_kk'],
            'kepala_keluarga' => $validate['kepala_keluarga'],
            'alamat' => $validate['alamat'],
            'id_rt' => $id_rt,
        ]);
        
        return redirect('/datakk')->with('success', 'Data KK Berhasil Disimpan');
    }

    public function edit($No_KK)
    {
        $dataKK = KK::findOrFail($No_KK);
        $dataRW = RW::all();
        $dataRT = RT::all();
        return view('data_kk.edit', compact('dataKK','dataRW','dataRT'));
    }

    public function update(Request $request, $No_KK)
    {
        $dataKK = KK::findOrFail($No_KK);

        $request->validate([
            'kepala_keluarga' => 'nullable',
            'No_RT' => 'nullable',
            'No_RW' => 'nullable',
        ]);

        $dataKK->update($request->all());
        return redirect()->route('data_kk.index')->with('success', 'Data KK berhasil diperbarui');
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
            return redirect('/datakk')->with('error'. 'Data Warga Tidak Ditemukan');
        }
        
        $selectedIds = json_decode($selectedIdsJson, true);
        
        try {
            $deletedKKs = KK::whereIn('id_kk', $selectedIds)->delete();
            
            if ($deletedKKs > 0) {
                return redirect('/datakk')->with('success'. 'Semua Data Warga Berhasil Dihapus');
            } else {
                return redirect('/datakk')->with('error'. 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect('/datakk')->with('error'. 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
