<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function validasiPasswordBaru(Request $request): void
    {
        $request->validate([
            'password_lama' => 'nullable|required_with:password|current_password',
            'password' => ['nullable', 'string', 'min:8', 'confirmed', Rule::notIn([Auth::user()->username])],
        ], [
            'password_lama.required_with' => 'Isi password lama untuk mengganti password.',
            'password_lama.current_password' => 'Password lama tidak sesuai.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak sama.',
            'password.not_in' => 'Password baru tidak boleh sama dengan username.',
        ]);
    }

    protected function simpanPasswordBaru(Request $request): void
    {
        if ($request->filled('password')) {
            Auth::user()->update(['password' => Hash::make($request->password)]);
        }
    }
}
