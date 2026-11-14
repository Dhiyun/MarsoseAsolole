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

class WargaController extends Controller
{
    public function index($no_rt)
    {
        $breadcrumb = (object) [
            'title' => 'Data Penduduk RT '. $no_rt,
            'list' => ['Home,', 'Penduduk']
        ];

        $activeMenu = 'warga';

        $wargas = Warga::milikRt($no_rt)->with('rt')->get();

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
        $warga = Warga::milikRt($no_rt)->findOrFail($id);
        $level = Level::untukRt($no_rt);

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
            'no_kk' => ['nullable', $this->aturanKkRt($no_rt)],
        ]);

        $kk = KK::where('no_kk', $request->input('no_kk'))->first();

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
            'no_rt' => RT::formatNomor($no_rt),
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
            'id_user' => $user->id_user,
            'id_kk' => $kk ? $kk->id_kk : null,
        ]);

        return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('success', 'Warga berhasil ditambahkan');
    }

    public function update(Request $request, $no_rt, $id)
    {
        $warga = Warga::milikRt($no_rt)->findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:warga,nik,' . $warga->id_warga . ',id_warga',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'status_keluarga' => 'required',
            'status_kependudukan' => 'required',
            'no_kk' => ['nullable', $this->aturanKkRt($no_rt)],
        ]);

        $kk = KK::where('no_kk', $request->input('no_kk'))->first();

        $warga->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_rt' => RT::formatNomor($no_rt),
            'status_keluarga' => $request->status_keluarga,
            'status_kependudukan' => $request->status_kependudukan,
            'id_kk' => $kk ? $kk->id_kk : null,
        ]);

        return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('success', 'Warga berhasil diperbarui');
    }

    public function update_user(Request $request, $no_rt, $id)
    {
        $warga = Warga::milikRt($no_rt)->where('warga.id_user', $id)->firstOrFail();
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

        $warga->aturJabatan($request->id_level, $request->periode_jabatan_awal, $request->periode_jabatan_akhir);

        return redirect()->route('warga-admin.show', ['rt' => $no_rt, 'id' => $warga->id_warga])->with('success', 'Data User Berhasil Diubah');
    }

    public function destroy($no_rt, $id)
    {
        $warga = Warga::milikRt($no_rt)->findOrFail($id);

        try {
            DB::beginTransaction();

            $this->hapusWarga($warga);

            DB::commit();

            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('success', 'Data Warga Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('error', 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request, $no_rt)
    {
        $selectedIds = json_decode($request->input('selectedIds'), true) ?: [];

        try {
            DB::beginTransaction();

            $wargas = Warga::milikRt($no_rt)->whereIn('warga.id_warga', $selectedIds)->get();

            foreach ($wargas as $warga) {
                $this->hapusWarga($warga);
            }

            DB::commit();

            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('success', 'Data Warga terpilih berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('warga-admin.index', ['rt' => $no_rt])->with('error', 'Data Warga Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    private function aturanKkRt($no_rt)
    {
        $idRt = RT::where('no_rt', RT::formatNomor($no_rt))->value('id_rt');

        return Rule::exists('kk', 'no_kk')->where('id_rt', $idRt);
    }

    private function hapusWarga(Warga $warga)
    {
        if ($warga->status_keluarga == 'kepala_keluarga') {
            KK::destroy($warga->id_kk);
        }

        Warga::destroy($warga->id_warga);
        Users::destroy($warga->id_user);
    }
}
