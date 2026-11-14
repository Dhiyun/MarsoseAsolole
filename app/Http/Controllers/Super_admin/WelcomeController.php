<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPengaduan;
use App\Models\RT;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Home',
            'list' => ['Dashboard']
        ];

        $activeMenu = 'dashboard';
        // $user = Auth::user();

        if (Auth::check()) {
            $user = Auth::user();

            // Menghitung total id_laporan di tabel laporan_pengaduan
            $totalLaporan = LaporanPengaduan::count();

            // Menghitung total id_laporan di tabel Warga
            $totalWarga = Warga::count();

            // Menghitung total id_laporan di tabel laporan_pengaduan
            $totalRT = RT::count();

            $rejectedLaporan = LaporanPengaduan::where('status', 'ditolak')->count();

            $laporanPerJenis = LaporanPengaduan::selectRaw("COALESCE(jenis_laporan, 'Lainnya') as label, COUNT(*) as total")
                ->groupBy('label')
                ->orderBy('label')
                ->pluck('total', 'label');

            $laporanPerStatus = LaporanPengaduan::selectRaw("COALESCE(status, 'menunggu') as label, COUNT(*) as total")
                ->groupBy('label')
                ->orderBy('label')
                ->pluck('total', 'label');

            $pendudukPerRt = Warga::join('rt', 'rt.id_rt', '=', 'warga.id_rt')
                ->selectRaw('rt.no_rt as label, COUNT(*) as total')
                ->groupBy('rt.no_rt')
                ->orderBy('rt.no_rt')
                ->pluck('total', 'label');

            return view('super-admin.welcome', [
                'user' => $user,
                'breadcrumb' => $breadcrumb,
                'activeMenu' => $activeMenu,
                'totalLaporan' => $totalLaporan,
                'totalWarga' => $totalWarga,
                'totalRT' => $totalRT,
                'rejectedLaporan' => $rejectedLaporan,
                'laporanPerJenis' => $laporanPerJenis,
                'laporanPerStatus' => $laporanPerStatus,
                'pendudukPerRt' => $pendudukPerRt,
            ]);
        } else {
            return redirect()->route('login');
        }
    }
    public function profileSA()
    {
        $breadcrumb = (object) [
            'title' => 'Home',
            'list' => ['Profile']
        ];

        $activeMenu = 'dashboard';

        return view('super-admin.profile.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function updateProfileSA(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:16',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_rt' => ['required', 'string', 'max:4', RT::aturanNomor()],
            'agama' => 'required|string|max:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $this->validasiPasswordBaru($request);

        $warga = Auth::user()->warga;

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($warga->foto) {
                Storage::delete('public/uploads/' . $warga->foto);
            }
            // Store new photo
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fileName);
            $warga->foto = $fileName;
        }

        $warga->nama = $request->nama;
        $warga->nik = $request->nik;
        $warga->jenis_kelamin = $request->jenis_kelamin;
        $warga->tempat_lahir = $request->tempat_lahir;
        $warga->tanggal_lahir = $request->tanggal_lahir;
        $warga->alamat = $request->alamat;
        $warga->no_rt = $request->no_rt;
        $warga->agama = $request->agama;
        $warga->save();

        $this->simpanPasswordBaru($request);

        return redirect()->route('profile-superadmin')->with('success', 'Profile updated successfully');
    }
}
