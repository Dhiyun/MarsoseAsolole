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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $level = $user->level->level_kode;

            if (strpos($level, 'RT') === 0 && strlen($level) === 3) {
                $rtNumber = substr($level, 2);

                return redirect()->route('admin.index', ['rt' => $rtNumber]);
            }

            Auth::login($user);

            if ($level == 'RW') {
                return redirect()->route('super-admin.index');
            } else {
                return redirect()->route('user.index');
            }
        } else {
            return response()->json(['error' => 'These credentials do not match our records.'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function cek_email()
    {
        $emailResults = Users::select('email')->get();

        if ($emailResults) {
            return response()->json(['emails' => $emailResults]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
