<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    private function listDosen()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/dosens');
        return collect($response->json());
    }

    public function login(Request $request)
    {
        $listDosen = $this->listDosen();

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $staticUsers = [
            'ppta' => [
                'username' => 'ppta',
                'password' => 'ppta',
                'redirect' => '/ppta',
            ],
            'dosen' => [
                'username' => 'dosen',
                'password' => 'dosen',
                'redirect' => '/dosen',
            ],
        ];

        $username = $request->input('username');
        $password = $request->input('password');

        foreach ($listDosen as $user) {
            if ($username === $user['nik'] && $password === $user['nik']) {
                session(['is_logged_in' => true]);
                session(['nik' => $user['nik']]); // Simpan username ke session
                session(['nama' => $user['nama']]);
                return redirect()->intended('/dosen')->with('success', 'Berhasil login!');
            }
        }

        foreach ($staticUsers as $user) {
            if ($username === $user['username'] && $password === $user['password']) {
                session(['is_logged_in' => true]);
                session(['nama' => $user['username']]); // Simpan username ke session
                return redirect()->intended($user['redirect'])->with('success', 'Berhasil login!');
            }
        }

        // Jika tidak cocok dengan kredensial di atas
        return redirect()->back()->withErrors(['error' => 'Username atau password salah!']);
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // Hapus semua data session
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
