<?php

namespace App\Http\ControllersSuper_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RT;
use App\Models\RW;


class RTController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Home',
            'list' => ['Data RT']
        ];

        $activeMenu = 'datart';
        $dataRt = RT::all();

        return view('data_rt.index', [
            'breadcrumb' => $breadcrumb,
            'datart' => $dataRt,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        $dataRw = RW::all();
        return view('data_rt.create', compact('dataRw'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'No_RT' => 'required|unique:data_rt',
            'NIK' => 'nullable',
            'nama' => 'nullable',
            'alamat' => 'nullable',
            'periode_jabatan' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
            'No_RW' => 'nullable',
        ]);

        RT::create($request->all());
        return redirect()->route('data_rt.index')->with('success', 'Data RT berhasil ditambahkan');
    }

    public function edit($No_RT)
    {
        $dataRt = RT::findOrFail($No_RT);
        $dataRw = RW::all();
        return view('data_rt.edit', compact('dataRt', 'dataRw'));
    }

    public function update(Request $request, $No_RT)
    {
        $dataRt = RT::findOrFail($No_RT);

        $request->validate([
            'NIK' => 'nullable',
            'nama' => 'nullable',
            'alamat' => 'nullable',
            'periode_jabatan' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
            'No_RW' => 'nullable',
        ]);

        $dataRt->update($request->all());
        return redirect()->route('data_rt.index')->with('success', 'Data RT berhasil diperbarui');
    }

    public function destroy($No_RT)
    {
        $dataRt = RT::findOrFail($No_RT);
        $dataRt->delete();
        return redirect()->route('data_rt.index')->with('success', 'Data RT berhasil dihapus');
    }
}
