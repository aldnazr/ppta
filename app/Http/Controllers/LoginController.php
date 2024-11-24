<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Data statis untuk autentikasi
        $staticUser = [
            'email' => 'admin',
            'password' => 'admin',
        ];

        // Validasi kredensial
        if (
            $request->input('email') === $staticUser['email'] &&
            $request->input('password') === $staticUser['password']
        ) {
            // Simpan informasi login ke sesi
            session(['is_logged_in' => true]);
            return redirect()->intended('/'); // Arahkan ke halaman utama
        }

        // Jika kredensial salah
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_logged_in'); // Hapus informasi login
        $request->session()->invalidate(); // Hancurkan sesi
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login'); // Arahkan ke halaman login
    }
}
