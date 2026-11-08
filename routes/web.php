<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\MataKuliahController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route percobaan
Route::get('/halo', function () {
    return 'Halo, Laravel!';
});

// Halaman mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

// Menampilkan daftar tugas
Route::get('/tugas', [TugasController::class, 'index'])
    ->name('tugas.index');

// Menambahkan tugas
Route::post('/tugas', [TugasController::class, 'store'])
    ->name('tugas.store');

// Mengubah status tugas
Route::patch('/tugas/{id}/status', [TugasController::class, 'updateStatus'])
    ->name('tugas.updateStatus');

// Menghapus tugas
Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])
    ->name('tugas.destroy');

// Menambahkan pengguna
Route::post('/pengguna', [PenggunaController::class, 'store'])
    ->name('pengguna.store');

// Menampilkan halaman login pengguna
Route::get('/pengguna/{id}/login', [PenggunaController::class, 'login'])
    ->name('pengguna.login');

// Memproses login pengguna
Route::post('/pengguna/{id}/login', [PenggunaController::class, 'authenticate'])
    ->name('pengguna.authenticate');

// Menampilkan tugas milik pengguna
Route::get('/pengguna/{id}', [PenggunaController::class, 'show'])
    ->name('pengguna.show');

// Menghapus pengguna
Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])
    ->name('pengguna.destroy');

// Menambahkan mata kuliah
Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])
    ->name('mataKuliah.store');
