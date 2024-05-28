<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KK;
use Illuminate\Http\Request;

class KKController extends Controller
{
    public function index($no_rt)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar KK',
            'list' => ['Home, Data KK']
        ];

        $activeMenu = 'datakk';
        
        $rt = '0'.$no_rt;

        $kks = KK::join('rt', 'kk.id_rt', '=', 'rt.id_rt')
        ->where('rt.no_rt', $rt)
        ->get();

        return view('admin.data_kk.index', [
            'rtNumber' => $no_rt,
            'breadcrumb' => $breadcrumb,
            'kks' => $kks,
            'activeMenu' => $activeMenu
        ]);
    }
}
