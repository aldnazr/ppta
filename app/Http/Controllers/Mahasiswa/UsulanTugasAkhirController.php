<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Data\UsulanlTA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class UsulanTugasAkhirController extends Controller
{
    public function index()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/mhs/usulan');
        $listUsulanTA = collect($response->json());

        $judulTugasAkhir = $listUsulanTA;

        // Pagination: Menampilkan 6 item per halaman
        $paginatedJudulTugasAkhir = new LengthAwarePaginator(
            $judulTugasAkhir->forPage(
                request('page', 1),
                6
            ),
            $judulTugasAkhir->count(),
            6,
            request('page', 1),
            ['path' => request()->url()]
        );

        return view(
            'mahasiswa.usulan',
            compact('paginatedJudulTugasAkhir')
        );
    }
}
