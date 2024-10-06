<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = User::all();
        return view('data_pegawai', compact('pegawais'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:5',
            'phone' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'phone' => $request->phone,
        ]);

        // Redirect atau response JSON untuk AJAX
        return redirect()->back()->with('success', 'Pegawai berhasil ditambahkan');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:5',
            'phone' => 'required|string|max:255',
        ]);

        $pegawai = User::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan.'], 404);
        }

        // Perbarui hanya field yang diubah
        $pegawai->name = $request->input('name', $pegawai->name);
        $pegawai->email = $request->input('email', $pegawai->email);
        $pegawai->password = $request->input('password', $pegawai->password);
        $pegawai->phone = $request->input('phone', $pegawai->phone);

        // Simpan perubahan
    if ($pegawai->save()) {
        return response()->json(['message' => 'Pegawai berhasil diperbarui.']);
    } else {
        return response()->json(['message' => 'Terjadi kesalahan saat memperbarui Pegawai.'], 500);
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = User::findOrFail($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan.'], 404);
        }
    
        $pegawai->delete();

        return response()->json(['message' => 'Pegawai Berhasil di hapus'], 200);
    }
}
