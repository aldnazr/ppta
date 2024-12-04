<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                'status' => 'Proses',
                'tipe' => 'proposal'
            ],
            [
                'id' => 2,
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

        if ($request->has('filter')) {
            $filterTerm = strtolower($request->filter);

            if ($filterTerm === 'proposal') {
                $proposals = $proposals->where('tipe', 'proposal');
            } elseif ($filterTerm === 'tugas_akhir') {
                $proposals = $proposals->where('tipe', 'tugas_akhir');
            }
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
            'currentFilter' => $request->input('filter', 'semua')
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
