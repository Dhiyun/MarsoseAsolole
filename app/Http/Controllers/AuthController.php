<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

        $request->session()->regenerate();

        if ($request->password === $request->username) {
            $request->session()->put('wajib_ganti_password', true);

            return redirect()->route('password.ganti');
        }

        return $this->redirectSesuaiLevel(Auth::user());
    }

    public function gantiPassword()
    {
        return view('auth.ganti_password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed', Rule::notIn([$user->username])],
        ], [
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'password.not_in' => 'Password tidak boleh sama dengan username.',
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        $request->session()->forget('wajib_ganti_password');

        return $this->redirectSesuaiLevel($user)->with('success', 'Password berhasil diganti');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectSesuaiLevel($user)
    {
        $level = $user->level->level_kode;

        if (strpos($level, 'RT') === 0 && strlen($level) === 3) {
            return redirect()->route('admin.index', ['rt' => substr($level, 2)]);
        }

        if ($level == 'RW') {
            return redirect()->route('super-admin.index');
        }

        return redirect()->route('user.index');
    }
}
