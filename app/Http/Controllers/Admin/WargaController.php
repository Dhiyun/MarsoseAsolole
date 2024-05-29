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
            'list' => ['Home', 'Penduduk']
        ];

        $activeMenu = 'warga';

        $wargas = Warga::select('warga.*')
            ->leftJoin('kk', 'kk.id_kk', '=', 'warga.id_kk')
            ->leftJoin('rt', 'kk.id_rt', '=', 'rt.id_rt')
            ->where(function ($query) use ($no_rt) {
                $query->where('rt.no_rt', '0' . $no_rt)
                    ->orWhereNull('warga.id_kk');
            })
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

    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        $level = Level::all();

        $breadcrumb = (object) [
            'title' => 'Detail Warga',
            'list' => ['Home', 'Data Warga', 'Detail Warga - ' . $warga->nik]
        ];

        $activeMenu = 'warga';

        // Asumsikan Anda memiliki `$rtNumber` dari parameter atau data terkait warga
        $rtNumber = $warga->kk->rt->no_rt ?? null;

        return view('admin.data_warga.detail', [
            'breadcrumb' => $breadcrumb,
            'level' => $level,
            'warga' => $warga,
            'rtNumber' => $rtNumber,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        // Not implemented
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
            'id_user' => $user->id_user,
            'id_kk' => $id_kk,
        ]);

        return redirect()->route('admin.warga.index', ['no_rt' => $request->input('no_rt')])->with('success', 'Warga berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Not implemented
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
            'no_kk' => 'nullable',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_kk' => $request->no_kk,
        ]);

        return redirect()->route('admin.warga.index', ['no_rt' => $request->input('no_rt')])->with('success', 'Warga berhasil diperbarui');
    }

    public function destroy($id)
    {
        $check = Warga::find($id);
        if (!$check) {
            return redirect()->route('admin.warga.index')->with('error', 'Data Warga Tidak Ditemukan');
        }

        try {
            Warga::destroy($id);
            Users::destroy($check->id_user); // Ensure the user linked to the Warga is deleted

            return redirect()->route('admin.warga.index')->with('success', 'Data Warga Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.warga.index')->with('error', 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('admin.warga.index')->with('error', 'Data Warga Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $wargas = Warga::whereIn('id_warga', $selectedIds)->get();
            $userIds = $wargas->pluck('id_user')->toArray();

            Warga::whereIn('id_warga', $selectedIds)->delete();
            Users::whereIn('id_user', $userIds)->delete();

            return redirect()->route('admin.warga.index')->with('success', 'Semua Data Warga Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->route('admin.warga.index')->with('error', 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
