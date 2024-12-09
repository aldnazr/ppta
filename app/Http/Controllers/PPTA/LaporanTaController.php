<?php

namespace App\Http\Controllers\PPTA;

use Carbon\Carbon;
use App\Data\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanTaController extends Controller
{
    private $prodiMapping = [
        'semua' => 'semua',
        'sistem_informasi' => 'Sistem Informasi',
        'manajemen' => 'Manajemen',
        'akuntansi' => 'Akuntansi',
        'teknik_komputer' => 'Teknik Komputer',
        'desain_komunikasi_visual' => 'Desain Komunikasi Visual',
        'desain_produk' => 'Desain Produk'
    ];

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
                'tgl_pengajuan' => '07-11-2022',
                'tgl_sidang' => '03-12-2024 16:37',
                'ruang' => 'M504',
                'hasil' => 'Ditolak',
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
                'tgl_pengajuan' => '09-11-2022',
                'tgl_sidang' => '24-10-2024 12:11',
                'ruang' => 'M504',
                'hasil' => 'ACC',
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
                'tgl_pengajuan' => '16-12-2022 22:01',
                'tgl_sidang' => '05-08-2024 22:01',
                'ruang' => 'B503',
                'hasil' => 'ACC',
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
                'tgl_pengajuan' => '11-04-2023',
                'tgl_sidang' => '05-08-2024 16:27',
                'ruang' => 'M504',
                'hasil' => 'ACC',
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
                'tgl_pengajuan' => '05-04-2023',
                'tgl_sidang' => '25-11-2024 15:39',
                'ruang' => 'M504',
                'hasil' => 'ACC',
            ],
        ];
    }

    function index(Request $request)
    {
        $today = now()->format('Y-m-d');

        return view('ppta.laporanta',)->with([
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
        $data = $this->dummyMahasiswa();

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
        $pdf = Pdf::loadView('ppta.laporan.ta', compact('data'))
            ->setPaper('a4', 'landscape');

        // Download PDF
        return $pdf->download('laporan_TA.pdf');
    }
}
