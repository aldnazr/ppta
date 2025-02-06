<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ProposalTaController extends Controller
{
    public function antriProposals()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ppta/proposal');
        return collect($response->json());
    }

    public function index(Request $request)
    {
        $proposals = $this->antriProposals();
        $perPage = $request->input('per_page', 10);

        // Pencarian berdasarkan nama atau judul
        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $proposals = $proposals->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['kode_antrian']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['mhs_nim']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['mhs_nama']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['jdl_proposal']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['pembimbing_1_nama']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['pembimbing_2_nama']), strtolower($searchTerm));
            });
        }

        // Convert to collection for pagination
        $proposals = $proposals->values();

        // Pagination (menggunakan LengthAwarePaginator secara manual karena data berupa array)
        $currentPage = $request->input('page', 1); // Default 10 item per halaman
        $slicedProposals = $proposals->slice(($currentPage - 1) * $perPage, $perPage);
        $total = $proposals->count();
        $paginatedProposals = new LengthAwarePaginator(
            $slicedProposals,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('ppta.proposalta', [
            'proposals' => $paginatedProposals,
            'perPage' => $perPage
        ])->with([
            'user' => 'ppta'
        ]);
    }
}
