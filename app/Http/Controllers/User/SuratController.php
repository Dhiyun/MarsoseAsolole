<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function surat_keterangan()
    {
        $surats = Surat::all();

        return view('user.surat_keterangan', compact('surats'));
    }
}
