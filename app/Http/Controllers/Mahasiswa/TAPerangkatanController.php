<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class TAPerangkatanController extends Controller
{
    private function data($kodeProdi)
    {
        // Panggil API taperangkatan dengan parameter kode_prodi
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/mhs/taperangkatan', [
            'kode_prodi' => $kodeProdi
        ]);

        if ($response->failed()) {
            // Anda bisa mengembalikan array kosong atau melempar exception
            return [];
        }

        return $response->json();
    }

    public function index(Request $request)
    {
        // Ambil data prodi dari API
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/prodi');
        $dataProdi = $response->json();

        // Buat array asosiatif: key = id, value = nama prodi
        $prodi = collect($dataProdi)->pluck('nama_prodi', 'id')->toArray();

        // Jika tidak ada parameter jurusan, gunakan prodi pertama (id-nya)
        $activeIdProdi = $request->query('jurusan', array_key_first($prodi));

        // Ambil nama_prodi aktif berdasarkan jurusan yang dipilih
        $activeNamaProdi = $prodi[$activeIdProdi] ?? null;

        // Ambil data taperangkatan untuk prodi yang aktif
        $angkatan = $this->data($activeIdProdi);

        // Hitung total jumlah mahasiswa dari semua angkatan
        $totalData = array_sum(array_column($angkatan, 'jumlah_mahasiswa'));

        return view('mahasiswa.taperangkatan', compact(
            'prodi',
            'angkatan',
            'totalData',
            'activeIdProdi',
            'activeNamaProdi'
        ));
    }

    public function getByJurusan(Request $request)
    {
        $jurusan = $request->query('jurusan');

        // Ambil data taperangkatan sesuai kode prodi yang dikirim
        $data = $this->data($jurusan);

        return response()->json([
            'data' => $data
        ]);
    }
}
