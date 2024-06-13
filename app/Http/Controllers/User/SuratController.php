<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function surat_keterangan()
    {
        $surats = Surat::where('jenis_surat','Surat Keterangan')->get();

        return view('user.surat_keterangan', compact('surats'));
    }
    
    public function surat_pengantar()
    {
        $surats = Surat::where('jenis_surat','Surat Pengantar')->get();

        return view('user.surat_pengantar', compact('surats'));
    }

    public function surat_undangan()
    {
        $surats = Surat::where('jenis_surat','Surat Undangan')->get();

        return view('user.surat_undangan', compact('surats'));
    }

    public function surat_pemberitahuan()
    {
        $surats = Surat::where('jenis_surat','Surat Pemberitahuan')->get();

        return view('user.surat_pemberitahuan', compact('surats'));
    }
}
