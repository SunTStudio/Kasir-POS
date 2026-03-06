<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DahsboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ManagementMejaController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// login dan logout
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

// dashboard
// Middleware group auth
Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DahsboardController::class, 'index'])->name('dashboard');

    Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('pesanan/edit/{id}', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::post('pesanan/update/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::get('pesanan/delete/{id}', [PesananController::class, 'destroy'])->name('pesanan.delete');
    // pesanan.update.status
    Route::post('pesanan/update/status/{id}', [PesananController::class, 'updateStatus'])->name('pesanan.update.status');
    Route::get('pesanan/struk/{id}', [PesananController::class, 'struk'])->name('pesanan.struk');

    Route::get('management/meja/', [ManagementMejaController::class, 'index'])->name('manajement.meja');
    Route::get('management/meja/create', [ManagementMejaController::class, 'create'])->name('manajement.meja.create');
    Route::post('management/meja/store', [ManagementMejaController::class, 'store'])->name('manajement.meja.store');
    Route::get('management/meja/edit/{id}', [ManagementMejaController::class, 'edit'])->name('manajement.meja.edit');
    Route::post('management/meja/update/{id}', [ManagementMejaController::class, 'update'])->name('manajement.meja.update');
    Route::get('management/meja/delete/{id}', [ManagementMejaController::class, 'delete'])->name('manajement.meja.delete');
    Route::get('management/meja/filter', [ManagementMejaController::class, 'filter'])->name('manajement.meja.filter');

    // akses_meja.update_status
    Route::post('management/meja/update-status', [ManagementMejaController::class, 'updateStatusAksesMeja'])->name('akses_meja.update_status');

    // area
    Route::get('area', [AreaController::class, 'index'])->name('area');
    Route::get('area/create', [AreaController::class, 'create'])->name('area.create');
    Route::post('area/store', [AreaController::class, 'store'])->name('area.store');
    Route::get('area/edit/{id}', [AreaController::class, 'edit'])->name('area.edit');
    // show
    Route::get('area/show/{id}', [AreaController::class, 'show'])->name('area.show');
    Route::post('area/update/{id}', [AreaController::class, 'update'])->name('area.update');
    Route::get('area/delete/{id}', [AreaController::class, 'destroy'])->name('area.delete');

    // daftar menu
    Route::get('produks', [ProdukController::class, 'index'])->name('produk');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::get('produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');

    // kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');

    // Keuangan / Laporan
    Route::get('keuangan', [PenjualanController::class, 'index'])->name('keuangan');

    // jenis
    Route::get('jenis', [JenisController::class, 'index'])->name('jenis.order');
    Route::get('jenis/create', [JenisController::class, 'create'])->name('jenis.create');
    Route::post('jenis/store', [JenisController::class, 'store'])->name('jenis.store');
    Route::get('jenis/edit/{id}', [JenisController::class, 'edit'])->name('jenis.edit');
    Route::post('jenis/update/{id}', [JenisController::class, 'update'])->name('jenis.update');
    Route::get('jenis/delete/{id}', [JenisController::class, 'destroy'])->name('jenis.delete');

    // Profile
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profile', [AuthController::class, 'profileUpdate'])->name('profile.update');
});
