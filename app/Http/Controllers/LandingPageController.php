<?php

// app/Http/Controllers/LandingPageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPengaduan;

class LandingPageController extends Controller
{
    public function index()
    {
        // Fetch the latest 6 reports and their associated users (warga)
        $laporanPengaduan = LaporanPengaduan::with('warga')->latest()->take(6)->get();

        // Pass the reports to the view
        return view('landing_page.index', compact('laporanPengaduan'));
    }
}
