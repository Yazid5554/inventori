<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\RiwayatKondisiController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\ProfileController;

// Public
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Auth — semua role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/profile/avatar', [\App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    Route::get('/barang/{barang}/print-qr', [BarangController::class, 'printQr'])->name('barang.print-qr');
    Route::get('/barang/print-qr-semua', [BarangController::class, 'printQrSemua'])->name('barang.print-qr-semua');

    // Barang — super_admin & admin bisa akses
    Route::middleware(['role:super_admin,admin'])->group(function () {
        Route::resource('barang', BarangController::class);
        Route::get('/barang/{barang}/qr', [BarangController::class, 'generateQr'])->name('barang.qr');
        Route::resource('ruangan', LokasiController::class)->except(['show'])->names([
            'index'   => 'lokasi.index',
            'create'  => 'lokasi.create',
            'store'   => 'lokasi.store',
            'edit'    => 'lokasi.edit',
            'update'  => 'lokasi.update',
            'destroy' => 'lokasi.destroy',
        ]);
    });

    // User management — super_admin only
    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('users', UserController::class);
        // Riwayat Kondisi
        Route::post('/barang/{barang}/kondisi', [RiwayatKondisiController::class, 'store'])->name('kondisi.store');
        Route::delete('/kondisi/{riwayatKondisi}', [RiwayatKondisiController::class, 'destroy'])->name('kondisi.destroy');
    });
});

// Kerusakan
Route::post('/barang/{barang}/kerusakan', [KerusakanController::class, 'store'])->name('kerusakan.store');
Route::delete('/kerusakan/{kerusakan}', [KerusakanController::class, 'destroy'])->name('kerusakan.destroy');

// Perbaikan
Route::get('/perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
Route::post('/barang/{barang}/perbaikan', [PerbaikanController::class, 'store'])->name('perbaikan.store');
Route::patch('/perbaikan/{perbaikan}', [PerbaikanController::class, 'update'])->name('perbaikan.update');
Route::delete('/perbaikan/{perbaikan}', [PerbaikanController::class, 'destroy'])->name('perbaikan.destroy');

// Export
Route::middleware(['auth', 'role:super_admin,admin'])->group(function () {
    Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf',   [ExportController::class, 'exportPdf'])->name('export.pdf');
});

Route::get('/scan', function () {
    return view('scan.index');
})->name('scan.index')->middleware('auth');

// Komponen
Route::post('/barang/{barang}/komponen', [KomponenController::class, 'store'])->name('komponen.store');
Route::patch('/komponen/{komponen}', [KomponenController::class, 'update'])->name('komponen.update');
Route::delete('/komponen/{komponen}', [KomponenController::class, 'destroy'])->name('komponen.destroy');