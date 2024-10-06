<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\LaporanKeluarController;
use App\Http\Controllers\LaporanMasukController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('data_barang', [DataBarangController::class, 'index'])->name('data.barang');
  Route::post('tambah_barang', [DataBarangController::class, 'store'])->name('tambah.barang');
  Route::put('/data-barang/{id}', [DataBarangController::class, 'update'])->name('barang.update');
  Route::delete('data-barang/{id}', [DataBarangController::class, 'destroy'])->name('barang.destroy');

  Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barangMasuk.index');
  Route::get('/get-nama-barang/{kode_barang}', [BarangMasukController::class, 'getNamaBarang']);
  Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barangMasuk.store');
  Route::put('/barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('barangMasuk.update');
  Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangMasuk.destroy');

  Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barangKeluar.index');
  Route::get('/get-nama-barang/{kode_barang}', [BarangKeluarController::class, 'getNamaBarang']);
  Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barangKeluar.store');
  Route::put('/barang-keluar/{id}', [BarangKeluarController::class, 'update'])->name('barangKeluar.update');
  Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barangKeluar.destroy');

  Route::get('/laporan-masuk', [LaporanMasukController::class, 'index'])->name('laporanMasuk.index');
  Route::post('/laporan-masuk/filter', [LaporanMasukController::class, 'filter'])->name('laporanMasuk.filter');
  Route::get('/laporan-masuk/print', [LaporanMasukController::class, 'print'])->name('laporanMasuk.print');
  
  Route::get('/laporan-keluar', [LaporanKeluarController::class, 'index'])->name('laporanKeluar.index');
  Route::post('/laporan-keluar/filter', [LaporanKeluarController::class, 'filter'])->name('laporanKeluar.filter');
  Route::get('/laporan-keluar/print', [LaporanKeluarController::class, 'print'])->name('laporanKeluar.print');

  Route::get('data_pegawai', [DataPegawaiController::class, 'index'])->name('data.pegawai');
  Route::post('tambah_pegawai', [DatapegawaiController::class, 'store'])->name('tambah.pegawai');
  Route::put('/data-pegawai/{id}', [DatapegawaiController::class, 'update'])->name('pegawai.update');
  Route::delete('data-pegawai/{id}', [DatapegawaiController::class, 'destroy'])->name('pegawai.destroy');
});




// Route::get('/laporan-masuk/cetak', [LaporanMasukController::class, 'cetakLaporan'])->name('laporanMasuk.cetakLaporan');

// Route::get('barang_masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
// Route::get('barang_keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
// Route::get('laporan_masuk', [LaporanMasukController::class, 'index'])->name('laporan.masuk');
// Route::get('laporan_keluar', [LaporanKeluarController::class, 'index'])->name('laporan.keluar');
// Route::get('data_pegawai', [DataPegawaiController::class, 'index'])->name('data.pegawai');


