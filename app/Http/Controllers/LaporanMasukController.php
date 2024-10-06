<?php

namespace App\Http\Controllers;

use App\Models\KelolaBarang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanMasukController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        $laporanMasuk = KelolaBarang::with('dataBarang')
            ->whereNotNull('jumlah_masuk')
            ->get();

        return view('laporan_barang.laporan_masuk', compact('laporanMasuk'));
    }

    public function filter(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $laporanMasuk = KelolaBarang::with('dataBarang')
            ->whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->get();

        return response()->json($laporanMasuk);
    }

    public function print(Request $request)
    {
       // Validasi input tanggal
       $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    $startDate = $request->start_date;
    $endDate = $request->end_date;

    // Query data sesuai rentang tanggal
    $laporanMasuk = KelolaBarang::with('dataBarang')
        ->whereBetween('tanggal_masuk', [$startDate, $endDate])
        ->get();

    $pdf = PDF::loadView('laporan_barang.laporan_masuk_pdf', compact('laporanMasuk', 'startDate', 'endDate'));

    return $pdf->stream('laporan_barang_masuk.pdf');
    }

}
