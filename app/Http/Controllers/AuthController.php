<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name'     => ['required'],
            'password' => ['required'],
        ], [
            'name.required'     => 'Username wajib diisi!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Selamat datang Admin!');
            }

            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        }
        return back()->with('error', 'Gagal, username atau password kamu salah.')->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
