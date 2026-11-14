<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function checkLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = Users::checkCredentials($username, $password);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid username or password'], 401);
        }

        return response()->json(['success' => true]);
    }

    public function login()
    {
        $user = Auth::user();
        if ($user) {

            $level = $user->level->level_kode;

            if (strpos($level, 'RT') === 0 && strlen($level) === 3) {
                $rtNumber = substr($level, 2);

                return redirect()->intended(route('admin.index', ['rt' => $rtNumber]));
            }

            if ($level == 'RW') {
                return redirect()->intended(route('super-admin.index'));
            } else if ($level == 'WRG') {
                return redirect()->intended(route('user.index'));
            }
        }

        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return back()
                ->withInput($request->only('username'))
                ->with('error', 'Username atau password salah.');
        }

        if (!Auth::user()->warga) {
            Auth::logout();

            return back()
                ->withInput($request->only('username'))
                ->with('error', 'Akun Anda belum terhubung dengan data warga. Silakan hubungi pengurus RT/RW.');
        }

        $request->session()->regenerate();

        return redirect(Auth::user()->urlDashboard());
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
