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
                'pembimbing_1' => 'Alex',
                'pembimbing_2' => 'Ajax',
                'penguji_1' => 'Lexa',
                'penguji_2' => '',
                'tgl_sidang' => '18-01-2023',
                'hasil' => 'Belum'
            ],
            [
                'nim' => '18410100101',
                'nama' => 'Josh Doe',
                'judul' => 'Analisis Sentimen Msyarakat dengan Metode Naive Bayes',
                'pembimbing_1' => 'Alex',
                'pembimbing_2' => 'Ajax',
                'penguji_1' => 'Lexa',
                'penguji_2' => '',
                'tgl_sidang' => '01-01-2023',
                'hasil' => 'Belum'
            ],
            [
                'nim' => '18410100102',
                'nama' => 'Josh Doe',
                'judul' => 'Analisis Sentimen Msyarakat dengan Metode Naive Bayes',
                'pembimbing_1' => 'Alex',
                'pembimbing_2' => 'Ajax',
                'penguji_1' => 'Lexa',
                'penguji_2' => 'aXela',
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

    public function generatePdf(Request $request)
    {
        $tanggalAwal = $request->input('tanggal-awal');
        $tanggalAkhir = $request->input('tanggal-akhir');
        $hasilSidang = $request->input('hasil_sidang', 'semua');
        $prodi = $request->input('prodi', 'semua');

        $data = $this->dummyData();

        // Filter by Tanggal Awal and Tanggal Akhir
        if ($tanggalAwal) {
            $data = array_filter($data, function ($item) use ($tanggalAwal) {
                return strtotime($item['tgl_sidang']) >= strtotime($tanggalAwal);
            });
        }

        if ($tanggalAkhir) {
            $data = array_filter($data, function ($item) use ($tanggalAkhir) {
                return strtotime($item['tgl_sidang']) <= strtotime($tanggalAkhir);
            });
        }

        // Filter by Hasil Sidang
        if ($hasilSidang !== 'semua') {
            $data = array_filter($data, function ($item) use ($hasilSidang) {
                return $item['hasil'] === ucfirst($hasilSidang);
            });
        }

        // Filter by Program Studi
        if ($prodi !== 'semua') {
            $data = array_filter($data, function ($item) use ($prodi) {
                return strpos(strtolower($item['judul']), strtolower($prodi)) !== false;
            });
        }

        // Load view dan passing data
        $pdf = Pdf::loadView('ppta.laporan.proposal', compact('data'))
            ->setPaper('a4', 'landscape');;

        // Download PDF
        return $pdf->download('laporan_dummy.pdf');
    }
}
