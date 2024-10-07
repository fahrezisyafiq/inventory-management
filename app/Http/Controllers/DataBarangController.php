<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = DataBarang::all(); // Ambil semua data barang
        return view('data_barang', compact('barangs'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi data input
    $validator = Validator::make($request->all(), [
        'kodeBarang' => 'required|unique:data_barangs,kode_barang',
        'namaBarang' => 'required|unique:data_barangs,nama_barang',
        'jenisBarang' => 'required|string|max:255',
        'hargaBarang' => 'required|numeric|min:0',
    ]);

    // Jika validasi gagal, kembalikan respons JSON dengan status kode 422 (Unprocessable Entity)
    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    // Simpan data ke database
    DataBarang::create([
        'kode_barang' => $request->kodeBarang,
        'nama_barang' => $request->namaBarang,
        'jenis_barang' => $request->jenisBarang,
        'harga_barang' => $request->hargaBarang,
        'stok_barang' => $request->stokBarang ?? 0,  // Nilai default stok_barang adalah 0 jika kosong
    ]);

    // Kembalikan respons sukses dalam bentuk JSON
    return response()->json([
        'message' => 'Barang berhasil ditambahkan!'
    ], 200);
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi data yang diterima
    $request->validate([
        'kode_barang' => 'required|unique:data_barangs,kode_barang,' . $id, // Tambahkan pengecualian untuk ID yang sama
        'nama_barang' => 'required|unique:data_barangs,nama_barang,' . $id, // Tambahkan pengecualian untuk ID yang sama
        'jenis_barang' => 'required|string|max:255',
        'harga_barang' => 'required|numeric',
        'stok_barang' => 'required|numeric',
    ]);

    // Temukan barang berdasarkan ID
    $barang = DataBarang::find($id);

    // Jika barang tidak ditemukan, return error
    if (!$barang) {
        return response()->json(['message' => 'Barang tidak ditemukan.'], 404);
    }

    // Perbarui data barang dengan input baru
    $barang->fill($request->only(['kode_barang', 'nama_barang', 'jenis_barang', 'harga_barang', 'stok_barang']));

    // Simpan perubahan
    if ($barang->save()) {
        return response()->json(['message' => 'Barang berhasil diperbarui.'], 200);
    } else {
        return response()->json(['message' => 'Terjadi kesalahan saat memperbarui barang.'], 500);
    }
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = DataBarang::findOrFail($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan.'], 404);
        }
    
        // Hapus semua barang masuk yang terkait dengan kode_barang
        $barang->kelolaBarang()->delete();
    

        $barang->delete();

        return response()->json(['message' => 'Barang Berhasil di hapus'], 200);
    }
}
