<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Data\HomeTugasAkhir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianPembimbingController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = $request->input('lecturer', '');

        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/mhs/pencarianpembimbing');
        $tugasAkhirData = collect($response->json());

        // Filter data only if lecturer input is provided
        if (!empty($lecturer)) {
            $filteredData = $tugasAkhirData->filter(function ($item) use ($lecturer) {
                return $item['pemb_1'] === $lecturer || $item['pemb_2'] === $lecturer;
            });
        } else {
            $filteredData = collect(); // Empty collection if no lecturer input
        }

        $paginatedDataBimbingan = (new LengthAwarePaginator(
            $filteredData->forPage($request->input('page', 1), 5),
            $filteredData->count(),
            5,
            $request->input('page', 1),
            ['path' => $request->url()]
        ))->appends($request->except('page'));


        // Check if it's an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'dataBimbingan' => $paginatedDataBimbingan->items(),
                'total' => $paginatedDataBimbingan->total(),
                'lecturer' => $lecturer
            ]);
        }

        return view('mahasiswa.pencarianpembimbing', [
            'paginatedDataBimbingan' => $paginatedDataBimbingan,
            'lecturer' => $lecturer
        ]);
    }
}
