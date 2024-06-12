<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Surat-Surat',
            'list' => ['Home,', 'Surat-Surat']
        ];

        $activeMenu = 'surat';
        $surat = Surat::all();

        return view('super-admin.surat.index', [
            'breadcrumb' => $breadcrumb,
            'surat' => $surat,
            'activeMenu' => $activeMenu,
        ]);
    }

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
        $user = Auth::user()->warga->id_user;

        $request->validate([
            'jenis_surat' => 'required',
            'nama_surat' => 'required',
            'file_surat' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file_surat')) {
            $fileName = time() . '_' . $request->file('file_surat')->getClientOriginalName();
            $request->file('file_surat')->move(public_path('file_upload'), $fileName);
            $filePath = 'file_upload/' . $fileName;
        }

        Surat::create([
            'jenis_surat' => $request->jenis_surat,
            'nama_surat' => $request->nama_surat,
            'file_surat' => $filePath,
            'id_warga' => $user,
        ]);

        return redirect()->route('surat.index')->with('success', 'Data Surat Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jenis_surat' => 'required',
            'nama_surat' => 'required',
            'file_surat' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        $surat = Surat::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            $filePath = $surat->file_surat;

            if ($filePath && file_exists(public_path($filePath))) {
                unlink(public_path($filePath));
            }

            $fileName = time() . '_' . $request->file('file_surat')->getClientOriginalName();
            $request->file('file_surat')->move(public_path('file_upload'), $fileName);
            $filePath = 'file_upload/' . $fileName;
        } else {
            $filePath = $surat->file_surat;
        }

        $warga = Auth::user()->warga->id_warga;

        $surat->update([
            'jenis_surat' => $validatedData['jenis_surat'],
            'nama_surat' => $validatedData['nama_surat'],
            'file_surat' => $filePath,
            'id_warga' => $warga,
        ]);

        return redirect()->route('surat.index')->with('success', 'Data Surat Berhasil Diperbarui');
    }


    public function destroy($id)
    {
        Surat::findOrFail($id)->delete();
        return redirect()->route('surat.index')->with('success', 'Data Surat berhasil dihapus');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('surat.index')->with('error' . 'Data Surat Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedKKs = Surat::whereIn('id_surat', $selectedIds)->delete();

            if ($deletedKKs > 0) {
                return redirect()->route('surat.index')->with('success' . 'Semua Data Surat Berhasil Dihapus');
            } else {
                return redirect()->route('surat.index')->with('error' . 'Data Surat Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect()->route('surat.index')->with('error' . 'Data Surat Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }
}
