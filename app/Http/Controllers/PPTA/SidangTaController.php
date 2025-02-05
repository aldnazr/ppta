<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class SidangTaController extends Controller
{
    private function antriTA()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ppta/ta');
        return collect($response->json());
    }

    public function index(Request $request)
    {
        $tugasAkhir = $this->antriTA();

        $perPage = $request->input('per_page', 10);

        // Pencarian berdasarkan nama atau judul
        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $tugasAkhir = $tugasAkhir->filter(function ($tugasAkhir) use ($searchTerm) {
                return
                    str_contains(strtolower($tugasAkhir['kode_antrian']), strtolower($searchTerm)) ||
                    str_contains(strtolower($tugasAkhir['mhs_nim']), strtolower($searchTerm)) ||
                    str_contains(strtolower($tugasAkhir['mhs_nama']), strtolower($searchTerm)) ||
                    str_contains(strtolower($tugasAkhir['jdl_proposal']), strtolower($searchTerm)) ||
                    str_contains(strtolower($tugasAkhir['pembimbing_1_nama']), strtolower($searchTerm)) ||
                    str_contains(strtolower($tugasAkhir['pembimbing_2_nama']), strtolower($searchTerm));
            });
        }

        // Convert to collection for pagination
        $tugasAkhir = $tugasAkhir->values();

        // Pagination (menggunakan LengthAwarePaginator secara manual karena data berupa array)
        $currentPage = $request->input('page', 1); // Default 10 item per halaman
        $slicedTugasAkhir = $tugasAkhir->slice(($currentPage - 1) * $perPage, $perPage);
        $total = $tugasAkhir->count();
        $paginatedTugasAkhir = new LengthAwarePaginator(
            $slicedTugasAkhir,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('ppta.sidangta', [
            'tugasAkhir' => $paginatedTugasAkhir,
            'perPage' => $perPage
        ])->with([
            'user' => 'ppta'
        ]);
    }
}
