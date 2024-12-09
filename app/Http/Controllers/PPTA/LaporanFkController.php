<?php

namespace App\Http\Controllers\PPTA;

use Carbon\Carbon;
use App\Data\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanFkController extends Controller
{
    function dummyMahasiswa()
    {
        return $data = [
            [
                'nim' => '18410100075',
                'nama' => 'Ilham Dwicky Syaputra',
                'prodi' => 'Sistem Informasi',
                'judul' => 'PERANCANGAN DESAIN UI/UX PROTOTYPE HYBRID COURSE PADA BIMBINGAN BELAJAR AFTERSCHOOL MENGGUNAKAN METODE LEAN UX',
                'pembimbing_1' => 'Sri Hariani Eko Wulandari',
                'pembimbing_2' => 'Tony Soebijono',
                'penguji_1' => 'Tri Sagraini',
                'penguji_2' => '',
                'tgl_daftar' => '07-11-2024',
                'keterangan' => 'Tulis judul dengan tepat'
            ],
            [
                'nim' => '18410100028',
                'nama' => 'Ahmad Fauzi Ari Iftaudin',
                'prodi' => 'Manajemen',
                'judul' => 'REDESIGN WEBSITE PADA PT KYODO UTAMA INDONESIA UNTUK MENINGKATKAN USABILITY',
                'pembimbing_1' => 'M.J. Dewiyani Sunarto',
                'pembimbing_2' => 'Tan Amelia',
                'penguji_1' => 'Julianto Lemantara',
                'penguji_2' => '',
                'tgl_daftar' => '09-11-2022',
                'keterangan' => 'Tulis judul dengan tepat'
            ],
            [
                'nim' => '16410100116',
                'nama' => 'Muhammad Yusuf Al Azar',
                'prodi' => 'Desain Komunikasi Visual',
                'judul' => 'RANCANG BANGUN APLIKASI PENGGAJIAN KARYAWAN PADA KOPERASI ECCINDO PT. ECCO INDONESIA',
                'pembimbing_1' => 'Titik Lusiani',
                'pembimbing_2' => 'Vivine Nurchayawati',
                'penguji_1' => 'Tan Amelia',
                'penguji_2' => '',
                'tgl_daftar' => '16-12-2022 22:01',
                'keterangan' => 'Tulis judul dengan tepat'
            ],
            [
                'nim' => '18410100084',
                'nama' => 'Endar Dharma Mukti',
                'prodi' => 'Teknik Komputer',
                'judul' => 'RANCANG BANGUN APLIKASI SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN SISWA BERPRESTASI DENGAN MENERAPKAN METODE SIMPLE ADDITIVE WEIGHTING (SAW) PADA SMA TRI-MAHAYU SURABAYA',
                'pembimbing_1' => 'Endra Rahmawati Pradita',
                'pembimbing_2' => 'Maulidya Effendi',
                'penguji_1' => 'Julianto Lemantara',
                'penguji_2' => '',
                'tgl_daftar' => '11-04-2023',
                'keterangan' => 'Tulis judul dengan tepat'
            ],
            [
                'nim' => '17410100017',
                'nama' => 'Rizaldy Pasya Wijaya',
                'prodi' => 'Akuntansi',
                'judul' => 'RANCANG BANGUN APLIKASI PENJUALAN MENGGUNAKAN METODE GAMIFICATION PADA UMKM SABLON ALFAH',
                'pembimbing_1' => 'Agus Dwi Churniawan',
                'pembimbing_2' => 'Henry Bambang',
                'penguji_1' => 'Endra Rahmawati',
                'penguji_2' => '',
                'tgl_daftar' => '05-04-2023',
                'keterangan' => 'Tulis judul dengan tepat'
            ],
        ];
    }

    function index(Request $request)
    {
        $today = now()->format('Y-m-d');

        return view('ppta.laporanfk',)->with([
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
