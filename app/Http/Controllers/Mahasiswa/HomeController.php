<?php

namespace App\Http\Controllers\Mahasiswa;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'date_asc');
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/mhs/home');
        $schedules = collect($response->json());

        switch ($sort) {
            case 'date_asc':
                $schedules = $schedules->sortBy(fn($schedule) => Carbon::parse("{$schedule['tgl']} {$schedule['jam']}"));
                break;
            case 'date_desc':
                $schedules = $schedules->sortByDesc(fn($schedule) => Carbon::parse("{$schedule['tgl']} {$schedule['jam']}"));
                break;
        }


        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $schedules = $schedules->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['jdl_proposal']), $searchTerm) ||
                    str_contains(strtolower($proposal['nama']), $searchTerm) ||
                    str_contains(strtolower($proposal['nim']), $searchTerm) ||
                    str_contains(strtolower($proposal['pembimbing_1_nama']), $searchTerm) ||
                    str_contains(strtolower($proposal['pembimbing_2_nama']), $searchTerm);
            });
        }

        // Convert to collection for pagination
        $schedules = $schedules->values();

        // Create a custom paginator
        $paginatedSchedules = new LengthAwarePaginator(
            $schedules->forPage(request('page', 1), 5),
            $schedules->count(),
            5,
            request('page', 1),
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('mahasiswa.home', [
            'schedules' => $paginatedSchedules,
            'currentSort' => $sort
        ]);
    }
}
