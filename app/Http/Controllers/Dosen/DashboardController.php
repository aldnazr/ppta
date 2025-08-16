<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{

    private function dataBelumDinilai()
    {
        $nik = session('nik');

        $url = 'https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/dosen/dashboard?nik_dosen='
            . $nik;

        $response = Http::get($url);

        return collect($response->json());
    }

    public function index(Request $request)
    {
        $dataBelumDinilai = $this->dataBelumDinilai();

        $currentPage = $request->input('page', 1);
        $slicedProposals = $dataBelumDinilai->slice(($currentPage - 1) * 5, 5);
        $total = $dataBelumDinilai->count();
        $paginatedData = new LengthAwarePaginator(
            $slicedProposals,
            $total,
            5,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('dosen.dashboard', [
            'paginated' => $paginatedData,
            'count' => $total
        ])->with([
            'user' => 'dosen'
        ]);
    }
}
