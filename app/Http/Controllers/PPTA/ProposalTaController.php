<?php

namespace App\Http\Controllers\PPTA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class ProposalTaController extends Controller
{
    public function getDummyProposals()
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
                'no_daftar' => '2024110004',
                'tgl_pengajuan' => '08-11-2024',
                'nim' => '18410100159',
                'nama' => 'Adamas Relian Subagia',
                'judul' => 'Redesign UI/UX penyedia jasa servis barang elektronik Urgensi.id dengan metode design sprint',
                'pembimbing1' => 'Tri Sagirani, S.Kom., M.MT.',
                'pembimbing2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110003',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '21420200005',
                'nama' => 'Firqin Qolbi Al Fatah',
                'judul' => 'DESAIN PRODUK RAK PENGERINGAN SEPATU DENGAN TEKNOLOGI AIR DRYER',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Karsam, MA., Ph.D.',
                'status' => 'Revisi'
            ],
            [
                'no_daftar' => '2024110002',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '20420200001',
                'nama' => 'Kristian Eka Winarto',
                'judul' => 'Desain Produk Lemari Pakaian Dengan Konsep Space Saving Untuk Ruangan Dengan Luas Terbatas',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Yosef Richo Adrianto, S.T., M.SM.',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110001',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100089',
                'nama' => 'Ahmad Fauzi',
                'judul' => 'Pengembangan Sistem Informasi Manajemen Perpustakaan Berbasis Web',
                'pembimbing1' => 'Dr. Jusak, S.T., M.Kom.',
                'pembimbing2' => 'Tony Soebijono, S.E., S.H., M.Ak.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110000',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100090',
                'nama' => 'Bella Safira',
                'judul' => 'Implementasi Machine Learning untuk Prediksi Kelulusan Mahasiswa',
                'pembimbing1' => 'Dr. M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia, S.Kom., M.MT.',
                'status' => 'Disetujui'
            ],
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
                'no_daftar' => '2024110004',
                'tgl_pengajuan' => '08-11-2024',
                'nim' => '18410100159',
                'nama' => 'Adamas Relian Subagia',
                'judul' => 'Redesign UI/UX penyedia jasa servis barang elektronik Urgensi.id dengan metode design sprint',
                'pembimbing1' => 'Tri Sagirani, S.Kom., M.MT.',
                'pembimbing2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110003',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '21420200005',
                'nama' => 'Firqin Qolbi Al Fatah',
                'judul' => 'DESAIN PRODUK RAK PENGERINGAN SEPATU DENGAN TEKNOLOGI AIR DRYER',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Karsam, MA., Ph.D.',
                'status' => 'Revisi'
            ],
            [
                'no_daftar' => '2024110002',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '20420200001',
                'nama' => 'Kristian Eka Winarto',
                'judul' => 'Desain Produk Lemari Pakaian Dengan Konsep Space Saving Untuk Ruangan Dengan Luas Terbatas',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Yosef Richo Adrianto, S.T., M.SM.',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110001',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100089',
                'nama' => 'Ahmad Fauzi',
                'judul' => 'Pengembangan Sistem Informasi Manajemen Perpustakaan Berbasis Web',
                'pembimbing1' => 'Dr. Jusak, S.T., M.Kom.',
                'pembimbing2' => 'Tony Soebijono, S.E., S.H., M.Ak.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110000',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100090',
                'nama' => 'Bella Safira',
                'judul' => 'Implementasi Machine Learning untuk Prediksi Kelulusan Mahasiswa',
                'pembimbing1' => 'Dr. M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia, S.Kom., M.MT.',
                'status' => 'Disetujui'
            ],
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
                'no_daftar' => '2024110004',
                'tgl_pengajuan' => '08-11-2024',
                'nim' => '18410100159',
                'nama' => 'Adamas Relian Subagia',
                'judul' => 'Redesign UI/UX penyedia jasa servis barang elektronik Urgensi.id dengan metode design sprint',
                'pembimbing1' => 'Tri Sagirani, S.Kom., M.MT.',
                'pembimbing2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110003',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '21420200005',
                'nama' => 'Firqin Qolbi Al Fatah',
                'judul' => 'DESAIN PRODUK RAK PENGERINGAN SEPATU DENGAN TEKNOLOGI AIR DRYER',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Karsam, MA., Ph.D.',
                'status' => 'Revisi'
            ],
            [
                'no_daftar' => '2024110002',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '20420200001',
                'nama' => 'Kristian Eka Winarto',
                'judul' => 'Desain Produk Lemari Pakaian Dengan Konsep Space Saving Untuk Ruangan Dengan Luas Terbatas',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Yosef Richo Adrianto, S.T., M.SM.',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110001',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100089',
                'nama' => 'Ahmad Fauzi',
                'judul' => 'Pengembangan Sistem Informasi Manajemen Perpustakaan Berbasis Web',
                'pembimbing1' => 'Dr. Jusak, S.T., M.Kom.',
                'pembimbing2' => 'Tony Soebijono, S.E., S.H., M.Ak.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110000',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100090',
                'nama' => 'Bella Safira',
                'judul' => 'Implementasi Machine Learning untuk Prediksi Kelulusan Mahasiswa',
                'pembimbing1' => 'Dr. M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia, S.Kom., M.MT.',
                'status' => 'Disetujui'
            ],
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
                'no_daftar' => '2024110004',
                'tgl_pengajuan' => '08-11-2024',
                'nim' => '18410100159',
                'nama' => 'Adamas Relian Subagia',
                'judul' => 'Redesign UI/UX penyedia jasa servis barang elektronik Urgensi.id dengan metode design sprint',
                'pembimbing1' => 'Tri Sagirani, S.Kom., M.MT.',
                'pembimbing2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110003',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '21420200005',
                'nama' => 'Firqin Qolbi Al Fatah',
                'judul' => 'DESAIN PRODUK RAK PENGERINGAN SEPATU DENGAN TEKNOLOGI AIR DRYER',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Karsam, MA., Ph.D.',
                'status' => 'Revisi'
            ],
            [
                'no_daftar' => '2024110002',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '20420200001',
                'nama' => 'Kristian Eka Winarto',
                'judul' => 'Desain Produk Lemari Pakaian Dengan Konsep Space Saving Untuk Ruangan Dengan Luas Terbatas',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Yosef Richo Adrianto, S.T., M.SM.',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110001',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100089',
                'nama' => 'Ahmad Fauzi',
                'judul' => 'Pengembangan Sistem Informasi Manajemen Perpustakaan Berbasis Web',
                'pembimbing1' => 'Dr. Jusak, S.T., M.Kom.',
                'pembimbing2' => 'Tony Soebijono, S.E., S.H., M.Ak.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110000',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100090',
                'nama' => 'Bella Safira',
                'judul' => 'Implementasi Machine Learning untuk Prediksi Kelulusan Mahasiswa',
                'pembimbing1' => 'Dr. M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia, S.Kom., M.MT.',
                'status' => 'Disetujui'
            ],
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
                'no_daftar' => '2024110004',
                'tgl_pengajuan' => '08-11-2024',
                'nim' => '18410100159',
                'nama' => 'Adamas Relian Subagia',
                'judul' => 'Redesign UI/UX penyedia jasa servis barang elektronik Urgensi.id dengan metode design sprint',
                'pembimbing1' => 'Tri Sagirani, S.Kom., M.MT.',
                'pembimbing2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110003',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '21420200005',
                'nama' => 'Firqin Qolbi Al Fatah',
                'judul' => 'DESAIN PRODUK RAK PENGERINGAN SEPATU DENGAN TEKNOLOGI AIR DRYER',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Karsam, MA., Ph.D.',
                'status' => 'Revisi'
            ],
            [
                'no_daftar' => '2024110002',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '20420200001',
                'nama' => 'Kristian Eka Winarto',
                'judul' => 'Desain Produk Lemari Pakaian Dengan Konsep Space Saving Untuk Ruangan Dengan Luas Terbatas',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Yosef Richo Adrianto, S.T., M.SM.',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110001',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100089',
                'nama' => 'Ahmad Fauzi',
                'judul' => 'Pengembangan Sistem Informasi Manajemen Perpustakaan Berbasis Web',
                'pembimbing1' => 'Dr. Jusak, S.T., M.Kom.',
                'pembimbing2' => 'Tony Soebijono, S.E., S.H., M.Ak.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110000',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100090',
                'nama' => 'Bella Safira',
                'judul' => 'Implementasi Machine Learning untuk Prediksi Kelulusan Mahasiswa',
                'pembimbing1' => 'Dr. M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia, S.Kom., M.MT.',
                'status' => 'Disetujui'
            ],
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
                'no_daftar' => '2024110004',
                'tgl_pengajuan' => '08-11-2024',
                'nim' => '18410100159',
                'nama' => 'Adamas Relian Subagia',
                'judul' => 'Redesign UI/UX penyedia jasa servis barang elektronik Urgensi.id dengan metode design sprint',
                'pembimbing1' => 'Tri Sagirani, S.Kom., M.MT.',
                'pembimbing2' => 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110003',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '21420200005',
                'nama' => 'Firqin Qolbi Al Fatah',
                'judul' => 'DESAIN PRODUK RAK PENGERINGAN SEPATU DENGAN TEKNOLOGI AIR DRYER',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Karsam, MA., Ph.D.',
                'status' => 'Revisi'
            ],
            [
                'no_daftar' => '2024110002',
                'tgl_pengajuan' => '04-11-2024',
                'nim' => '20420200001',
                'nama' => 'Kristian Eka Winarto',
                'judul' => 'Desain Produk Lemari Pakaian Dengan Konsep Space Saving Untuk Ruangan Dengan Luas Terbatas',
                'pembimbing1' => 'Darwin Yuwono Riyanto, S.T., M.Med.Kom., ACA',
                'pembimbing2' => 'Yosef Richo Adrianto, S.T., M.SM.',
                'status' => 'Disetujui'
            ],
            [
                'no_daftar' => '2024110001',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100089',
                'nama' => 'Ahmad Fauzi',
                'judul' => 'Pengembangan Sistem Informasi Manajemen Perpustakaan Berbasis Web',
                'pembimbing1' => 'Dr. Jusak, S.T., M.Kom.',
                'pembimbing2' => 'Tony Soebijono, S.E., S.H., M.Ak.',
                'status' => 'Pending'
            ],
            [
                'no_daftar' => '2024110000',
                'tgl_pengajuan' => '01-11-2024',
                'nim' => '20410100090',
                'nama' => 'Bella Safira',
                'judul' => 'Implementasi Machine Learning untuk Prediksi Kelulusan Mahasiswa',
                'pembimbing1' => 'Dr. M.J. Dewiyani Sunarto',
                'pembimbing2' => 'Tan Amelia, S.Kom., M.MT.',
                'status' => 'Disetujui'
            ]
        ]);
    }

    public function index(Request $request)
    {
        $proposals = $this->getDummyProposals();

        $perPage = $request->input('per_page', 10);

        // Pencarian berdasarkan nama atau judul
        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search);
            $proposals = $proposals->filter(function ($proposal) use ($searchTerm) {
                return
                    str_contains(strtolower($proposal['nim']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['nama']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['judul']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['pembimbing1']), strtolower($searchTerm)) ||
                    str_contains(strtolower($proposal['pembimbing2']), strtolower($searchTerm));
            });
        }

        // Convert to collection for pagination
        $proposals = $proposals->values();

        // Pagination (menggunakan LengthAwarePaginator secara manual karena data berupa array)
        $currentPage = $request->input('page', 1); // Default 10 item per halaman
        $slicedProposals = $proposals->slice(($currentPage - 1) * $perPage, $perPage);
        $total = $proposals->count();
        $paginatedProposals = new LengthAwarePaginator(
            $slicedProposals,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('ppta.proposalta', [
            'proposals' => $paginatedProposals,
            'perPage' => $perPage
        ])->with([
            'user' => 'ppta'
        ]);
    }
}
