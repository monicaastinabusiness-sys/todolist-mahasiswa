<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pengguna,email',
            'password' => 'required|string|min:4',
        ]);

        Pengguna::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/tugas')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Menampilkan halaman login pengguna
    public function login($id)
    {
        $pengguna = Pengguna::findOrFail($id);

        return view('pengguna.login', compact('pengguna'));
    }

    // Memeriksa password pengguna
    public function authenticate(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:4',
        ]);

        $pengguna = Pengguna::findOrFail($id);

        if (!Hash::check($request->password, $pengguna->password)) {
            return back()->withErrors([
                'password' => 'Password salah. Silakan coba lagi.',
            ]);
        }

        session(['pengguna_terverifikasi_' . $pengguna->id => true]);

        return redirect()->route('pengguna.show', $pengguna->id);
    }

    // Menampilkan daftar tugas milik pengguna
    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);

        if (!session('pengguna_terverifikasi_' . $pengguna->id)) {
            return redirect()->route('pengguna.login', $pengguna->id);
        }

        $pengguna->load('tugas.mataKuliah');

        return view('pengguna.show', compact('pengguna'));
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $pengguna->delete();

        session()->forget('pengguna_terverifikasi_' . $pengguna->id);

        return redirect('/tugas')
            ->with('success', 'Pengguna berhasil dihapus!');
    }
}
