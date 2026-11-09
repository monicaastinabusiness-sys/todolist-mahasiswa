<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Menghitung seluruh tugas pengguna
        $totalTugas = Tugas::where('pengguna_id', $userId)
            ->count();

        // Menghitung tugas yang belum selesai
        $tugasBelum = Tugas::where('pengguna_id', $userId)
            ->where('status', 'belum')
            ->count();

        // Menghitung tugas yang sudah selesai
        $tugasSelesai = Tugas::where('pengguna_id', $userId)
            ->where('status', 'selesai')
            ->count();

        // Mengambil lima tugas terbaru
        $tugasTerbaru = Tugas::with('mataKuliah')
            ->where('pengguna_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalTugas',
            'tugasBelum',
            'tugasSelesai',
            'tugasTerbaru'
        ));
    }
}
