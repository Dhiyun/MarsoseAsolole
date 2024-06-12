<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use App\Models\KK;
use App\Models\Level;
use App\Models\RT;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Warga;
use Exception;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Penduduk',
            'list' => ['Home,', 'Penduduk']
        ];

        $activeMenu = 'warga';
        $wargas = Warga::all();
        $rts = RT::all();

        return view('super-admin.data_warga.index', [
            'breadcrumb' => $breadcrumb,
            'wargas' => $wargas,
            'rts' => $rts,
            'activeMenu' => $activeMenu
        ]);
    }

    public function cek_nik()
    {
        $NIKResult = Warga::select('nik')->get();

        if ($NIKResult) {
            return response()->json(['niks' => $NIKResult]);
        } else {
            return response()->json(['error' => 'No KK not found'], 404);
        }
    }

    public function cek_kk()
    {
        $KKResult = KK::select('no_kk')->get();

        if ($KKResult) {
            return response()->json(['kks' => $KKResult]);
        } else {
            return response()->json(['error' => 'No KK not found'], 404);
        }
    }

    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        $level = Level::all();

        $breadcrumb = (object) [
            'title' => 'Detail Warga',
            'list' => ['Home', 'Detail Data Warga - ' . $warga->nik]
        ];

        $activeMenu = 'warga';

        return view('super-admin.data_warga.detail', [
            'breadcrumb' => $breadcrumb,
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
            'nik' => 'required|unique:warga,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_rt' => 'nullable',
            'status_keluarga' => 'required',
            'status_kependudukan' => 'required',
            'no_kk' => 'nullable',
        ]);

        $kk = KK::where('no_kk', $request->input('no_kk'))->first();

        $id_kk = $kk ? $kk->id_kk : null;

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
            'alamat' => $validate['alamat'],
            'no_rt' => $validate['no_rt'],
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
            'id_user' => $user->id_user,
            'id_kk' => $id_kk,
        ]);

        return redirect()->route('warga.index')->with('success', 'Warga berhasil ditambahkan');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:warga,nik,' . $id . ',id_warga',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_rt' => 'nullable',
            'status_keluarga' => 'required',
            'status_kependudukan' => 'required',
            'no_kk' => 'nullable',
        ]);

        $kk = KK::where('no_kk', $request->input('no_kk'))->first();

        $id_kk = $kk ? $kk->id_kk : null;

        Warga::findOrFail($id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_rt' => $request->no_rt,
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
            'id_kk' => $id_kk,
        ]);

        $warga = Warga::findOrFail($id);

        if ($warga->status_keluarga == 'kepala_keluarga' && $id_kk) {
            $kk->update(['kepala_keluarga' => $warga->nama]);
        }

        return redirect()->route('warga.index')->with('success', 'Warga berhasil diperbarui');
    }

    public function destroy($id)
    {
        $check = Warga::find($id);
        if(!$check) {
            return redirect('/warga')->with('error'. 'Data Warga Tidak Ditemukan');
        }

        try {
            $warga = Warga::find($id);
            $id_user = $warga->id_user;
            $id_kk = $warga->id_kk;
            $status_keluarga = $warga->status_keluarga;

            if ($status_keluarga == 'kepala_keluarga') {
                KK::destroy($id_kk);
            }
            Warga::destroy($id);
            Users::destroy($id_user);

            return redirect()->route('warga.index')->with('success' . 'Data Warga Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('warga.index')->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('warga.index')->with('error' . 'Data Warga Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            foreach ($selectedIds as $id) {
                $warga = Warga::find($id);
                $id_user = $warga->id_user;
                $id_kk = $warga->id_kk;
                $status_keluarga = $warga->status_keluarga;

                if ($status_keluarga == 'kepala_keluarga') {
                    KK::destroy($id_kk);
                }
                Warga::destroy($id);
                Users::destroy($id_user);
            }

            return redirect()->route('warga.index')->with('success', 'Data Warga terpilih berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('warga.index')->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
