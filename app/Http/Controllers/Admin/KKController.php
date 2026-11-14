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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KKController extends Controller
{
    public function index($no_rt)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kartu Keluarga(KK) RT '.$no_rt,
            'list' => ['Home,', 'Data KK']
        ];

        $activeMenu = 'datakk';

        $rts = RT::all();

        $kks = KK::with('kepala')
            ->join('rt', 'kk.id_rt', '=', 'rt.id_rt')
            ->where('rt.no_rt', RT::formatNomor($no_rt))
            ->get();

        return view('admin.data_kk.index', [
            'rtNumber' => $no_rt,
            'breadcrumb' => $breadcrumb,
            'rts' => $rts,
            'kks' => $kks,
            'activeMenu' => $activeMenu
        ]);
    }

    public function show($no_rt, $id)
    {
        $kk = KK::milikRt($no_rt)->findOrFail($id);
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

    public function store(Request $request, $no_rt)
    {
        $validate = $request->validate([
            'no_kk' => 'required|unique:kk',
            'kepala_keluarga' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
        ]);

        $rt = RT::where('no_rt', RT::formatNomor($no_rt))->firstOrFail();

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
            'alamat' => $validate['alamat'],
            'id_rt' => $rt->id_rt,
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
                'no_rt' => $rt->no_rt,
                'status_keluarga' => 'kepala_keluarga',
                'id_user' => $user->id_user,
                'id_kk' => $kk->id_kk,
            ]
        );

        return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data KK Berhasil Disimpan');
    }

    public function update(Request $request, $no_rt, $id)
    {
        $kk = KK::milikRt($no_rt)->findOrFail($id);

        $request->validate([
            'no_kk' => 'required|unique:kk,no_kk,' . $kk->id_kk . ',id_kk',
            'kepala_keluarga' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
        ]);

        $kk->update([
            'no_kk' => $request->no_kk,
            'alamat' => $request->alamat,
        ]);

        $warga = $kk->kepala;

        if ($warga) {
            $warga->update([
                'nama' => $request->kepala_keluarga,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'no_rt' => RT::formatNomor($no_rt),
            ]);
        }

        return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data KK berhasil diperbarui');
    }

    public function destroy($no_rt, $id)
    {
        KK::milikRt($no_rt)->findOrFail($id)->delete();

        return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data KK berhasil dihapus');
    }

    public function deleteSelected(Request $request, $no_rt)
    {
        $selectedIds = json_decode($request->input('selectedIds'), true);

        if (empty($selectedIds)) {
            return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error', 'Data KK Tidak Ditemukan');
        }

        try {
            $deletedKKs = KK::milikRt($no_rt)->whereIn('id_kk', $selectedIds)->delete();

            if ($deletedKKs > 0) {
                return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data KK Terpilih Berhasil Dihapus');
            }

            return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error', 'Data KK Tidak Ditemukan');
        } catch (Exception $e) {
            return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error', 'Data KK Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function show_warga($no_rt, $id_kk, $id)
    {
        $kk = KK::milikRt($no_rt)->findOrFail($id_kk);
        $warga = Warga::where('id_kk', $kk->id_kk)->findOrFail($id);
        $level = Level::untukRt($no_rt);

        $breadcrumb = (object) [
            'title' => 'Detail KK',
            'list' => ['Home,', 'Detail Keseluruhan Data KK - ' . $kk->no_kk, '&', 'Data Warga', 'Detail Warga - ' . $warga->nik]
        ];

        $activeMenu = 'datakk';

        return view('admin.data_kk.detail_warga.detail', [
            'breadcrumb' => $breadcrumb,
            'rtNumber' => $no_rt,
            'kk' => $kk,
            'level' => $level,
            'warga' => $warga,
            'activeMenu' => $activeMenu
        ]);
    }

    public function storeMany($no_rt, Request $request, $id_kk)
    {
        $kk = KK::milikRt($no_rt)->findOrFail($id_kk);

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

        return redirect()->route('kk-admin.show', ['rt' => $no_rt, 'id' => $id_kk])->with('success', 'Warga berhasil ditambahkan');
    }

    public function update_warga($no_rt, $id_kk, Request $request, $id_warga)
    {
        $kk = KK::milikRt($no_rt)->findOrFail($id_kk);
        $warga = Warga::where('id_kk', $kk->id_kk)->findOrFail($id_warga);

        $request->validate([
            'nik' => 'required|unique:warga,nik,' . $warga->id_warga . ',id_warga',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'status_keluarga' => 'required',
            'status_kependudukan' => 'required',
        ]);

        $warga->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
        ]);

        return redirect()->route('kk-admin.show', ['rt' => $no_rt, 'id' => $id_kk])->with('success', 'Warga berhasil diperbarui');
    }

    public function destroy_warga($no_rt, $id_warga)
    {
        $warga = Warga::milikRt($no_rt)->findOrFail($id_warga);
        $id_kk = $warga->id_kk;

        try {
            DB::beginTransaction();

            $kkDeleted = $this->hapusWarga($warga);

            DB::commit();

            if ($kkDeleted) {
                return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data Warga Berhasil Dihapus');
            }

            return redirect()->route('kk-admin.show', ['rt' => $no_rt, 'id' => $id_kk])->with('success', 'Data Warga Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return redirect()->route('kk-admin.show', ['rt' => $no_rt, 'id' => $id_kk])->with('error', 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected_warga($no_rt, Request $request)
    {
        $selectedIds = json_decode($request->input('selectedIds'), true);

        if (empty($selectedIds)) {
            return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error', 'Data Warga Tidak Ditemukan');
        }

        try {
            DB::beginTransaction();

            $wargas = Warga::milikRt($no_rt)->whereIn('warga.id_warga', $selectedIds)->get();

            if ($wargas->isEmpty()) {
                return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error', 'Data Warga Tidak Ditemukan');
            }

            $id_kk = $wargas->first()->id_kk;
            $kkDeleted = false;

            foreach ($wargas as $warga) {
                $kkDeleted = $this->hapusWarga($warga) || $kkDeleted;
            }

            DB::commit();

            if ($kkDeleted) {
                return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('success', 'Data Warga Berhasil Dihapus');
            }

            return redirect()->route('kk-admin.show', ['rt' => $no_rt, 'id' => $id_kk])->with('success', 'Data Warga Berhasil Dihapus');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('kk-admin.index', ['rt' => $no_rt])->with('error', 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function update_user($no_rt, $id_kk, $id, Request $request)
    {
        $kk = KK::milikRt($no_rt)->findOrFail($id_kk);
        $warga = Warga::where('id_kk', $kk->id_kk)->where('id_user', $id)->firstOrFail();
        $user = $warga->user;
        $levelWarga = Level::where('level_kode', 'WRG')->firstOrFail();

        $request->validate([
            'username' => 'required|min:16|max:16|unique:user,username,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:8|max:100',
            'id_level' => ['required', Rule::in(Level::untukRt($no_rt)->pluck('id_level'))],
            'periode_jabatan_awal' => ['nullable', 'date', Rule::requiredIf(fn () => $request->id_level != $levelWarga->id_level)],
            'periode_jabatan_akhir' => ['nullable', 'date', 'after_or_equal:periode_jabatan_awal', Rule::requiredIf(fn () => $request->id_level != $levelWarga->id_level)],
        ]);

        $user->update([
            'username' => $request->username,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'id_level' => $request->id_level,
        ]);

        if ($request->id_level != $levelWarga->id_level) {
            $warga->periode_jabatan_awal = $request->periode_jabatan_awal;
            $warga->periode_jabatan_akhir = $request->periode_jabatan_akhir;
        } else {
            $warga->periode_jabatan_awal = null;
            $warga->periode_jabatan_akhir = null;
        }

        $warga->save();

        return redirect()->route('kkwarga-admin.show', ['rt' => $no_rt, 'id_kk' => $id_kk, 'id_warga' => $warga->id_warga])->with('success', 'Data User Berhasil Diubah');
    }

    private function hapusWarga(Warga $warga)
    {
        $kkDeleted = false;

        if ($warga->status_keluarga == 'kepala_keluarga') {
            $kkDeleted = (bool) KK::destroy($warga->id_kk);
        }

        Warga::destroy($warga->id_warga);
        Users::destroy($warga->id_user);

        return $kkDeleted;
    }
}
