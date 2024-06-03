<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanPengaduan;
use App\Models\Warga;
use App\Models\RW;
use Illuminate\Support\Facades\Auth;

class LaporanPengaduanController extends Controller
{
    public function index()
    {
        return view('user.laporan.index');
    }

    public function create()
    {
        return view('user.laporan.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'jenis_laporan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('gambar'), $imageName);
            $imagePath = 'gambar/' . $imageName;
        }
        
        LaporanPengaduan::create([
            'jenis_laporan' => $validate['jenis_laporan'],
            'gambar' => $imagePath,
            'keterangan' => $validate['keterangan'],
            'status' => 'menunggu',
            'id_warga' => Auth::user()->id_user,
        ]);

        return redirect()->route('user-laporan.create')->with('success', 'Laporan pengaduan berhasil ditambahkan');
    }
}
