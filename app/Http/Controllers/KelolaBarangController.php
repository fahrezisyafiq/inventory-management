<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\KelolaBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class KelolaBarangController extends Controller
{
    // Fungsi untuk mengambil nama barang berdasarkan kode_barang
    public function getNamaBarang($kode_barang)
    {
        // Cari barang berdasarkan kode_barang
        $barang = DataBarang::where('kode_barang', $kode_barang)->first();

        // Jika barang ditemukan, kembalikan response JSON dengan nama barang
        if ($barang) {
            return response()->json(['nama_barang' => $barang->nama_barang]);
        }

        // Jika barang tidak ditemukan, kembalikan error
        return response()->json(['error' => 'Barang tidak ditemukan'], 404);
    }

    // Fungsi untuk menampilkan data barang masuk
    public function showBarangMasuk()
    {
    // Ambil semua data barang untuk dropdown
    $dataBarangs = DataBarang::all(); // Pastikan mengambil data dari tabel data_barangs

    // Ambil data barang masuk
    $barangMasuk = DB::table('kelola_barangs')
        ->join('data_barangs', 'kelola_barangs.kode_barang', '=', 'data_barangs.kode_barang')
        ->whereNotNull('kelola_barangs.jumlah_masuk')
        ->select('kelola_barangs.tanggal_masuk', 'kelola_barangs.jumlah_masuk', 'data_barangs.kode_barang', 'data_barangs.nama_barang')
        ->get();

    return view('kelola_barang.barang_masuk', compact('dataBarangs', 'barangMasuk'));
    }


    // Fungsi untuk menyimpan barang masuk
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|exists:data_barangs,kode_barang',
            'jumlah_masuk' => 'nullable|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        // Temukan barang berdasarkan kode
        $barang = DataBarang::where('kode_barang', $request->kode_barang)->first();

        // Buat transaksi barang masuk
        KelolaBarang::create([
            'kode_barang' => $request->kode_barang,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        // Tambahkan stok barang
        $barang->stok_barang += $request->jumlah_masuk;

        // Simpan perubahan stok
        $barang->save();

        return response()->json(['message' => 'Barang masuk berhasil disimpan.']);
    }
}
