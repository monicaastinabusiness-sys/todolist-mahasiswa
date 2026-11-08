<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        // Data dummy (latihan) berupa array
        $buku = [
            ["judul" => "Pemrograman Berbasis Platform", "penulis" => "Tim Dosen", "tahun" => 2025],
            ["judul" => "Pengantar Laravel", "penulis" => "Budi Santoso", "tahun" => 2024],
        ];

        return view('buku.index', compact('buku'));
    }
}