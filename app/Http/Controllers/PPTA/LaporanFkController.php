<?php

namespace App\Http\Controllers\PPTA;

use Carbon\Carbon;
use App\Data\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LaporanFkController extends Controller
{
    private function laporanTA($tanggal_awal = null, $tanggal_akhir = null, $hasilSidang = null, $kodeProdi = null): array
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
    function index(Request $request)
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

        // Start with dummy data
        $data = $this->dummyMahasiswa();

        // Filter by Date Range (if both dates are provided)
        if ($tanggalAwal && $tanggalAkhir) {
            $data = array_filter($data, function ($item) use ($tanggalAwal, $tanggalAkhir) {
                $tglSidang = Carbon::parse($item['tgl_daftar']);
                $awal = Carbon::parse($tanggalAwal);
                $akhir = Carbon::parse($tanggalAkhir);

                return $tglSidang->between($awal, $akhir);
            });
        } elseif ($tanggalAwal) {
            // If only start date is provided
            $data = array_filter($data, function ($item) use ($tanggalAwal) {
                return Carbon::parse($item['tgl_daftar']) >= Carbon::parse($tanggalAwal);
            });
        } elseif ($tanggalAkhir) {
            // If only end date is provided
            $data = array_filter($data, function ($item) use ($tanggalAkhir) {
                return Carbon::parse($item['tgl_daftar']) <= Carbon::parse($tanggalAkhir);
            });
        }

        // Filter by Hasil Sidang
        if ($krs !== 'semua') {
            $data = array_filter($data, function ($item) use ($krs) {
                return strtolower($item['hasil']) === strtolower($krs);
            });
        }

        // Filter by Program Studi
        if ($prodi !== 'semua') {
            $prodiMapping = Prodi::$getProdi;
            // Use the mapping to get the correct prodi name
            $prodiName = $prodiMapping[$prodi] ?? $prodi;

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
        $pdf = Pdf::loadView('ppta.laporan.fk', compact('data'))
            ->setPaper('a4', 'landscape');

        // Download PDF
        return $pdf->download('laporan_FK.pdf');
    }
}
