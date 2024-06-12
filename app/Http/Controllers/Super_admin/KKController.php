<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KK;
use App\Models\Level;
use App\Models\RW;
use App\Models\RT;
use App\Models\Users;
use App\Models\Warga;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class KKController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar KK',
            'list' => ['Home,', 'Data KK']
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

    public function show($id)
    {
        $kk = KK::findOrFail($id);
        $wargas = Warga::where('id_kk', $kk->id_kk)->get();
        $rts = RT::all();

        $breadcrumb = (object) [
            'title' => 'Detail KK',
            'list' => ['Home,', 'Detail Data KK - ' . $kk->no_kk]
        ];

        $activeMenu = 'datakk';

        return view('super-admin.data_kk.detail', [
            'breadcrumb' => $breadcrumb,
            'kk' => $kk,
            'wargas' => $wargas,
            'rts' => $rts,
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

        if ($rt) {
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
                'status_keluarga' => 'kepala_keluarga',
                'id_user' => $user->id_user,
                'id_kk' => $kk->id_kk,
            ]
        );

        return redirect()->route('kk.index')->with('success', 'Data KK Berhasil Disimpan');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kk' => 'required|unique:kk,no_kk,' . $id . ',id_kk',
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

        if ($rt) {
            $id_rt = $rt->id_rt;
        }

        KK::findOrFail($id)->update([
            'no_kk' => $request->no_kk,
            'kepala_keluarga' => $request->kepala_keluarga,
            'alamat' => $request->alamat,
            'id_rt' => $id_rt,
        ]);

        $warga = Warga::where('id_kk', $id)->first();

        if ($warga) {
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

    public function destroy($id)
    {
        $dataKK = KK::findOrFail($id);
        $dataKK->delete();
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil dihapus');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('kk.index')->with('error' . 'Data Warga Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedKKs = KK::whereIn('id_kk', $selectedIds)->delete();

            if ($deletedKKs > 0) {
                return redirect()->route('kk.index')->with('success' . 'Semua Data Warga Berhasil Dihapus');
            } else {
                return redirect()->route('kk.index')->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect()->route('kk.index')->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    //Warga
    public function show_warga($id_kk, $id)
    {
        $kk = KK::findOrFail($id_kk);
        $warga = Warga::where('id_kk', $kk->id_kk)
            ->findOrFail($id);
        $level = Level::all();

        $breadcrumb = (object) [
            'title' => 'Detail KK',
            'list' => ['Home,', 'Detail Keseluruhan Data KK - ' . $kk->no_kk, '&', 'Data Warga', 'Detail Warga - ' . $warga->nik]
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

    public function storeMany($id_kk, Request $request)
    {
        $validatedData = $request->validate([
            'wargas.*.nik' => 'required|unique:warga,nik',
            'wargas.*.nama' => 'required',
            'wargas.*.jenis_kelamin' => 'required',
            'wargas.*.tempat_lahir' => 'required',
            'wargas.*.tanggal_lahir' => 'required',
            'wargas.*.agama' => 'required',
            'wargas.*.status_keluarga' => 'required',
            'wargas.*.status_kependudukan' => 'required',
        ]);

        $kk = KK::findOrFail($id_kk);

        $level = Level::whereIn('level_nama', ['Warga', 'warga'])->firstOrFail();

        foreach ($validatedData['wargas'] as $wargaData) {
            $user = Users::firstOrCreate(
                ['username' => $wargaData['nik']],
                [
                    'password' => Hash::make($wargaData['nik']),
                    'id_level' => $level->id_level,
                ]
            );

            Warga::create([
                'nik' => $wargaData['nik'],
                'nama' => $wargaData['nama'],
                'jenis_kelamin' => $wargaData['jenis_kelamin'],
                'tempat_lahir' => $wargaData['tempat_lahir'],
                'tanggal_lahir' => $wargaData['tanggal_lahir'],
                'agama' => $wargaData['agama'],
                'alamat' => $kk->alamat,
                'no_rt' => $kk->rt->no_rt,
                'status_keluarga' => $wargaData['status_keluarga'],
                'status_kependudukan' => $wargaData['status_kependudukan'],
                'id_user' => $user->id_user,
                'id_kk' => $kk->id_kk,
            ]);
        }

        return redirect()->route('kk.show', $id_kk)->with('success', 'Warga berhasil ditambahkan');
    }

    public function update_warga($id_kk, Request $request, $id_warga)
    {
        $request->validate([
            'nik' => 'required|unique:warga,nik,' . $id_warga . ',id_warga',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'status_keluarga' => 'required',
            'status_kependudukan' => 'required',
        ]);

        Warga::findOrFail($id_warga)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
        ]);

        $warga = Warga::findOrFail($id_warga);

        if ($warga->status_keluarga == 'kepala_keluarga' && $id_kk) {
            $kk = KK::findOrFail($id_kk);
            $kk->update(['kepala_keluarga' => $warga->nama]);
        }

        return redirect()->route('kk.show', $id_kk)->with('success', 'Warga berhasil diperbarui');
    }

    public function destroy_warga($id_warga)
    {
        try {
            $warga = Warga::find($id_warga);
            $id_user = $warga->id_user;
            $id_kk = $warga->id_kk;
            $status_keluarga = $warga->status_keluarga;

            if ($status_keluarga == 'kepala_keluarga') {
                $kkDeleted = KK::destroy($id_kk);
            } else {
                $kkDeleted = false;
            }
            Warga::destroy($id_warga);
            Users::destroy($id_user);

            if (!$kkDeleted) {
                return redirect()->route('kk.show', $id_kk)->with('success' . 'Data Warga Berhasil Dihapus');
            } else {
                return redirect()->route('kk.index')->with('success' . 'Data Warga Berhasil Dihapus');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kk.show', $id_kk)->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected_warga(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('kk.index')->with('error' . 'Data Warga Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            foreach ($selectedIds as $id_warga) {
                Log::info('Selected ID Warga:', ['id' => $id_warga]);
                $warga = Warga::find($id_warga);
                $id_user = $warga->id_user;
                $id_kk = $warga->id_kk;
                $status_keluarga = $warga->status_keluarga;

                if ($status_keluarga == 'kepala_keluarga') {
                    $kkDeleted = KK::destroy($id_kk);
                } else {
                    $kkDeleted = false;
                }
                Warga::destroy($id_warga);
                Users::destroy($id_user);
            }

            if (!$kkDeleted) {
                return redirect()->route('kk.show', $id_kk)->with('success' . 'Data Warga Berhasil Dihapus');
            } else {
                return redirect()->route('kk.index')->with('success' . 'Data Warga Berhasil Dihapus');
            }
        } catch (Exception $e) {
            return redirect()->route('kk.index')->with('error' . 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    //User
    public function update_user(Request $request, $id)
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

        return redirect()->route('warga.show', ['id' => $id])->with('success', 'Data User Berhasil Diubah');
    }
}
