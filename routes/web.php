<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
// MAHASISWA
// =========================
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        Route::get('/surat', [SuratController::class, 'index'])
            ->name('surat.index');

        Route::get('/surat/create', [SuratController::class, 'create'])
            ->name('surat.create');

        Route::post('/surat', [SuratController::class, 'store'])
            ->name('surat.store');

        Route::get('/surat/{id}', [SuratController::class, 'show'])
            ->name('surat.show');
    });

// =========================
// PETUGAS ADMINISTRASI
// =========================
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/surat', [SuratController::class, 'petugas'])
            ->name('surat.index');

        Route::patch('/surat/{id}/proses', [SuratController::class, 'proses'])
            ->name('surat.proses');
    });

// =========================
// KEPALA BAGIAN
// =========================
Route::middleware(['auth', 'role:kepala_bagian'])
    ->prefix('kepala-bagian')
    ->name('kepala.')
    ->group(function () {

        Route::get('/surat', [SuratController::class, 'kepalaBagian'])
            ->name('surat.index');

        Route::patch('/surat/{id}/setujui', [SuratController::class, 'setujui'])
            ->name('surat.setujui');

        Route::patch('/surat/{id}/tolak', [SuratController::class, 'tolak'])
            ->name('surat.tolak');
    });

require __DIR__.'/auth.php';