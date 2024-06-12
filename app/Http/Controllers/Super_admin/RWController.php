<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RW;

class RWController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Home',
            'list' => ['Data RW']
        ];

        $activeMenu = 'datarw';
        $dataRt = RW::all();

        return view('data_rw.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }


    public function create()
    {
        return view('data_rw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'No_RW' => 'required|unique:data_rw',
            'NIK' => 'nullable',
            'nama' => 'nullable',
            'alamat' => 'nullable',
            'periode_jabatan' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
        ]);

        RW::create($request->all());
        return redirect()->route('data_rw.index')->with('success', 'Data RW berhasil ditambahkan');
    }

    public function edit($No_RW)
    {
        $dataRw = RW::findOrFail($No_RW);
        return view('data_rw.edit', compact('dataRw'));
    }

    public function update(Request $request, $No_RW)
    {
        $dataRw = RW::findOrFail($No_RW);

        $request->validate([
            'NIK' => 'nullable',
            'nama' => 'nullable',
            'alamat' => 'nullable',
            'periode_jabatan' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
        ]);

        $dataRw->update($request->all());
        return redirect()->route('data_rw.index')->with('success', 'Data RW berhasil diperbarui');
    }

    public function destroy($No_RW)
    {
        $dataRw = RW::findOrFail($No_RW);
        $dataRw->delete();
        return redirect()->route('data_rw.index')->with('success', 'Data RW berhasil dihapus');
    }
}
