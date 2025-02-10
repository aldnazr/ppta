<?php

namespace App\Http\Controllers\PPTA;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanTaController extends Controller
{
    /**
     * Mengambil data laporan TA dari API
     */
    private function laporanTA(): array
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ppta/laporan/ta');

        if ($response->successful()) {
            return $response->json();
        }

        return []; // Jika gagal, kembalikan array kosong
    }

    /**
     * Menampilkan halaman index laporan TA
     */
    public function index(Request $request)
    {
        $today = now()->format('Y-m-d');
        $prodis = $this->prodiMapping();

        return view('ppta.laporanta')->with([
            'user' => 'ppta',
            'tanggal_awal' => $today,
            'tanggal_akhir' => $today,
            'prodis' => $prodis
        ]);
    }

    /**
     * Generate PDF berdasarkan filter yang diberikan
     */
    public function generatePdf(Request $request)
    {
        // Ambil data filter dari request
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir'); // Diperbaiki dari typo `tanggal-akhir`
        $hasilSidang = $request->input('hasil_sidang', 'semua');
        $prodi = $request->input('prodi', 'semua');

        // Ambil data dari API
        $data = $this->laporanTA();

        // Filter berdasarkan rentang tanggal
        if ($tanggalAwal || $tanggalAkhir) {
            $awal = $tanggalAwal ? Carbon::parse($tanggalAwal) : null;
            $akhir = $tanggalAkhir ? Carbon::parse($tanggalAkhir) : null;

            $data = array_filter($data, function ($item) use ($awal, $akhir) {
                $tglSidang = Carbon::parse($item['wkt_ta']);

                if ($awal && $akhir) {
                    return $tglSidang->between($awal, $akhir);
                } elseif ($awal) {
                    return $tglSidang->greaterThanOrEqualTo($awal);
                } elseif ($akhir) {
                    return $tglSidang->lessThanOrEqualTo($akhir);
                }
                return true;
            });
        }

        // Filter berdasarkan hasil sidang
        if ($hasilSidang !== 'semua') {
            $data = array_filter($data, function ($item) use ($hasilSidang) {
                return Str::lower($item['sts_ta']) === Str::lower($hasilSidang);
            });
        }

        // Filter berdasarkan Program Studi
        if ($prodi !== 'semua') {
            $prodiMapping = $this->prodiMapping();
            $prodiName = $prodiMapping[$prodi] ?? $prodi;

            $data = array_filter($data, function ($item) use ($prodiName) {
                return $item['prodi'] === $prodiName;
            });
        }

        // Pastikan data tetap dalam format array numerik agar tidak error saat diproses oleh Blade/PDF
        $data = array_values($data);

        // Jika data kosong, kembalikan dengan pesan error
        if (count($data) === 0) {
            return redirect()->back()->with('error', [
                'title' => 'Data Tidak Tersedia',
                'message' => 'Tidak ada data yang ditemukan.',
                'type' => 'error'
            ]);
        }

        // Generate PDF dengan data yang telah difilter
        $pdf = Pdf::loadView('ppta.laporan.ta', compact('data'))->setPaper('a4', 'landscape');

        return response()->download($pdf->output(), 'laporan_TA.pdf');
    }
}
