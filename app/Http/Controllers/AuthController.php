<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function register()
    {
        return view('auth.register');
    }

    // Memproses pendaftaran pengguna
    public function storeRegister(Request $request)
    {
        $data = $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $pengguna = Pengguna::create([
            'nama_pengguna' => $data['nama_pengguna'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($pengguna);

        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    // Memproses login pengguna
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.'
            ])
            ->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
