<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class HitungEoqRopController extends Controller
{

    public function getNamaBarang($kode_barang){
        $barang = DataBarang::where('kode_barang', $kode_barang)->first();

        if ($barang) {
            return response()->json(['nama_barang' => $barang->jenis_barang]);
        }

        return response()->json(['error' => 'Barang tidak ditemukan'], 404);
    }

    public function hitung(Request $request){
        $request->validate([
        'kode_barang' => 'required|exists:data_barangs,kode_barang',
        'permintaan' => 'required|numeric|min:1',      // D
        'biaya_pesan' => 'required|numeric|min:1',     // S
        'biaya_simpan' => 'required|numeric|min:1',    // H
        'lead_time' => 'required|numeric|min:1',
        'penjualan_hari' => 'required|numeric|min:1',
        ]);

        $barang = DataBarang::where('kode_barang', $request->kode_barang)->firstOrFail();

        $D = $request->permintaan;
        $S = $request->biaya_pesan;
        $H = $request->biaya_simpan;
        $leadTime = $request->lead_time;
        $usagePerDay = $request->penjualan_hari;

        $eoq = sqrt((2 * $D * $S) / $H);
        $rop = $leadTime * $usagePerDay;

        $barang->eoq = round($eoq);
        $barang->rop = $rop;
        $barang->save();

        return response()->json([
            'message' => 'EOQ & ROP berhasil dihitung.',
            'eoq' => round($eoq),
            'rop' => $rop
        ]);
    }

    public function index()
    {
        $dataBarangs = DataBarang::all(); // Ambil semua data barang

        $barangs = DataBarang::whereNotNull('eoq')
                ->whereNotNull('rop')
                ->get();

        return view('hitung_RopEoq', compact('dataBarangs', 'barangs'));
    }

    public function destroy($kode_barang)
    {
        $barang = DataBarang::where('kode_barang', $kode_barang)->first();
    
        if (!$barang) {
            return response()->json(['error' => 'Barang tidak ditemukan'], 404);
        }
    
        $barang->eoq = null;
        $barang->rop = null;
        $barang->save();
    
        return response()->json(['message' => 'EOQ & ROP berhasil dihapus.']);
    }
}
