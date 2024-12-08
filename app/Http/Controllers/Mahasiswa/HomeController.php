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
                'date' => '2024-12-10',
                'time' => '09:00',
                'room' => 'M504',
                'title' => 'Perancangan Desain UI UX pada PT Tata Graha Perkasa dengan Pendekatan Lean UX untuk Meningkatkan Layanan dan Hubungan dengan Client',
                'student' => 'Akbar Bintang Izzulhaq (20410100055)',
                'supervisor1' => 'Ayuningtyas, S.Kom., M.MT, MOS',
                'supervisor2' => 'Pradita Maulidya Effendi, M.Kom.'
            ],
            [
                'date' => '2024-11-29',
                'time' => '09:00',
                'room' => 'M504',
                'title' => 'Perancangan User Interface dan User Experience Website Primadona Jember dengan Metode Double Diamond',
                'student' => 'Mohammad Qisthi Hadistian (18410100082)',
                'supervisor1' => 'Slamet, M.T, CCNA',
                'supervisor2' => 'Dr. M.J. Dewiyani Sunarto'
            ],
            [
                'date' => '2024-12-10',
                'time' => '09:00',
                'room' => 'M504',
                'title' => 'RANCANG BANGUN APLIKASI PENJADWALAN DAN PEMESANAN HASIL TAMBAK DENGAN PENDEKATAN CROWDSOURCING',
                'student' => 'Moh. Ardi Wildan (18410100063)',
                'supervisor1' => 'Dr. Eng. Valentinus Roby Hananto, S.Kom., M.Sc., OCA',
                'supervisor2' => 'Agus Dwi Churniawan, S.Si., M.Kom.'
            ],
            [
                'date' => '2024-12-11',
                'time' => '10:00',
                'room' => 'M504',
                'title' => 'RANCANG BANGUN APLIKASI PENENTUAN KARYAWAN TERBAIK BERBASIS WEB MENGGUNAKAN METODE SIMPLE ADDITIVE WEIGHTING (SAW) PADA BPS PROVINSI JAWA TIMUR',
                'student' => 'Muhammad Afriza Hanif (21410100013)',
                'supervisor1' => 'Endra Rahmawati, M.Kom.',
                'supervisor2' => 'Ayuningtyas, S.Kom., M.MT, MOS'
            ],
            [
                'date' => '2024-11-28',
                'time' => '14:00',
                'room' => 'M504',
                'title' => 'RANCANG BANGUN APLIKASI PENJADWALAN PROYEK PADA CV TIGA BERSAMA MANDIRI DENGAN MENGGUNAKAN METODE CRITICAL PATH METHOD (CPM)',
                'student' => 'Alwi Shahab (17410100132)',
                'supervisor1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                'supervisor2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA'
            ],
            [
                'date' => '2024-12-12',
                'time' => '08:00',
                'room' => 'M303',
                'title' => 'Perancangan Sistem Informasi Persediaan Barang Pada UD Scorpions Audio Sidoarjo',
                'student' => 'Arief Hirdawan (17430200007)',
                'supervisor1' => 'Tony Soebijono, S.E., S.H., M.Ak.',
                'supervisor2' => 'Martinus Sony Erstiawan, S.E., MSA'
            ],
            [
                'date' => '2024-11-28',
                'time' => '14:00',
                'room' => 'M504',
                'title' => 'RANCANG BANGUN APLIKASI PENJADWALAN PROYEK PADA CV TIGA BERSAMA MANDIRI DENGAN MENGGUNAKAN METODE CRITICAL PATH METHOD (CPM)',
                'student' => 'Alwi Shahab (17410100132)',
                'supervisor1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                'supervisor2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA'
            ],
            [
                'date' => '2024-11-29',
                'time' => '09:00',
                'room' => 'M504',
                'title' => 'Perancangan User Interface dan User Experience Website Primadona Jember dengan Metode Double Diamond',
                'student' => 'Mohammad Qisthi Hadistian (18410100082)',
                'supervisor1' => 'Slamet, M.T, CCNA',
                'supervisor2' => 'Dr. M.J. Dewiyani Sunarto'
            ]
        ])->sortBy('date');
    }
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'date_asc');

        $schedules = $this->dummyData();

        switch ($sort) {
            case 'date_asc':
                $schedules = $schedules->sortBy('date');
                break;
            case 'date_desc':
                $schedules = $schedules->sortByDesc('date');
                break;
        }


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
            'schedules' => $paginatedSchedules,
            'currentSort' => $sort
        ]);
    }
}
