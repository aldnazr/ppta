<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class BerkasController extends Controller
{
    private function antriProposal()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/dosen/berkas');

        return collect($response->json());
    }

    private function penilaianNilai()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/dosen/penilaian_nilai');

        return collect($response->json());
    }

    public function index(Request $request)
    {
        // Get the number of items per page from the request, default to 10
        $perPage = $request->input('per_page', 10);

        // Start with dummy proposals
        $proposals = $this->antriProposal();

        // Apply search if search term is provided
        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $proposals = $proposals->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['mhs_nim']), $searchTerm) ||
                    str_contains(strtolower($proposal['mhs_nama']), $searchTerm) ||
                    str_contains(strtolower($proposal['jdl_proposal']), $searchTerm) ||
                    str_contains(strtolower($proposal['pembimbing_1_nama']), $searchTerm) ||
                    str_contains(strtolower($proposal['pembimbing_2_nama']), $searchTerm) ||
                    str_contains(strtolower($proposal['penguji_1_nama']), $searchTerm);
            });
        }

        if ($request->has('filter')) {
            $filterTerm = strtolower($request->filter);

            if ($filterTerm === 'proposal') {
                $proposals = $proposals->where('tipe', 'proposal');
            } elseif ($filterTerm === 'tugas_akhir') {
                $proposals = $proposals->where('tipe', 'tugas_akhir');
            }
        }

        // Convert to collection for pagination
        $proposals = $proposals->values();

        // Create a custom paginator
        $currentPage = $request->input('page', 1);
        $slicedProposals = $proposals->slice(($currentPage - 1) * $perPage, $perPage);
        $total = $proposals->count();
        $paginatedProposals = new LengthAwarePaginator(
            $slicedProposals,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('dosen.berkas', [
            'proposals' => $paginatedProposals,
            'perPage' => $perPage,
            'currentFilter' => $request->input('filter', 'semua')
        ])->with([
            'user' => 'dosen'
        ]);
    }

    public function penilaian($mhsNim)
    {
        $proposal = $this->antriProposal()->firstWhere('mhs_nim', $mhsNim);
        $penilaianProposalPembimbing = $this->penilaianNilai()->slice(0, 4);
        $penilaianProposalPembahas = $this->penilaianNilai()->slice(4, 4);
        $penilaianBimbinganPembimbing1 = $this->penilaianNilai()->slice(8, 4)->sortBy('kriteria_nama');
        $penilaianBimbinganPembimbing2 = $this->penilaianNilai()->slice(12, 4)->sortBy('kriteria_nama');
        $penilaianSidangPembahas1p1 = $this->penilaianNilai()->slice(16, 2)->sortBy('kriteria_nama');
        $penilaianSidangPembahas1p2 = $this->penilaianNilai()->slice(18, 5)->sortBy('kriteria_nama');
        $penilaianSidangPembahas1p3 = $this->penilaianNilai()->slice(23, 2)->sortBy('kriteria_nama');
        $penilaianSidangPembahas2p1 = $this->penilaianNilai()->slice(25, 2)->sortBy('kriteria_nama');
        $penilaianSidangPembahas2p2 = $this->penilaianNilai()->slice(27, 5)->sortBy('kriteria_nama');
        $penilaianSidangPembahas2p3 = $this->penilaianNilai()->slice(32, 2)->sortBy('kriteria_nama');

        if (!$proposal) {
            abort(404, 'Proposal not found');
        }

        return view('dosen.penilaian', [
            'proposal' => $proposal,
            'penilaianProposalPembimbing' => $penilaianProposalPembimbing,
            'penilaianProposalPembahas' => $penilaianProposalPembahas,
            'penilaianBimbinganPembimbing1' => $penilaianBimbinganPembimbing1,
            'penilaianBimbinganPembimbing2' => $penilaianBimbinganPembimbing2,
            'penilaianSidangPembahas1p1' => $penilaianSidangPembahas1p1,
            'penilaianSidangPembahas1p2' => $penilaianSidangPembahas1p2,
            'penilaianSidangPembahas1p3' => $penilaianSidangPembahas1p3,
            'penilaianSidangPembahas2p1' => $penilaianSidangPembahas2p1,
            'penilaianSidangPembahas2p2' => $penilaianSidangPembahas2p2,
            'penilaianSidangPembahas2p3' => $penilaianSidangPembahas2p3,
        ])->with([
            'user' => 'dosen'
        ]);
    }
}
