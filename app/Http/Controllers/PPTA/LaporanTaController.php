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
    private function laporanTA($kodeProdi = null): array
    {
        $url = 'https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ppta/laporan/ta';

        // Tambahkan kode_prodi hanya jika ada
        if (!empty($kodeProdi)) {
            $url .= '?kode_prodi=' . urlencode($kodeProdi);
        }

        $response = Http::get($url);

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

        // Ambil data dari API
        $kodeProdi = $prodi !== 'semua' ? $prodi : null;
        $data = $this->laporanTA($kodeProdi);

        // Filter berdasarkan hasil sidang jika dipilih
        if ($hasilSidang !== 'semua') {
            $data = array_filter($data, function ($item) use ($hasilSidang) {
                return isset($item['sts_ta']) && $item['sts_ta'] === $hasilSidang;
            });
        }

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

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'laporan_TA.pdf'
        );
    }
}
