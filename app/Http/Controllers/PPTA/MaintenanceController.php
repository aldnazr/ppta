<?php

namespace App\Http\Controllers\PPTA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $employees = $this->getDummyEmployees();
        return view('ppta.maintenance', compact('employees'));
    }

    public function edit($id)
    {
        $employee = $this->getDummyEmployeeById($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('employees.index');
    }

    private function getDummyEmployees()
    {
        return [
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
            // Add more dummy data as needed
        ];
    }

    private function getDummyEmployeeById($id)
    {
        $employees = $this->getDummyEmployees();
        return array_filter($employees, function ($employee) use ($id) {
            return $employee['id'] == $id;
        })[0];
    }
}
