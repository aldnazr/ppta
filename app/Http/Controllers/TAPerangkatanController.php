<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TAPerangkatanController extends Controller
{
    private $data = [
        'Sistem Informasi' => [
            '2021' => 1,
            '2020' => 21,
            '2019' => 57,
            '2018' => 170,
            '2017' => 114,
            '2016' => 89,
            '2015' => 110,
            '2014' => 109,
            '2013' => 135,
            '2012' => 135,
            '2011' => 130,
            '2010' => 147,
            '2009' => 148,
            '2008' => 218,
            '2007' => 215,
            '2006' => 173,
            '2005' => 214,
            '2004' => 190,
            '2003' => 258,
            '2002' => 166,
            '2001' => 195,
            '2000' => 218,
            '1999' => 193,
            '1998' => 149,
            '1997' => 216,
            '1996' => 213,
            '1995' => 175,
            '1994' => 127,
            '1993' => 119,
            '1992' => 52,
            '1991' => 74,
            '1990' => 92,
            '1989' => 61,
            '1988' => 64,
            '1987' => 67,
            '1986' => 22,
            '1985' => 8,
            '1984' => 14,
            '1983' => 13
        ],
        'Teknik Komputer' => [
            '2021' => 2,
            '2020' => 18,
            '2019' => 45,
            '2018' => 120,
            '2017' => 95,
            '2016' => 78,
            '2015' => 89,
            '2014' => 92,
            '2013' => 110
        ],
        'Desain Komunikasi Visual' => [
            '2021' => 3,
            '2020' => 25,
            '2019' => 52,
            '2018' => 145,
            '2017' => 105,
            '2016' => 82
        ],
        'Desain Produk' => [
            '2021' => 1,
            '2020' => 15,
            '2019' => 35,
            '2018' => 85,
            '2017' => 75
        ],
        'Manajemen' => [
            '2021' => 2,
            '2020' => 20,
            '2019' => 48,
            '2018' => 130,
            '2017' => 98,
            '2016' => 85
        ],
        'Akuntansi' => [
            '2021' => 1,
            '2020' => 17,
            '2019' => 42,
            '2018' => 125,
            '2017' => 88,
            '2016' => 76
        ]
    ];

    public function index(Request $request)
    {
        $activeJurusan = $request->query('jurusan', 'Sistem Informasi');
        $jurusan = array_keys($this->data);
        $angkatan = $this->data[$activeJurusan];

        return view('mahasiswa.taperangkatan', compact('jurusan', 'angkatan', 'activeJurusan'));
    }

    public function getByJurusan(Request $request)
    {
        $jurusan = $request->jurusan;
        $data = $this->data[$jurusan] ?? [];

        return response()->json([
            'data' => $data
        ]);
    }
}
