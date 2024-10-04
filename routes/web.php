<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\KelolaBarangController;
use App\Http\Controllers\LaporanKeluarController;
use App\Http\Controllers\LaporanMasukController;
use App\Models\DataBarang;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('data_barang', [DataBarangController::class, 'index'])->name('data.barang');
Route::post('tambah_barang', [DataBarangController::class, 'store'])->name('tambah.barang');
Route::put('/data-barang/{id}', [DataBarangController::class, 'update'])->name('barang.update');
Route::delete('data-barang/{id}', [DataBarangController::class, 'destroy'])->name('barang.destroy');

// Route untuk menampilkan halaman barang masuk
Route::get('/barang-masuk', [KelolaBarangController::class, 'showBarangMasuk'])->name('barangMasuk.index');
// Route untuk mendapatkan nama barang berdasarkan kode barang (untuk AJAX)
Route::get('/get-nama-barang/{kode_barang}', [KelolaBarangController::class, 'getNamaBarang']);
// Route untuk menyimpan data barang masuk
Route::post('/barang-masuk', [KelolaBarangController::class, 'store'])->name('barangMasuk.store');

// Route::get('barang_masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
Route::get('barang_keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
Route::get('laporan_masuk', [LaporanMasukController::class, 'index'])->name('laporan.masuk');
Route::get('laporan_keluar', [LaporanKeluarController::class, 'index'])->name('laporan.keluar');
Route::get('data_pegawai', [DataPegawaiController::class, 'index'])->name('data.pegawai');


