<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download($id)
    {
        $surat = Surat::findOrFail($id);

        $filePath = public_path($surat->file_surat);
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }

}
