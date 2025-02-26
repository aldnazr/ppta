<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LaporanFkController extends Controller
{
    private function laporanFK($tanggal_awal = null, $tanggal_akhir = null, $krs = null, $kodeProdi = null): array
    {
        $url = 'https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ppta/laporan/fk';

        // Buat array untuk query parameters
        $queryParams = [];

        if (!empty($tanggal_awal)) {
            $queryParams['tanggal_awal'] = $tanggal_awal;
        }

        if (!empty($tanggal_akhir)) {
            $queryParams['tanggal_akhir'] = $tanggal_akhir;
        }

        if (!empty($krs)) {
            $queryParams['hasil_sidang'] = $krs;
        }

        if (!empty($kodeProdi)) {
            $queryParams['kode_prodi'] = $kodeProdi;
        }

        // Kirim request dengan parameter yang sudah disusun
        $response = Http::get($url, $queryParams);

        return $response->successful() ? $response->json() : [];
    }
    function index()
    {
        $today = now()->format('Y-m-d');
        $prodis = $this->prodiMapping();

        return view('ppta.laporanfk',)->with([
            'user' => 'ppta',
            'tanggal_awal' => $today,
            'tanggal_akhir' => $today,
            'prodis' => $prodis
        ]);
    }

    public function generatePdf(Request $request)
    {
        // Get filter parameters
        $tanggalAwal = $request->input('tanggal-awal');
        $tanggalAkhir = $request->input('tanggal-akhir');
        $krs = $request->input('krs', 'semua');
        $prodi = $request->input('prodi', 'semua');

        // Konversi nilai 'semua' menjadi null agar parameter tidak dikirim jika tidak diperlukan
        $tanggalAwal = !empty($tanggalAwal) ? $tanggalAwal : null;
        $tanggalAkhir = !empty($tanggalAkhir) ? $tanggalAkhir : null;
        $hasilSidang = $krs !== 'semua' ? $krs : null;
        $kodeProdi = $prodi !== 'semua' ? $prodi : null;

        // Panggil laporanTA dengan filter tanggal
        $data = $this->laporanFK($tanggalAwal, $tanggalAkhir, null, $kodeProdi);

        // If no data after filtering, return with pop-up message
        if (empty($data)) {
            return redirect()->back()->with('error', [
                'title' => 'Data Tidak Tersedia',
                'message' => 'Tidak ada data yang ditemukan.',
                'type' => 'error'
            ]);
        }

        // Load view and pass filtered data
        $pdf = Pdf::loadView('ppta.laporan.fk', compact('data'))
            ->setPaper('a4', 'landscape');

        // Download PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Laporan_FK.pdf', ['Content-Type' => 'application/pdf']);
    }
}
