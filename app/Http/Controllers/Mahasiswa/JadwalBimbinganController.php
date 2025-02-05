<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class JadwalBimbinganController extends Controller
{
    private function jadwalBimbingan()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/mhs/jadbim');
        return collect($response->json());
    }

    public function index()
    {
        $jadBim = $this->jadwalBimbingan();
        return view('mahasiswa.jadbimbingan', compact('jadBim'));
    }

    public function getJadwalDosen(Request $request)
    {
        $namaGelar = $request->query('dosen'); // Ambil nama lengkap dengan gelar dari query string

        // Ambil semua data jadwal bimbingan
        $jadwalBimbingan = $this->jadwalBimbingan();

        // Filter data berdasarkan nama_gelar
        $filteredSchedules = $jadwalBimbingan->where('nama_gelar', $namaGelar);

        return response()->json(['schedules' => $filteredSchedules->values()]);
    }
}
