<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    // Menyimpan mata kuliah baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'dosen' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:14',
        ]);

        MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
            'dosen' => $request->dosen,
            'semester' => $request->semester,
        ]);

        return redirect('/tugas')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
    }
}
