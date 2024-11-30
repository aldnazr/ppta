<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BerkasController extends Controller
{

    private function getDummyProposals()
    {
        return collect([
            [
                'id' => 1,
                'tgl_pengajuan_proposal' => '2024-10-25',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100143',
                'nama_mahasiswa' => 'Muhammad Alauddin Azhary',
                'judul' => 'RANCANG BANGUN WEBSITE RESPONSIF PPTA PADA UNIVERSITAS DINAMIKA',
                'pembimbing1' => 'Tan Amelia',
                'pembimbing2' => 'M.J. Dewiyani Sunarto',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses'
            ],
            [
                'id' => 2,
                'tgl_pengajuan_proposal' => '2024-10-20',
                'tgl_pengajuan_ta' => '2024-11-15',
                'nim' => '18410100144',
                'nama_mahasiswa' => 'Siti Nurhaliza',
                'judul' => 'ANALISIS KEAMANAN JARINGAN MENGGUNAKAN METODE PENETRATION TESTING',
                'pembimbing1' => 'Dr. Ahmad Zaki',
                'pembimbing2' => 'Mirza Prasetya',
                'penguji' => 'Budi Setiawan',
                'siap_transfer' => 'Ya',
                'status' => 'Disetujui'
            ],
            [
                'id' => 3,
                'tgl_pengajuan_proposal' => '2024-10-15',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100145',
                'nama_mahasiswa' => 'Rudi Hartono',
                'judul' => 'IMPLEMENTASI MACHINE LEARNING UNTUK PREDIKSI PENJUALAN ONLINE',
                'pembimbing1' => 'Dr. Indah Permatasari',
                'pembimbing2' => 'Joko Widodo',
                'penguji' => 'Ani Yuningsih',
                'siap_transfer' => null,
                'status' => 'Draft'
            ],
            [
                'id' => 4,
                'tgl_pengajuan_proposal' => '2024-10-10',
                'tgl_pengajuan_ta' => '2024-11-10',
                'nim' => '18410100146',
                'nama_mahasiswa' => 'Lisa Permana',
                'judul' => 'PENGEMBANGAN APLIKASI MOBILE UNTUK MANAJEMEN KEUANGAN PRIBADI',
                'pembimbing1' => 'Rina Susanti',
                'pembimbing2' => 'Hendri Kurniawan',
                'penguji' => 'Putra Samudra',
                'siap_transfer' => 'Ya',
                'status' => 'Disetujui'
            ],
            [
                'id' => 5,
                'tgl_pengajuan_proposal' => '2024-10-05',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100147',
                'nama_mahasiswa' => 'Ahmad Fauzi',
                'judul' => 'SISTEM REKOMENDASI PARIWISATA BERBASIS KECERDASAN BUATAN',
                'pembimbing1' => 'Dr. Sri Wahyuni',
                'pembimbing2' => 'Bambang Priyanto',
                'penguji' => 'Dewi Kartika',
                'siap_transfer' => null,
                'status' => 'Proses'
            ],
            [
                'id' => 1,
                'tgl_pengajuan_proposal' => '2024-10-25',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100143',
                'nama_mahasiswa' => 'Muhammad Alauddin Azhary',
                'judul' => 'RANCANG BANGUN WEBSITE RESPONSIF PPTA PADA UNIVERSITAS DINAMIKA',
                'pembimbing1' => 'Tan Amelia',
                'pembimbing2' => 'M.J. Dewiyani Sunarto',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses'
            ],
            [
                'id' => 2,
                'tgl_pengajuan_proposal' => '2024-10-20',
                'tgl_pengajuan_ta' => '2024-11-15',
                'nim' => '18410100144',
                'nama_mahasiswa' => 'Siti Nurhaliza',
                'judul' => 'ANALISIS KEAMANAN JARINGAN MENGGUNAKAN METODE PENETRATION TESTING',
                'pembimbing1' => 'Dr. Ahmad Zaki',
                'pembimbing2' => 'Mirza Prasetya',
                'penguji' => 'Budi Setiawan',
                'siap_transfer' => 'Ya',
                'status' => 'Disetujui'
            ],
            [
                'id' => 3,
                'tgl_pengajuan_proposal' => '2024-10-15',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100145',
                'nama_mahasiswa' => 'Rudi Hartono',
                'judul' => 'IMPLEMENTASI MACHINE LEARNING UNTUK PREDIKSI PENJUALAN ONLINE',
                'pembimbing1' => 'Dr. Indah Permatasari',
                'pembimbing2' => 'Joko Widodo',
                'penguji' => 'Ani Yuningsih',
                'siap_transfer' => null,
                'status' => 'Draft'
            ],
            [
                'id' => 4,
                'tgl_pengajuan_proposal' => '2024-10-10',
                'tgl_pengajuan_ta' => '2024-11-10',
                'nim' => '18410100146',
                'nama_mahasiswa' => 'Lisa Permana',
                'judul' => 'PENGEMBANGAN APLIKASI MOBILE UNTUK MANAJEMEN KEUANGAN PRIBADI',
                'pembimbing1' => 'Rina Susanti',
                'pembimbing2' => 'Hendri Kurniawan',
                'penguji' => 'Putra Samudra',
                'siap_transfer' => 'Ya',
                'status' => 'Disetujui'
            ],
            [
                'id' => 5,
                'tgl_pengajuan_proposal' => '2024-10-05',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100147',
                'nama_mahasiswa' => 'Ahmad Fauzi',
                'judul' => 'SISTEM REKOMENDASI PARIWISATA BERBASIS KECERDASAN BUATAN',
                'pembimbing1' => 'Dr. Sri Wahyuni',
                'pembimbing2' => 'Bambang Priyanto',
                'penguji' => 'Dewi Kartika',
                'siap_transfer' => null,
                'status' => 'Proses'
            ],
            [
                'id' => 1,
                'tgl_pengajuan_proposal' => '2024-10-25',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100143',
                'nama_mahasiswa' => 'Muhammad Alauddin Azhary',
                'judul' => 'RANCANG BANGUN WEBSITE RESPONSIF PPTA PADA UNIVERSITAS DINAMIKA',
                'pembimbing1' => 'Tan Amelia',
                'pembimbing2' => 'M.J. Dewiyani Sunarto',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses'
            ],
            [
                'id' => 2,
                'tgl_pengajuan_proposal' => '2024-10-20',
                'tgl_pengajuan_ta' => '2024-11-15',
                'nim' => '18410100144',
                'nama_mahasiswa' => 'Siti Nurhaliza',
                'judul' => 'ANALISIS KEAMANAN JARINGAN MENGGUNAKAN METODE PENETRATION TESTING',
                'pembimbing1' => 'Dr. Ahmad Zaki',
                'pembimbing2' => 'Mirza Prasetya',
                'penguji' => 'Budi Setiawan',
                'siap_transfer' => 'Ya',
                'status' => 'Disetujui'
            ],
            [
                'id' => 3,
                'tgl_pengajuan_proposal' => '2024-10-15',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100145',
                'nama_mahasiswa' => 'Rudi Hartono',
                'judul' => 'IMPLEMENTASI MACHINE LEARNING UNTUK PREDIKSI PENJUALAN ONLINE',
                'pembimbing1' => 'Dr. Indah Permatasari',
                'pembimbing2' => 'Joko Widodo',
                'penguji' => 'Ani Yuningsih',
                'siap_transfer' => null,
                'status' => 'Draft'
            ],
            [
                'id' => 4,
                'tgl_pengajuan_proposal' => '2024-10-10',
                'tgl_pengajuan_ta' => '2024-11-10',
                'nim' => '18410100146',
                'nama_mahasiswa' => 'Lisa Permana',
                'judul' => 'PENGEMBANGAN APLIKASI MOBILE UNTUK MANAJEMEN KEUANGAN PRIBADI',
                'pembimbing1' => 'Rina Susanti',
                'pembimbing2' => 'Hendri Kurniawan',
                'penguji' => 'Putra Samudra',
                'siap_transfer' => 'Ya',
                'status' => 'Disetujui'
            ],
            [
                'id' => 5,
                'tgl_pengajuan_proposal' => '2024-10-05',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100147',
                'nama_mahasiswa' => 'Ahmad Fauzi',
                'judul' => 'SISTEM REKOMENDASI PARIWISATA BERBASIS KECERDASAN BUATAN',
                'pembimbing1' => 'Dr. Sri Wahyuni',
                'pembimbing2' => 'Bambang Priyanto',
                'penguji' => 'Dewi Kartika',
                'siap_transfer' => null,
                'status' => 'Proses'
            ]
        ]);
    }

    public function index(Request $request)
    {
        // Get the number of items per page from the request, default to 10
        $perPage = $request->input('per_page', 10);

        // Start with dummy proposals
        $proposals = $this->getDummyProposals();

        // Apply search if search term is provided
        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $proposals = $proposals->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['nim']), $searchTerm) ||
                    str_contains(strtolower($proposal['nama_mahasiswa']), $searchTerm) ||
                    str_contains(strtolower($proposal['judul']), $searchTerm) ||
                    str_contains(strtolower($proposal['pembimbing1']), $searchTerm) ||
                    str_contains(strtolower($proposal['pembimbing2']), $searchTerm) ||
                    str_contains(strtolower($proposal['penguji']), $searchTerm);
            });
        }

        // Convert to collection for pagination
        $proposals = $proposals->values();

        // Create a custom paginator
        $currentPage = $request->input('page', 1);
        $slicedProposals = $proposals->slice(($currentPage - 1) * $perPage, $perPage);
        $total = $proposals->count();
        $paginatedProposals = new LengthAwarePaginator(
            $slicedProposals,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('dosen.berkas', [
            'proposals' => $paginatedProposals,
            'perPage' => $perPage,
        ]);
    }

    public function penilaian($proposalId)
    {
        // Find the proposal by ID in dummy data
        $proposal = $this->getDummyProposals()->firstWhere('id', $proposalId);

        if (!$proposal) {
            abort(404, 'Proposal not found');
        }

        return view('dosen.penilaian', ['proposal' => $proposal]);
    }
}
