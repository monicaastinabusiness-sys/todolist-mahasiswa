<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        // Hanya tugas milik pengguna yang sedang login
        $tugas = Tugas::with('mataKuliah')
            ->where('pengguna_id', Auth::id())
            ->latest()
            ->get();

        $mataKuliah = MataKuliah::orderBy('nama_matkul')->get();

        return view('tugas.index', compact('tugas', 'mataKuliah'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'deskripsi' => 'required|string',
            'deadline' => 'nullable|date',
            'status' => 'required|in:belum,selesai',
        ]);

        // Pemilik tugas diisi otomatis dari pengguna yang login
        $data['pengguna_id'] = Auth::id();


        // Simpan tugas ke database
        Tugas::create($data);

        return redirect('/tugas')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, int $id)
    {
        // Hanya mengubah tugas milik pengguna yang sedang login
        $tugas = Tugas::where('pengguna_id', Auth::id())
            ->findOrFail($id);

        $tugas->status = $tugas->status === 'belum'
            ? 'selesai'
            : 'belum';

        $tugas->save();

        return redirect('/tugas')
            ->with('success', 'Status tugas berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        // Hanya menghapus tugas milik pengguna yang sedang login
        $tugas = Tugas::where('pengguna_id', Auth::id())
            ->findOrFail($id);

        $tugas->delete();

        return redirect('/tugas')
            ->with('success', 'Tugas berhasil dihapus!');
    }
}