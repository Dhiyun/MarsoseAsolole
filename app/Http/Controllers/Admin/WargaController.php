<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KK;
use App\Models\Level;
use App\Models\Users;
use App\Models\Warga;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class WargaController extends Controller
{
    public function index($no_rt)
    {
        $breadcrumb = (object) [
            'title' => 'Data Penduduk',
            'list' => ['Home,', 'Penduduk']
        ];

        $activeMenu = 'warga';

        $wargas = Warga::select('warga.*')
            ->leftJoin('kk', 'kk.id_kk', '=', 'warga.id_kk')
            ->leftJoin('rt', 'kk.id_rt', '=', 'rt.id_rt')
            ->where('rt.no_rt', '0' . $no_rt)
            ->orWhere('warga.no_rt', '0' . $no_rt)
            ->get();

        return view('admin.data_warga.index', [
            'rtNumber' => $no_rt,
            'breadcrumb' => $breadcrumb,
            'wargas' => $wargas,
            'activeMenu' => $activeMenu
        ]);
    }

    public function cek_nik()
    {
        $NIKResult = Warga::select('nik')->get();

        if ($NIKResult) {
            return response()->json(['niks' => $NIKResult]);
        } else {
            return response()->json(['error' => 'NIK not found'], 404);
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

    public function show($no_rt, $id)
    {
        $warga = Warga::findOrFail($id);
        $level = Level::all();

        $breadcrumb = (object) [
            'title' => 'Detail Warga',
            'list' => ['Home,', 'Detail Data Warga - ' . $warga->nik]
        ];

        $activeMenu = 'warga';

        return view('admin.data_warga.detail', [
            'breadcrumb' => $breadcrumb,
            'level' => $level,
            'warga' => $warga,
            'rtNumber' => $no_rt,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        // Not implemented
    }

    public function store(Request $request, $no_rt)
    {
        $validate = $request->validate([
            'nik' => 'required|unique:warga,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'status_keluarga' => 'required',
            'status_kependudukan' => 'required',
            'no_kk' => 'nullable',
        ]);

        $kk = KK::where('no_kk', $request->input('no_kk'))->first();

        $id_kk = $kk ? $kk->id_kk : null;

        $level = Level::whereIn('level_nama', ['Warga', 'warga'])->firstOrFail();

        $rt = '0' . $no_rt;

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
            'no_rt' => $rt,
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
            'id_user' => $user->id_user,
            'id_kk' => $id_kk,
        ]);

        return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('success', 'Warga berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Not implemented
    }

    public function update(Request $request, $no_rt, $id)
    {
        $request->validate([
            'nik' => 'required|unique:warga,nik,' . $id . ',id_warga',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'status_keluarga' => 'required',
            'status_kependudukan' => 'required',
            'no_kk' => 'nullable',
        ]);

        $kk = KK::where('no_kk', $request->input('no_kk'))->first();

        $id_kk = $kk ? $kk->id_kk : null;

        $rt = '0' . $no_rt;

        Warga::findOrFail($id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_rt' => $rt,
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
            'id_kk' => $id_kk,
        ]);

        $warga = Warga::findOrFail($id);

        if ($warga->status_keluarga == 'kepala_keluarga' && $id_kk) {
            $kk->update(['kepala_keluarga' => $warga->nama]);
        }

        return redirect()->route('warga-admin.index', ['rt' => $no_rt, 'id' => $id])->with('success', 'Warga berhasil diperbarui');
    }

    public function update_user(Request $request, $no_rt, $id)
    {
        $request->validate([
            'username' => 'required|min:16|max:16|unique:user,username,' . $id . ',id_user',
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

        if ($request->id_level != $level->id_level) {
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

        return redirect()->route('warga-admin.show', ['rt' => $no_rt, 'id' => $id])->with('success', 'Data User Berhasil Diubah');
    }

    public function destroy($no_rt, $id)
    {
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

            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('success' . 'Data Warga Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request, $no_rt)
    {
        $selectedIdsJson = $request->input('selectedIds');

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

            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('success', 'Data Warga terpilih berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
