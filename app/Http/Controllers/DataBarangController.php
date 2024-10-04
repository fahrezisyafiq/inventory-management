<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi data input
         $request->validate([
            'kodeBarang' => 'required|unique:data_barangs,kode_barang',
            'namaBarang' => 'required|unique:data_barangs,nama_barang',
            'jenisBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|numeric|min:0',
        ]);

        // Simpan data ke database
        DataBarang::create([
            'kode_barang' => $request->kodeBarang,
            'nama_barang' => $request->namaBarang,
            'jenis_barang' => $request->jenisBarang,
            'harga_barang' => $request->hargaBarang,
            'stok_barang' => $request->stokBarang ?? 0, 
        ]);

        // Redirect atau response JSON untuk AJAX
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        'jenis_barang' => 'required',
        'harga_barang' => 'required|numeric',
        'stok_barang' => 'required|numeric',
    ]);

    // Temukan barang berdasarkan ID
    $barang = DataBarang::find($id);

    // Jika barang tidak ditemukan, return error
    if (!$barang) {
        return response()->json(['message' => 'Barang tidak ditemukan.'], 404);
    }

    // Perbarui hanya field yang diubah
    $barang->kode_barang = $request->input('kode_barang', $barang->kode_barang);
    $barang->nama_barang = $request->input('nama_barang', $barang->nama_barang);
    $barang->jenis_barang = $request->input('jenis_barang', $barang->jenis_barang);
    $barang->harga_barang = $request->input('harga_barang', $barang->harga_barang);
    $barang->stok_barang = $request->input('stok_barang', $barang->stok_barang);

    // Simpan perubahan
    if ($barang->save()) {
        return response()->json(['message' => 'Barang berhasil diperbarui.']);
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

        $barang->delete();

        return response()->json(['message' => 'Barang Berhasil di hapus'], 200);
    }
}
