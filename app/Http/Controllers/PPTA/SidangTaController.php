<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class SidangTaController extends Controller
{
    private function getDummyTugasAkhir()
    {
        return collect([
            [
                'no_daftar' => '2024110005',
                'tgl_pengajuan' => '11-11-2024',
                'nim' => '20410100045',
                'nama' => 'Ananda Rizky Kurniawan',
                'judul' => 'Perencanaan Persediaan yang Optimal berdasarkan Metode Economic Order Quantity dan Reorder Point dengan Merancang dan Membangun Software Application',
                'pembimbing1' => 'Sulistiowati, S.Si., M.M.',
                'pembimbing2' => 'Yoppy Mirza Maulana, S.Kom., M.MT.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110006',
                'tgl_pengajuan' => '12-12-2024',
                'nim' => '20410100046',
                'nama' => 'Budi Santoso',
                'judul' => 'Analisis Sistem Informasi Manajemen pada Perusahaan XYZ dengan Pendekatan Balanced Scorecard',
                'pembimbing1' => 'Dewi Sartika, S.Kom., M.T.',
                'pembimbing2' => 'Agus Salim, S.T., M.Eng.',
                'status' => 'Dijadwalkan'
            ],
            [
                'no_daftar' => '2024110007',
                'tgl_pengajuan' => '13-12-2024',
                'nim' => '20410100047',
                'nama' => 'Citra Dewi',
                'judul' => 'Pengembangan Aplikasi Mobile untuk Monitoring Kesehatan dengan Teknologi IoT',
                'pembimbing1' => 'Rina Suryani, S.T., M.T.',
                'pembimbing2' => 'Bambang Setiawan, S.Kom., M.Kom.',
                'status' => 'Dijadwalkan'
            ],
            [
                'no_daftar' => '2024110008',
                'tgl_pengajuan' => '14-12-2024',
                'nim' => '20410100048',
                'nama' => 'Dedi Prasetyo',
                'judul' => 'Implementasi Algoritma Machine Learning untuk Prediksi Harga Saham',
                'pembimbing1' => 'Siti Aminah, S.T., M.T.',
                'pembimbing2' => 'Hendra Gunawan, S.Kom., M.Kom.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110009',
                'tgl_pengajuan' => '15-12-2024',
                'nim' => '20410100049',
                'nama' => 'Eka Putri',
                'judul' => 'Sistem Informasi Geografis untuk Pemetaan Daerah Rawan Bencana',
                'pembimbing1' => 'Dian Purnama, S.T., M.T.',
                'pembimbing2' => 'Fajar Nugroho, S.Kom., M.Kom.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110010',
                'tgl_pengajuan' => '16-12-2024',
                'nim' => '20410100050',
                'nama' => 'Fajar Setiawan',
                'judul' => 'Analisis Sentimen Media Sosial Menggunakan Teknik Text Mining',
                'pembimbing1' => 'Lina Marlina, S.T., M.T.',
                'pembimbing2' => 'Rudi Hartono, S.Kom., M.Kom.',
                'status' => 'Dijadwalkan'
            ],
            [
                'no_daftar' => '2024110011',
                'tgl_pengajuan' => '17-12-2024',
                'nim' => '20410100051',
                'nama' => 'Gita Pramesti',
                'judul' => 'Pengembangan Sistem E-Commerce dengan Framework Laravel',
                'pembimbing1' => 'Yuni Astuti, S.T., M.T.',
                'pembimbing2' => 'Andi Wijaya, S.Kom., M.Kom.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110012',
                'tgl_pengajuan' => '18-12-2024',
                'nim' => '20410100052',
                'nama' => 'Hadi Saputra',
                'judul' => 'Optimasi Jaringan Komputer Menggunakan Algoritma Genetic',
                'pembimbing1' => 'Rina Suryani, S.T., M.T.',
                'pembimbing2' => 'Bambang Setiawan, S.Kom., M.Kom.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110013',
                'tgl_pengajuan' => '19-12-2024',
                'nim' => '20410100053',
                'nama' => 'Indah Permata',
                'judul' => 'Pengembangan Sistem Informasi Akademik Berbasis Web',
                'pembimbing1' => 'Siti Aminah, S.T., M.T.',
                'pembimbing2' => 'Hendra Gunawan, S.Kom., M.Kom.',
                'status' => 'Dijadwalkan'
            ],
            [
                'no_daftar' => '2024110014',
                'tgl_pengajuan' => '20-12-2024',
                'nim' => '20410100054',
                'nama' => 'Joko Susilo',
                'judul' => 'Implementasi Sistem Pakar untuk Diagnosa Penyakit Tanaman',
                'pembimbing1' => 'Dian Purnama, S.T., M.T.',
                'pembimbing2' => 'Fajar Nugroho, S.Kom., M.Kom.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110015',
                'tgl_pengajuan' => '21-12-2024',
                'nim' => '20410100055',
                'nama' => 'Kiki Amalia',
                'judul' => 'Pengembangan Aplikasi E-Learning Berbasis Android',
                'pembimbing1' => 'Lina Marlina, S.T., M.T.',
                'pembimbing2' => 'Rudi Hartono, S.Kom., M.Kom.',
                'status' => 'Dijadwalkan'
            ],
            [
                'no_daftar' => '2024110016',
                'tgl_pengajuan' => '22-12-2024',
                'nim' => '20410100056',
                'nama' => 'Lukman Hakim',
                'judul' => 'Sistem Pendukung Keputusan untuk Pemilihan Laptop Menggunakan Metode AHP',
                'pembimbing1' => 'Yuni Astuti, S.T., M.T.',
                'pembimbing2' => 'Andi Wijaya, S.Kom., M.Kom.',
                'status' => 'Pending'
            ],
        ]);
    }
    public function index(Request $request)
    {
        $tugasAkhir = $this->getDummyTugasAkhir();

        $perPage = $request->input('per_page', 10);

        // Pencarian berdasarkan nama atau judul
        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $tugasAkhir = $tugasAkhir->filter(function ($tugasAkhir) use ($searchTerm) {
                return
                    str_contains(strtolower($tugasAkhir['nama']), strtolower($searchTerm)) ||
                    str_contains(strtolower($tugasAkhir['judul']), strtolower($searchTerm));
            });
        }

        // Convert to collection for pagination
        $tugasAkhir = $tugasAkhir->values();

        // Pagination (menggunakan LengthAwarePaginator secara manual karena data berupa array)
        $currentPage = $request->input('page', 1); // Default 10 item per halaman
        $slicedTugasAkhir = $tugasAkhir->slice(($currentPage - 1) * $perPage, $perPage);
        $total = $tugasAkhir->count();
        $paginatedTugasAkhir = new LengthAwarePaginator(
            $slicedTugasAkhir,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('ppta.sidangta', [
            'tugasAkhir' => $paginatedTugasAkhir,
            'perPage' => $perPage
        ])->with([
            'user' => 'ppta'
        ]);
    }
}
