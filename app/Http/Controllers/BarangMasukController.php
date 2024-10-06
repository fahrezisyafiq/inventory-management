<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\KelolaBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBarangs = DataBarang::all(); // Pastikan mengambil data dari tabel data_barangs

        // Ambil data barang masuk
        $barangMasuk = KelolaBarang::with('dataBarang') // Menggunakan eager loading
        ->whereNotNull('jumlah_masuk')
        ->get();

        return view('kelola_barang.barang_masuk', compact('dataBarangs', 'barangMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $request->validate([
                'kode_barang' => 'required|exists:data_barangs,kode_barang',
                'jumlah_masuk' => 'required|integer|min:1',
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
    
            if ($request->jumlah_masuk > 0){
                $barang->stok_barang += $request->jumlah_masuk;
                $barang->save();
            }
            $barang->save();
    
            return response()->json(['message' => 'Barang masuk berhasil disimpan.']);
        
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);
    
        // Temukan transaksi barang masuk berdasarkan ID
        $kelolaBarang = KelolaBarang::find($id);
    
        // Jika transaksi tidak ditemukan, return error
        if (!$kelolaBarang) {
            return response()->json(['message' => 'Transaksi barang masuk tidak ditemukan.'], 404);
        }
    
        // Temukan data barang terkait berdasarkan kode barang
        $barang = DataBarang::where('kode_barang', $kelolaBarang->kode_barang)->first();
    
        // Kurangi stok barang dengan jumlah yang lama
        if ($kelolaBarang->jumlah_masuk > 0) {
            $barang->stok_barang -= $kelolaBarang->jumlah_masuk;
        }
    
        // Update transaksi barang masuk dengan data baru
        $kelolaBarang->tanggal_masuk = $request->input('tanggal_masuk', $kelolaBarang->tanggal_masuk);
        $kelolaBarang->jumlah_masuk = $request->input('jumlah_masuk', $kelolaBarang->jumlah_masuk);
    
        // Tambahkan stok barang dengan jumlah baru (jika diinput)
        if ($request->jumlah_masuk > 0) {
            $barang->stok_barang += $request->jumlah_masuk;
        }
    
        // Simpan perubahan transaksi barang masuk
        $kelolaBarang->save();
    
        // Simpan perubahan stok barang
        $barang->save();
    
        return response()->json(['message' => 'Barang masuk berhasil diperbarui.']);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan transaksi barang masuk berdasarkan ID
        $kelolaBarang = KelolaBarang::find($id);
    
        // Jika transaksi barang masuk tidak ditemukan, kembalikan error
        if (!$kelolaBarang) {
            return response()->json(['message' => 'Barang masuk tidak ditemukan.'], 404);
        }
    
        // Temukan barang berdasarkan kode barang dari transaksi barang masuk
        $barang = DataBarang::where('kode_barang', $kelolaBarang->kode_barang)->first();
    
        // Kurangi stok barang dengan jumlah barang masuk yang akan dihapus
        if ($barang && $kelolaBarang->jumlah_masuk) {
            $barang->stok_barang -= $kelolaBarang->jumlah_masuk;
            $barang->save(); // Simpan perubahan stok
        }
    
        // Hapus transaksi barang masuk
        if ($kelolaBarang->delete()) {
            return response()->json(['message' => 'Barang masuk berhasil dihapus.']);
        } else {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus barang masuk.'], 500);
        }
    }
}
