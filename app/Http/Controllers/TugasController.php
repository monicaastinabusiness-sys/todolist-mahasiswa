<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Pengguna;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    // Menampilkan daftar tugas
    public function index()
    {
        $pengguna = Pengguna::all();
        $mataKuliah = MataKuliah::all();

        $tugas = Tugas::with(['pengguna', 'mataKuliah'])
            ->orderByRaw("CASE WHEN status = 'belum' THEN 0 ELSE 1 END")
            ->orderByRaw("CASE WHEN deadline IS NULL THEN 1 ELSE 0 END")
            ->orderBy('deadline', 'asc')
            ->get();

        $jumlahTugas = Tugas::count();
        $jumlahBelum = Tugas::where('status', 'belum')->count();
        $jumlahSelesai = Tugas::where('status', 'selesai')->count();

        return view('tugas.index', compact(
            'tugas',
            'jumlahTugas',
            'jumlahBelum',
            'jumlahSelesai',
            'pengguna',
            'mataKuliah'
        ));
    }

    // Menampilkan detail tugas
    public function show($id)
    {
        $tugas = Tugas::with(['pengguna', 'mataKuliah'])
            ->findOrFail($id);

        return view('tugas.show', compact('tugas'));
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'nullable|in:belum,selesai',
            'pengguna_id' => 'nullable|exists:pengguna,id',
            'mata_kuliah_id' => 'nullable|exists:mata_kuliah,id',
        ]);

        Tugas::create([
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'status' => $request->status ?? 'belum',
            'pengguna_id' => $request->pengguna_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
        ]);

        return redirect('/tugas')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    // Mengubah status tugas
    public function updateStatus($id)
    {
        $tugas = Tugas::findOrFail($id);

        if (!$tugas->pengguna_id) {
            return redirect('/tugas')
                ->with('error', 'Tugas ini belum memiliki pengguna.');
        }

        $sessionKey = 'pengguna_terverifikasi_' . $tugas->pengguna_id;

        if (!session($sessionKey)) {
            return redirect()
                ->route('pengguna.login', $tugas->pengguna_id)
                ->with('error', 'Masukkan password terlebih dahulu.');
        }

        $tugas->status = $tugas->status === 'belum'
            ? 'selesai'
            : 'belum';

        $tugas->save();

        return redirect()
            ->route('pengguna.show', $tugas->pengguna_id)
            ->with('success', 'Status tugas berhasil diperbarui!');
    }

    // Menghapus tugas
    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        if (!$tugas->pengguna_id) {
            return redirect('/tugas')
                ->with('error', 'Tugas ini belum memiliki pengguna.');
        }

        $sessionKey = 'pengguna_terverifikasi_' . $tugas->pengguna_id;

        if (!session($sessionKey)) {
            return redirect()
                ->route('pengguna.login', $tugas->pengguna_id)
                ->with('error', 'Masukkan password terlebih dahulu.');
        }

        $penggunaId = $tugas->pengguna_id;

        $tugas->delete();

        return redirect()
            ->route('pengguna.show', $penggunaId)
            ->with('success', 'Tugas berhasil dihapus!');
    }
}
