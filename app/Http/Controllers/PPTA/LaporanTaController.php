<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanTaController extends Controller
{
    /**
     * Mengambil data laporan TA dari API
     */
    private function laporanTA($tanggal_awal = null, $tanggal_akhir = null, $hasilSidang = null, $kodeProdi = null): array
    {
        $url = 'https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ppta/laporan/ta';

        // Buat array untuk query parameters
        $queryParams = [];

        if (!empty($tanggal_awal)) {
            $queryParams['tanggal_awal'] = $tanggal_awal;
        }

        if (!empty($tanggal_akhir)) {
            $queryParams['tanggal_akhir'] = $tanggal_akhir;
        }

        if (!empty($hasilSidang)) {
            $queryParams['hasil_sidang'] = $hasilSidang;
        }

        if (!empty($kodeProdi)) {
            $queryParams['kode_prodi'] = $kodeProdi;
        }

        // Kirim request dengan parameter yang sudah disusun
        $response = Http::get($url, $queryParams);

        return $response->successful() ? $response->json() : [];
    }


    public function index()
    {
        $today = now()->format('Y-m-d');
        $prodi = $this->prodiMapping();

        return view('ppta.laporanta')->with([
            'user' => 'ppta',
            'tanggal_awal' => $today,
            'tanggal_akhir' => $today,
            'prodi' => $prodi
        ]);
    }

    /**
     * Generate PDF berdasarkan filter yang diberikan
     */
    public function generatePdf(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $hasilSidang = $request->input('hasil_sidang', 'semua');
        $prodi = $request->input('prodi', 'semua');

        // Konversi nilai 'semua' menjadi null agar parameter tidak dikirim jika tidak diperlukan
        $tanggalAwal = !empty($tanggalAwal) ? $tanggalAwal : null;
        $tanggalAkhir = !empty($tanggalAkhir) ? $tanggalAkhir : null;
        $hasilSidang = $hasilSidang !== 'semua' ? $hasilSidang : null;
        $kodeProdi = $prodi !== 'semua' ? $prodi : null;

        // Panggil laporanTA dengan filter tanggal
        $data = $this->laporanTA($tanggalAwal, $tanggalAkhir, $hasilSidang, $kodeProdi);

        // Jika tidak ada data setelah difilter, kembalikan pesan error
        if (empty($data)) {
            return redirect()->back()->with('error', [
                'title' => 'Data Tidak Tersedia',
                'message' => 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.',
                'type' => 'error'
            ]);
        }

        // Generate PDF dengan data yang telah difilter
        $pdf = Pdf::loadView('ppta.laporan.ta', compact('data'))
            ->setPaper('a4', 'landscape');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Laporan_TA.pdf', ['Content-Type' => 'application/pdf']);
    }
}
