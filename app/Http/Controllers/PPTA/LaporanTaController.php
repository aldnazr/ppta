<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanTaController extends Controller
{
    function dummyMahasiswa()
    {
        return $data = [
            [
                'nim' => '18410100075',
                'nama' => 'Ilham Dwicky Syaputra',
                'judul' => 'PERANCANGAN DESAIN UI/UX PROTOTYPE HYBRID COURSE PADA BIMBINGAN BELAJAR AFTERSCHOOL MENGGUNAKAN METODE LEAN UX',
                'pembimbing_1' => 'Sri Hariani Eko Wulandari',
                'pembimbing_2' => 'Tony Soebijono',
                'penguji_1' => 'Tri Sagraini',
                'penguji_2' => '',
                'pengajuan' => '07-11-2022',
                'sidang' => '03-12-2024 16:37',
                'ruang' => 'M504',
                'hasil' => 'Ditolak',
            ],
            [
                'nim' => '18410100028',
                'nama' => 'Ahmad Fauzi Ari Iftaudin',
                'judul' => 'REDESIGN WEBSITE PADA PT KYODO UTAMA INDONESIA UNTUK MENINGKATKAN USABILITY',
                'pembimbing_1' => 'M.J. Dewiyani Sunarto',
                'pembimbing_2' => 'Tan Amelia',
                'penguji_1' => 'Julianto Lemantara',
                'penguji_2' => '',
                'pengajuan' => '09-11-2022',
                'sidang' => '24-10-2024 12:11',
                'ruang' => 'M504',
                'hasil' => 'ACC',
            ],
            [
                'nim' => '16410100116',
                'nama' => 'Muhammad Yusuf Al Azar',
                'judul' => 'RANCANG BANGUN APLIKASI PENGGAJIAN KARYAWAN PADA KOPERASI ECCINDO PT. ECCO INDONESIA',
                'pembimbing_1' => 'Titik Lusiani',
                'pembimbing_2' => 'Vivine Nurchayawati',
                'penguji_1' => 'Tan Amelia',
                'penguji_2' => '',
                'pengajuan' => '16-12-2022 22:01',
                'sidang' => '05-08-2024 22:01',
                'ruang' => 'B503',
                'hasil' => 'ACC',
            ],
            [
                'nim' => '18410100084',
                'nama' => 'Endar Dharma Mukti',
                'judul' => 'RANCANG BANGUN APLIKASI SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN SISWA BERPRESTASI DENGAN MENERAPKAN METODE SIMPLE ADDITIVE WEIGHTING (SAW) PADA SMA TRI-MAHAYU SURABAYA',
                'pembimbing_1' => 'Endra Rahmawati Pradita',
                'pembimbing_2' => 'Maulidya Effendi',
                'penguji_1' => 'Julianto Lemantara',
                'penguji_2' => '',
                'pengajuan' => '11-04-2023',
                'sidang' => '05-08-2024 16:27',
                'ruang' => 'M504',
                'hasil' => 'ACC',
            ],
            [
                'nim' => '17410100017',
                'nama' => 'Rizaldy Pasya Wijaya',
                'judul' => 'RANCANG BANGUN APLIKASI PENJUALAN MENGGUNAKAN METODE GAMIFICATION PADA UMKM SABLON ALFAH',
                'pembimbing_1' => 'Agus Dwi Churniawan',
                'pembimbing_2' => 'Henry Bambang',
                'penguji_1' => 'Endra Rahmawati',
                'penguji_2' => '',
                'pengajuan' => '05-04-2023',
                'sidang' => '25-11-2024 15:39',
                'ruang' => 'M504',
                'hasil' => 'ACC',
            ],
        ];
    }

    function index(Request $request)
    {
        return view('ppta.laporanta', [])->with([
            'user' => 'ppta'
        ]);
    }

    public function generatePdf()
    {
        $data = $this->dummyMahasiswa();

        // Load view dan passing data
        $pdf = Pdf::loadView('ppta.laporan.ta', compact('data'))
            ->setPaper('a4', 'landscape');;

        // Download PDF
        return $pdf->download('laporan_dummy.pdf');
    }
}
