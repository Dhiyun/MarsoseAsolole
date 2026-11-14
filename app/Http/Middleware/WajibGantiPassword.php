<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WajibGantiPassword
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->get('wajib_ganti_password')) {
            return redirect()->route('password.ganti');
        }

        return $next($request);
    }
}
