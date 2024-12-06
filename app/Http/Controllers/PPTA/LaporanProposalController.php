<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanProposalController extends Controller
{
    public function dummyData()
    {
        return [
            [
                'nim' => '18410100100',
                'nama' => 'Josh Doe',
                'judul' => 'Analisis Sentimen Msyarakat dengan Metode Naive Bayes',
                'pembimbing1' => 'Alex',
                'pembimbing2' => 'Ajax',
                'penguji1' => 'Lexa',
                'penguji2' => '',
                'tgl_sidang' => '18-01-2023',
                'hasil' => 'Belum'
            ],
            [
                'nim' => '18410100101',
                'nama' => 'Josh Doe',
                'judul' => 'Analisis Sentimen Msyarakat dengan Metode Naive Bayes',
                'pembimbing1' => 'Alex',
                'pembimbing2' => 'Ajax',
                'penguji1' => 'Lexa',
                'penguji2' => '',
                'tgl_sidang' => '01-01-2023',
                'hasil' => 'Belum'
            ],
            [
                'nim' => '18410100102',
                'nama' => 'Josh Doe',
                'judul' => 'Analisis Sentimen Msyarakat dengan Metode Naive Bayes',
                'pembimbing1' => 'Alex',
                'pembimbing2' => 'Ajax',
                'penguji1' => 'Lexa',
                'penguji2' => 'aXela',
                'tgl_sidang' => '23-11-2024',
                'hasil' => 'Belum'
            ],
        ];
    }

    function index(Request $request)
    {
        return view('ppta.laporanproposal', [])->with([
            'user' => 'ppta'
        ]);
    }

    public function generatePdf()
    {
        $data = $this->dummyData();

        // Load view dan passing data
        $pdf = Pdf::loadView('ppta.laporan.proposal', compact('data'));

        // Download PDF
        return $pdf->download('laporan_dummy.pdf');
    }
}
