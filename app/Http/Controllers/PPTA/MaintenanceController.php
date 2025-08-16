<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MaintenanceController extends Controller
{
    private function dosenPenguji()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ppta/maintenance');
        return collect($response->json());
    }

    public function index(Request $request)
    {
        $employees = $this->dosenPenguji();

        $uniqueTingkat = $employees->pluck('tingkat')->unique();
        $uniqueStatus = $employees->pluck('sts_aktif')->unique();

        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $employees = $employees->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['nik']), $searchTerm) ||
                    str_contains(strtolower($proposal['nama_gelar']), $searchTerm);
            });
        }

        if ($request->has('tingkat') && $request->tingkat) {
            $employees = $employees->where('tingkat', $request->tingkat);
        }

        if ($request->has('status') && $request->status) {
            $employees = $employees->where('sts_aktif', $request->status);
        }

        return view('ppta.maintenance', [
            'employees' => $employees,
            'uniqueTingkat' => $uniqueTingkat,
            'uniqueStatus' => $uniqueStatus,
            'selectedTingkat' => $request->tingkat,
            'selectedStatus' => $request->status
        ])->with([
            'user' => 'ppta'
        ]);
    }
}
