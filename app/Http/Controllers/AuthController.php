<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.index');
    }

    public function indexUsers()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function indexPetani()
    {
        return view('petani.index');
    }

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
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Selamat datang Admin!');
            } elseif ($role === 'petani') {
                return redirect()->route('petani.index')->with('success', 'Selamat datang, Bapak/Ibu Petani!');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Gagal, username atau password salah.')->onlyInput('name');
    }

    public function storeUser(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:255|unique:users,name',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:admin,petani',
        ];

        if ($request->role === 'petani') {
            $rules += [
                'no_hp'     => 'required|string|max:15',
                'desa'      => 'required|string',
                'kecamatan' => 'required|string',
                'kabupaten' => 'required|string',
                'provinsi'  => 'required|string',
            ];
        }

        $request->validate($rules);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        if ($request->role === 'petani') {
            $user->no_hp = $request->no_hp;
            $user->desa = $request->desa;
            $user->kecamatan = $request->kecamatan;
            $user->kabupaten = $request->kabupaten;
            $user->provinsi = $request->provinsi;
        }

        $user->save();

        return redirect()->back()->with('success', 'Akun ' . $request->role . ' berhasil dibuat!');
    }

    public function showAllUsers(Request $request)
    {
        $role = $request->query('role', 'all');
        $query = User::query();
        if ($role !== 'all') {
            $query->where('role', $role);
        }
        $users = $query->latest()->get();
        $counts = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'petani' => User::where('role', 'petani')->count(),
        ];

        return view('users.detail', compact('users', 'role', 'counts'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
