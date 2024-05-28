<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index($no_rt)
    {
        $breadcrumb = (object) [
            'title' => 'Penduduk',
            'list' => ['Home', 'Penduduk']
        ];

        $activeMenu = 'warga';

        $wargas = Warga::select('warga.*')
        ->leftjoin('kk', 'kk.id_kk', '=', 'warga.id_kk')
        ->leftjoin('rt', 'kk.id_rt', '=', 'rt.id_rt')
        ->where('rt.no_rt', '0'.$no_rt)
        ->orWhereNull('warga.id_kk')
        ->get();

        return view('admin.data_warga.index', [
            'rtNumber' => $no_rt,
            'breadcrumb' => $breadcrumb,
            'wargas' => $wargas,
            'activeMenu' => $activeMenu
        ]);
    }
}
