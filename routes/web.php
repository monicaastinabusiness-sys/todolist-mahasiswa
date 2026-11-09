<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\MataKuliahController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman percobaan
Route::get('/halo', function () {
    return 'Halo, Laravel!';
});

// Halaman mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

// ROUTE UNTUK PENGGUNA YANG BELUM LOGIN
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('login.store');

    // Register
    Route::get('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'storeRegister'])
        ->name('register.store');
});

// ROUTE UNTUK PENGGUNA YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // TUGAS
    Route::get('/tugas', [TugasController::class, 'index'])
        ->name('tugas.index');

    Route::post('/tugas', [TugasController::class, 'store'])
        ->name('tugas.store');

    Route::patch('/tugas/{id}/status', [TugasController::class, 'updateStatus'])
        ->name('tugas.updateStatus');

    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])
        ->name('tugas.destroy');

    // MATA KULIAH
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])
        ->name('mata_kuliah.index');

    Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])
        ->name('mata_kuliah.store');

    Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update'])
        ->name('mata_kuliah.update');

    Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])
        ->name('mata_kuliah.destroy');

    // PENGGUNA
    Route::post('/pengguna', [PenggunaController::class, 'store'])
        ->name('pengguna.store');

    Route::get('/pengguna/{id}', [PenggunaController::class, 'show'])
        ->name('pengguna.show');

    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])
        ->name('pengguna.destroy');
});
