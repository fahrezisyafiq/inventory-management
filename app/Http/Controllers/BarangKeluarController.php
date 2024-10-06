<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\KelolaBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBarangs = DataBarang::all();

        $barangKeluar = KelolaBarang::with('dataBarang')
            ->whereNotNull('jumlah_keluar')
            ->get();

        return view('kelola_barang.barang_keluar', compact('barangKeluar', 'dataBarangs'));
    }

    public function getNamaBarang($kode_barang){
        $barang = DataBarang::where('kode_barang', $kode_barang)->first();

        if ($barang) {
            return response()->json(['nama_barang' => $barang->nama_barang]);
        }

        return response()->json(['error' => 'Barang tidak ditemukan'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|exists:data_barangs,kode_barang',
            'jumlah_keluar' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
        ]);

        $barang = DataBarang::where('kode_barang', $request->kode_barang)->first();

        if ($barang->stok_barang < $request->jumlah_keluar) {
            return response()->json(['message' => 'Stok tidak cukup.'], 400);
        }

        // Simpan transaksi barang keluar
        KelolaBarang::create([
            'kode_barang' => $request->kode_barang,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        // Kurangi stok barang
        $barang->stok_barang -= $request->jumlah_keluar;
        $barang->save(); // Simpan perubahan stok

        return response()->json(['message' => 'Barang keluar berhasil disimpan.']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'jumlah_keluar' => 'required|integer|min:1',
        'tanggal_keluar' => 'required|date',
    ]);

    $kelolaBarang = KelolaBarang::find($id);

    if (!$kelolaBarang) {
        return response()->json(['message' => 'Transaksi barang keluar tidak ditemukan.'], 404);
    }

    $barang = DataBarang::where('kode_barang', $kelolaBarang->kode_barang)->first();

    // Tambahkan kembali stok lama sebelum update
    if ($barang && $kelolaBarang->jumlah_keluar) {
        $barang->stok_barang += $kelolaBarang->jumlah_keluar;
    }

    // Pastikan stok mencukupi untuk perubahan
    if ($barang->stok_barang < $request->jumlah_keluar) {
        return response()->json(['message' => 'Stok tidak mencukupi untuk perubahan.'], 400);
    }

    // Update transaksi
    $kelolaBarang->tanggal_keluar = $request->input('tanggal_keluar');
    $kelolaBarang->jumlah_keluar = $request->input('jumlah_keluar');
    $kelolaBarang->save();

    // Kurangi stok barang dengan jumlah baru
    $barang->stok_barang -= $request->jumlah_keluar;
    $barang->save();


    return response()->json(['message' => 'Barang keluar berhasil diperbarui.']);
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelolaBarang = KelolaBarang::find($id);

        if (!$kelolaBarang) {
            return response()->json(['message' => 'Barang keluar tidak ditemukan.'], 404);
        }

        $barang = DataBarang::where('kode_barang', $kelolaBarang->kode_barang)->first();

        if ($barang && $kelolaBarang->jumlah_keluar) {
            $barang->stok_barang += $kelolaBarang->jumlah_keluar;
            $barang->save(); // Simpan perubahan stok
        }

        if ($kelolaBarang->delete()) {
            return response()->json(['message' => 'Barang keluar berhasil dihapus.']);
        } else {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus barang keluar.'], 500);
        }
    }
}
