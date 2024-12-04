<?php

namespace App\Http\Controllers\PPTA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    private function getDummyEmployees()
    {
        return collect([
            ['id' => 1, 'nik' => '000265', 'name' => 'Harianto', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 2, 'nik' => '000289', 'name' => 'Ayuningtiyas', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 3, 'nik' => '000290', 'name' => 'Teguh Sutanto', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 4, 'nik' => '000331', 'name' => 'Sri Hariani Eko Wulandari', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 5, 'nik' => '020393', 'name' => 'Tan Amelia', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 6, 'nik' => '030433', 'name' => 'Oktaviani', 'tingkat' => 2, 'status' => 'Y'],
            ['id' => 7, 'nik' => '030451', 'name' => 'Nunuk Wahyuningtiyas', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 8, 'nik' => '040477', 'name' => 'Darwan Yuwono Riyanto', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 9, 'nik' => '040501', 'name' => 'Vivine Nurcahyawati', 'tingkat' => 1, 'status' => 'Y'],
            ['id' => 10, 'nik' => '050506', 'name' => 'Lilis Binawati', 'tingkat' => 1, 'status' => 'Y'],
        ]);
    }

    public function index(Request $request)
    {
        $employees = $this->getDummyEmployees();

        $uniqueTingkat = $employees->pluck('tingkat')->unique();
        $uniqueStatus = $employees->pluck('status')->unique();

        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $employees = $employees->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['nik']), $searchTerm) ||
                    str_contains(strtolower($proposal['name']), $searchTerm);
            });
        }

        if ($request->has('tingkat') && $request->tingkat) {
            $employees = $employees->where('tingkat', $request->tingkat);
        }

        if ($request->has('status') && $request->status) {
            $employees = $employees->where('status', $request->status);
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
