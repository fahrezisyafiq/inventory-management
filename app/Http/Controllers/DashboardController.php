<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\KelolaBarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalStok = DataBarang::count();
        $totalBarangMasuk = KelolaBarang::whereNotNull('jumlah_masuk')->count();
        $totalBarangKeluar = KelolaBarang::whereNotNull('jumlah_keluar')->count();
        $totalPegawai = User::count();

        // Ambil barang yang stoknya di bawah atau sama dengan ROP
        $barangs = DataBarang::whereNotNull('rop')
                    ->whereColumn('stok_barang', '<=', 'rop')
                    ->get();
        
        return view('dashboard', compact('totalStok', 'totalBarangMasuk', 'totalBarangKeluar', 'totalPegawai', 'barangs'));
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
