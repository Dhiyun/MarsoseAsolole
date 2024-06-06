<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Surat',
            'list' => ['Home, Surat']
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
        $user = Auth::user()->id_user;

        $request->validate([
            'jenis_surat' => 'required',
            'nama_surat' => 'required',
            'file_surat' => 'required|mimes:pdf,doc,docx|max:2048',
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
}
