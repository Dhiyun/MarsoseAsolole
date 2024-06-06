<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Home',
            'list' => ['Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('super-admin.welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
