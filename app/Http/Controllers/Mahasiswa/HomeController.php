<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    private function dummyData()
    {
        return collect([
            [
                'date' => '28-11-2024',
                'time' => 'jam 14:00',
                'room' => 'ruang M504',
                'title' => 'RANCANG BANGUN APLIKASI PENJADWALAN PROYEK PADA CV TIGA BERSAMA MANDIRI DENGAN MENGGUNAKAN METODE CRITICAL PATH METHOD (CPM)',
                'student' => 'Alwi Shahab (17410100132)',
                'supervisor1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                'supervisor2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA'
            ],
            [
                'date' => '29-11-2024',
                'time' => 'jam 09:00',
                'room' => 'ruang M504',
                'title' => 'Perancangan User Interface dan User Experience Website Primadona Jember dengan Metode Double Diamond',
                'student' => 'Mohammad Qisthi Hadistian (18410100082)',
                'supervisor1' => 'Slamet, M.T, CCNA',
                'supervisor2' => 'Dr. M.J. Dewiyani Sunarto'
            ],
            [
                'date' => '28-11-2024',
                'time' => 'jam 14:00',
                'room' => 'ruang M504',
                'title' => 'RANCANG BANGUN APLIKASI PENJADWALAN PROYEK PADA CV TIGA BERSAMA MANDIRI DENGAN MENGGUNAKAN METODE CRITICAL PATH METHOD (CPM)',
                'student' => 'Alwi Shahab (17410100132)',
                'supervisor1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                'supervisor2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA'
            ],
            [
                'date' => '29-11-2024',
                'time' => 'jam 09:00',
                'room' => 'ruang M504',
                'title' => 'Perancangan User Interface dan User Experience Website Primadona Jember dengan Metode Double Diamond',
                'student' => 'Mohammad Qisthi Hadistian (18410100082)',
                'supervisor1' => 'Slamet, M.T, CCNA',
                'supervisor2' => 'Dr. M.J. Dewiyani Sunarto'
            ],
            [
                'date' => '28-11-2024',
                'time' => 'jam 14:00',
                'room' => 'ruang M504',
                'title' => 'RANCANG BANGUN APLIKASI PENJADWALAN PROYEK PADA CV TIGA BERSAMA MANDIRI DENGAN MENGGUNAKAN METODE CRITICAL PATH METHOD (CPM)',
                'student' => 'Alwi Shahab (17410100132)',
                'supervisor1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                'supervisor2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA'
            ],
            [
                'date' => '29-11-2024',
                'time' => 'jam 09:00',
                'room' => 'ruang M504',
                'title' => 'Perancangan User Interface dan User Experience Website Primadona Jember dengan Metode Double Diamond',
                'student' => 'Mohammad Qisthi Hadistian (18410100082)',
                'supervisor1' => 'Slamet, M.T, CCNA',
                'supervisor2' => 'Dr. M.J. Dewiyani Sunarto'
            ],
            [
                'date' => '28-11-2024',
                'time' => 'jam 14:00',
                'room' => 'ruang M504',
                'title' => 'RANCANG BANGUN APLIKASI PENJADWALAN PROYEK PADA CV TIGA BERSAMA MANDIRI DENGAN MENGGUNAKAN METODE CRITICAL PATH METHOD (CPM)',
                'student' => 'Alwi Shahab (17410100132)',
                'supervisor1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                'supervisor2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA'
            ],
            [
                'date' => '29-11-2024',
                'time' => 'jam 09:00',
                'room' => 'ruang M504',
                'title' => 'Perancangan User Interface dan User Experience Website Primadona Jember dengan Metode Double Diamond',
                'student' => 'Mohammad Qisthi Hadistian (18410100082)',
                'supervisor1' => 'Slamet, M.T, CCNA',
                'supervisor2' => 'Dr. M.J. Dewiyani Sunarto'
            ]
        ]);
    }
    public function index(Request $request)
    {
        $schedules = $this->dummyData();

        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $schedules = $schedules->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['title']), $searchTerm) ||
                    str_contains(strtolower($proposal['student']), $searchTerm) ||
                    str_contains(strtolower($proposal['supervisor1']), $searchTerm) ||
                    str_contains(strtolower($proposal['supervisor2']), $searchTerm);
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
            'schedules' => $paginatedSchedules
        ]);
    }
}
