<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Mencoba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil login, redirect atau return response JSON
            return response()->json(['redirect' => route('dashboard')]); // Ganti 'dashboard' dengan route yang sesuai
        }

        // Jika gagal login
        return response()->json(['message' => 'Email atau Password salah!'], 401);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
