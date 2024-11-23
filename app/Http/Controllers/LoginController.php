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
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = [
            'form_params' => [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ]
        ];

        $client = new Client();
        // $url = 'https://capstone-blendit.et.r.appspot.com/login';

        return redirect()->to('/');

        /*try {
            $response = $client->post($url, $data);
            $body = json_decode($response->getBody()->getContents(), true);

            if ($body['status'] == 'success') {
                return redirect()->to('/'); // redirect ke root jika login berhasil
            } else {
                return redirect()->back()->with('error', 'Invalid email or password');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Login failed: ' . $e->getMessage());
        }*/
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log out pengguna

        // Invalidate dan regenerasi token session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login');
    }
}
