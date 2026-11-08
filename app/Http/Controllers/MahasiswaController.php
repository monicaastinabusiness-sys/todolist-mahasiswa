<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return "Daftar Seluruh Mahasiswa";
    }
    public function show(string $id)
    {
        return "Detail Mahasiswa dengan id: $id";
    }

    public function store()
    {
        return "Menyimpan data mahasiswa baru";
    }
}
