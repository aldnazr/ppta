<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{

    public static function getAssessedData()
    {
        return [
            [
                'name' => 'John Doe',
                'score' => 85,
                'assessed_at' => '2024-03-15',
            ],
            [
                'name' => 'Jane Smith',
                'score' => 92,
                'assessed_at' => '2024-03-14',
            ],
            [
                'name' => 'Bob Johnson',
                'score' => 78,
                'assessed_at' => '2024-03-13',
            ],
            [
                'name' => 'Alice Brown',
                'score' => 95,
                'assessed_at' => '2024-03-12',
            ],
            [
                'name' => 'Charlie Davis',
                'score' => 88,
                'assessed_at' => '2024-03-11',
            ],
            [
                'name' => 'Eva Wilson',
                'score' => 91,
                'assessed_at' => '2024-03-10',
            ],
        ];
    }

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
                'status' => 'Proses',
                'tipe' => 'proposal'
            ],
            [
                'id' => 2,
                'tgl_pengajuan_proposal' => '2024-10-25',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100248',
                'nama_mahasiswa' => 'Mochammad Gilang Ramadhan',
                'judul' => 'PENGEMBANGAN UI/UX APLIKASI PENGELOLAAN AKTIVITAS LANSIA KARANG WERDHA MELATI DENGAN METODE DESIGN THINKING',
                'pembimbing1' => 'Tan Amelia',
                'pembimbing2' => 'M.J. Dewiyani Sunarto',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses',
                'tipe' => 'tugas_akhir'
            ],
            [
                'id' => 3,
                'tgl_pengajuan_proposal' => '2024-10-25',
                'tgl_pengajuan_ta' => null,
                'nim' => '15410100163',
                'nama_mahasiswa' => 'Vicky Ervinda Paramulya',
                'judul' => 'Rancang Bangun Aplikasi Penentuan Kualitas Layanan Kepuasan Pelanggan terhadap Layanan "Tea Bar Tong Tji City of Tommorow" menggunakan Metode Fishbein',
                'pembimbing1' => 'Tan Amelia',
                'pembimbing2' => 'M.J. Dewiyani Sunarto',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses',
                'tipe' => 'proposal'
            ],
            [
                'id' => 4,
                'tgl_pengajuan_proposal' => null,
                'tgl_pengajuan_ta' => '2024-11-15',
                'nim' => '18410100145',
                'nama_mahasiswa' => 'Aldy Irma Aprillianto',
                'judul' => 'ANALISIS SISTEM INFORMASI MANAJEMEN BERBASIS CLOUD',
                'pembimbing1' => 'M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses',
                'tipe' => 'tugas_akhir'
            ],
            [
                'id' => 5,
                'tgl_pengajuan_proposal' => '2024-10-25',
                'tgl_pengajuan_ta' => null,
                'nim' => '18410100143',
                'nama_mahasiswa' => 'Muhammad Alauddin Azhary',
                'judul' => 'RANCANG BANGUN WEBSITE RESPONSIF PPTA PADA UNIVERSITAS DINAMIKA',
                'pembimbing1' => 'Tan Amelia',
                'pembimbing2' => 'M.J. Dewiyani Sunarto',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses',
                'tipe' => 'proposal'
            ],
            [
                'id' => 6,
                'tgl_pengajuan_proposal' => null,
                'tgl_pengajuan_ta' => '2024-11-15',
                'nim' => '16410100118',
                'nama_mahasiswa' => 'Kalingga Razak Hutama',
                'judul' => 'Sistem Pendukung Keputusan Pemilihan Konten Terpopuler menggunakan Metode Topsis (Studi Kasus: Akun Instagram Badminton Tips)',
                'pembimbing1' => 'M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia',
                'penguji' => 'Erwin Sutomo',
                'siap_transfer' => null,
                'status' => 'Proses',
                'tipe' => 'tugas_akhir'
            ],

        ]);
    }
    public function index(Request $request)
    {
        $assessedData = $this->getAssessedData();
        $unassessedData = $this->getDummyProposals();

        $currentPage = $request->input('page', 1);
        $slicedProposals = $unassessedData->slice(($currentPage - 1) * 5, 5);
        $total = $unassessedData->count();
        $paginatedProposals = new LengthAwarePaginator(
            $slicedProposals,
            $total,
            5,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('dosen.dashboard', [
            'paginated' => $paginatedProposals,
            'assessedData' => array_slice($assessedData, 0, 5),
            'assessedCount' => count($assessedData),
            'unassessedCount' => count($unassessedData),
        ])->with([
            'user' => 'dosen'
        ]);
    }

    public function penilaian($proposalId)
    {
        // Find the proposal by ID in dummy data
        $proposal = $this->getDummyProposals()->firstWhere('id', $proposalId);

        if (!$proposal) {
            abort(404, 'Proposal not found');
        }

        return view('dosen.penilaian', ['proposal' => $proposal])->with([
            'user' => 'dosen'
        ]);
    }
}
