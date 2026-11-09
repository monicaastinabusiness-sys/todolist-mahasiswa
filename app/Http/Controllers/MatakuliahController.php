<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    // Menampilkan daftar mata kuliah
    public function index()
    {
        $mataKuliah = MataKuliah::latest()->get();

        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    // Menambahkan mata kuliah baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'dosen' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        MataKuliah::create($data);

        return redirect()
            ->route('mata_kuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    // Mengubah data mata kuliah
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'dosen' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->update($data);

        return redirect()
            ->route('mata_kuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    // Menghapus mata kuliah
    public function destroy($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();

        return redirect()
            ->route('mata_kuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
