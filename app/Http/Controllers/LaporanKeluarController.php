<?php

namespace App\Http\Controllers;

use App\Models\KelolaBarang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanKeluarController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        $laporanKeluar = KelolaBarang::with('dataBarang')
            ->whereNotNull('jumlah_keluar')
            ->get();

        return view('laporan_barang.laporan_keluar', compact('laporanKeluar'));
    }

    public function filter(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $laporanKeluar = KelolaBarang::with('dataBarang')
            ->whereBetween('tanggal_keluar', [$startDate, $endDate])
            ->get();

        return response()->json($laporanKeluar);
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
    $laporanKeluar = KelolaBarang::with('dataBarang')
        ->whereBetween('tanggal_Keluar', [$startDate, $endDate])
        ->get();

    $pdf = PDF::loadView('laporan_barang.laporan_keluar_pdf', compact('laporanKeluar', 'startDate', 'endDate'));

    return $pdf->stream('laporan_barang_keluar.pdf');
    }

}
