<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class SidangTaController extends Controller
{
    public function getDummyTugasAkhir()
    {
        return collect([
            [
                'no_daftar' => '2024110005',
                'tgl_pengajuan' => '11-11-2024',
                'nim' => '20410100045',
                'nama' => 'Ananda Rizky Kurniawan',
                'judul' => 'Perencanaan Persediaan yang Optimal berdasarkan Metode Economic Order Quantity dan Reorder Point dengan Merancang dan Membangun Software Application',
                'pembimbing1' => 'Sulistiowati, S.Si., M.M.',
                'pembimbing2' => 'Yoppy Mirza Maulana, S.Kom., M.MT.',
                'status' => 'Pending'
            ],
        ]);
    }

    public function index(Request $request)
    {
        $tugasAkhir = $this->getDummyTugasAkhir();

        $perPage = $request->input('per_page', 10);

        // Pencarian berdasarkan nama atau judul
        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $proposals = $tugasAkhir->filter(function ($tugasAkhir) use ($searchTerm) {
                return
                    str_contains(strtolower($tugasAkhir['nama']), strtolower($searchTerm)) ||
                    str_contains(strtolower($tugasAkhir['judul']), strtolower($searchTerm));
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
