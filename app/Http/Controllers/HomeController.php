<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $schedules = [
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
        ];

        return view('home', compact('schedules'));
    }
}
