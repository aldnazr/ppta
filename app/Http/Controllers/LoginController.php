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

        foreach ($staticUsers as $user) {
            if ($username === $user['username'] && $password === $user['password']) {
                session(['is_logged_in' => true]);
                return redirect()->intended($user['redirect'])->with('success', 'Berhasil login!');
            }
        }

        // Jika tidak cocok dengan kredensial di atas
        return redirect()->back()->withErrors(['error' => 'Username atau password salah!']);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
