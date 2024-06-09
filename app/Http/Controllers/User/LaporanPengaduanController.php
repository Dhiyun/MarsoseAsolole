<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanPengaduan;
use Illuminate\Support\Facades\Auth;

class LaporanPengaduanController extends Controller
{
    public function index()
    {
        $laporanPengaduan = LaporanPengaduan::all();
        return view('user.laporan.index', compact('laporanPengaduan'));
    }

    public function create()
    {
        return view('user.laporan.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required',
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
        
        $id_warga = Auth::user()->warga->id_warga;
        
        LaporanPengaduan::create([
            'judul' => $validate['judul'],
            'jenis_laporan' => $validate['jenis_laporan'],
            'gambar' => $imagePath,
            'keterangan' => $validate['keterangan'],
            'status' => 'menunggu',
            'id_warga' => $id_warga,
        ]);

        return redirect()->route('user-laporan.history')->with('success', 'Laporan pengaduan berhasil ditambahkan');
    }

    public function history()
    {
        $laporanPengaduan = LaporanPengaduan::where('id_warga', Auth::user()->id_user)->get();
        return view('user.laporan.history', compact('laporanPengaduan'));
    }

    public function showLaporanPengaduan()
    {
        $laporanPengaduan = LaporanPengaduan::all()->with('warga')->get();
        return view('user.laporan.index', compact('laporanPengaduan'));
    }
}
