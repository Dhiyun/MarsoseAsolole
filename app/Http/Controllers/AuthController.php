<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $user = Auth::user();
        if ($user){

            $level = $user->level->level_code;

            $totalLevel = Level::count();

            for($i = 1; $i <= $totalLevel; $i++){
                $rtCode = 'RT' . $i;

                if ($level == $rtCode) {
                    return redirect()->intended(route('admin.dashboard', ['rt', $i]));
                }
            }

            if($level == 'RW') {
                return redirect()->intended(route('super-admin.dashboard'));
            } else if ($level == 'WRG') {
                return redirect()->intended(route('warga.dashboard'));
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

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();

            $level = $user->level->level_nama;

            Auth::login($user);

            if ($level == 'RW') {
                return redirect()->route('super-admin.dashboard');
            } else {
                return redirect()->route('biodata.index');
            }
        } else {
            return response()->json(['error' => 'These credentials do not match our records.'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();
        return redirect('/');
    }

    public function cek_email() {
        $emailResults = User::select('email')->get();
    
        if ($emailResults) {
            return response()->json(['emails' => $emailResults]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
