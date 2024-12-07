<?php

namespace App\Http\Controllers\PPTA;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanProposalController extends Controller
{
    // Mapping for program studi to make filtering more robust
    private $prodiMapping = [
        'semua' => 'semua',
        'sistem_informasi' => 'Sistem Informasi',
        'manajemen' => 'Manajemen',
        'akuntansi' => 'Akuntansi',
        'teknik_komputer' => 'Teknik Komputer',
        'desain_komunikasi_visual' => 'Desain Komunikasi Visual',
        'desain_produk' => 'Desain Produk'
    ];

    public function dummyData()
    {
        return [
            [
                'nim' => '18410100100',
                'nama' => 'Josh Doe',
                'prodi' => 'Sistem Informasi',
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
                'prodi' => 'Manajemen',
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
                'prodi' => 'Desain Komunikasi Visual',
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
        $today = now()->format('Y-m-d');

        return view('ppta.laporanproposal', [])->with([
            'user' => 'ppta',
            'tanggal_awal' => $today,
            'tanggal_akhir' => $today
        ]);
    }

    public function generatePdf(Request $request)
    {
        // Get filter parameters
        $tanggalAwal = $request->input('tanggal-awal');
        $tanggalAkhir = $request->input('tanggal-akhir');
        $hasilSidang = $request->input('hasil_sidang', 'semua');
        $prodi = $request->input('prodi', 'semua');

        // Start with dummy data
        $data = $this->dummyData();

        // Filter by Date Range (if both dates are provided)
        if ($tanggalAwal && $tanggalAkhir) {
            $data = array_filter($data, function ($item) use ($tanggalAwal, $tanggalAkhir) {
                $tglSidang = Carbon::parse($item['tgl_sidang']);
                $awal = Carbon::parse($tanggalAwal);
                $akhir = Carbon::parse($tanggalAkhir);

                return $tglSidang->between($awal, $akhir);
            });
        } elseif ($tanggalAwal) {
            // If only start date is provided
            $data = array_filter($data, function ($item) use ($tanggalAwal) {
                return Carbon::parse($item['tgl_sidang']) >= Carbon::parse($tanggalAwal);
            });
        } elseif ($tanggalAkhir) {
            // If only end date is provided
            $data = array_filter($data, function ($item) use ($tanggalAkhir) {
                return Carbon::parse($item['tgl_sidang']) <= Carbon::parse($tanggalAkhir);
            });
        }

        // Filter by Hasil Sidang
        if ($hasilSidang !== 'semua') {
            $data = array_filter($data, function ($item) use ($hasilSidang) {
                return strtolower($item['hasil']) === strtolower($hasilSidang);
            });
        }

        // Filter by Program Studi
        if ($prodi !== 'semua') {
            // Use the mapping to get the correct prodi name
            $prodiName = $this->prodiMapping[$prodi] ?? $prodi;

            $data = array_filter($data, function ($item) use ($prodiName) {
                return $item['prodi'] === $prodiName;
            });
        }

        // If no data after filtering, return with pop-up message
        if (empty($data)) {
            return redirect()->back()->with('error', [
                'title' => 'Data Tidak Tersedia',
                'message' => 'Tidak ada data yang ditemukan.',
                'type' => 'error'
            ]);
        }

        // Load view and pass filtered data
        $pdf = Pdf::loadView('ppta.laporan.proposal', compact('data'))
            ->setPaper('a4', 'landscape');

        // Download PDF
        return $pdf->download('laporan_proposal.pdf');
    }
}
