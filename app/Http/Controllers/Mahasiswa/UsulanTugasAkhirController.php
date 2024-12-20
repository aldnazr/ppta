<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Data\UsulanlTA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class UsulanTugasAkhirController extends Controller
{
    public function index()
    {
        $judulTugasAkhir = collect([
            new UsulanlTA('Penjadwalan Ujian', 'A. B. Tjandranini, S.Si., M.Kom.', 'Penjadwalan Ujian Meliputi Penjadwalan UTS dan UAS. Penjadwalan Melibatkan Tanggal Pelaksanaan Ujian, Jam Shift Ujian, Ruang Ujian dan Kapasitasnya, Jumlah Petugas Jaga Ujian, Mata Pelajaran.'),
            new UsulanlTA('Penjadwalan Ujian', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Peramalan Jumlah Peserta MataKuliah', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Analisis Faktor-Faktor Kepuasan Pelanggan Pada Pelayanan Akademik', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Penjadwalan Ujian', 'A. B. Tjandranini, S.Si., M.Kom.', 'Penjadwalan Ujian Meliputi Penjadwalan UTS dan UAS. Penjadwalan Melibatkan Tanggal Pelaksanaan Ujian, Jam Shift Ujian, Ruang Ujian dan Kapasitasnya, Jumlah Petugas Jaga Ujian, Mata Pelajaran.'),
            new UsulanlTA('Penjadwalan Ujian', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Peramalan Jumlah Peserta MataKuliah', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Analisis Faktor-Faktor Kepuasan Pelanggan Pada Pelayanan Akademik', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Internet Protocol TV (IPTV) Project', 'Dr. Jusak', 'Dibutuhkan 5-6 Orang Untuk Mengerjakan Proyek Tugas Akhir Dalam Pembuatan Aplikasi IPTV Dengan Menggunakan Bahasa Pemrograman Java. Proyek Ini Meliputi Pembuatan Interface, Pembuat Aplikasi IPTV.'),
            new UsulanlTA('Penjadwalan Ujian', 'A. B. Tjandranini, S.Si., M.Kom.', 'Penjadwalan Ujian Meliputi Penjadwalan UTS dan UAS. Penjadwalan Melibatkan Tanggal Pelaksanaan Ujian, Jam Shift Ujian, Ruang Ujian dan Kapasitasnya, Jumlah Petugas Jaga Ujian, Mata Pelajaran.'),
            new UsulanlTA('Penjadwalan Ujian', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Peramalan Jumlah Peserta MataKuliah', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Analisis Faktor-Faktor Kepuasan Pelanggan Pada Pelayanan Akademik', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Penjadwalan Ujian', 'A. B. Tjandranini, S.Si., M.Kom.', 'Penjadwalan Ujian Meliputi Penjadwalan UTS dan UAS. Penjadwalan Melibatkan Tanggal Pelaksanaan Ujian, Jam Shift Ujian, Ruang Ujian dan Kapasitasnya, Jumlah Petugas Jaga Ujian, Mata Pelajaran.'),
            new UsulanlTA('Penjadwalan Ujian', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Peramalan Jumlah Peserta MataKuliah', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Analisis Faktor-Faktor Kepuasan Pelanggan Pada Pelayanan Akademik', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Internet Protocol TV (IPTV) Project', 'Dr. Jusak', 'Dibutuhkan 5-6 Orang Untuk Mengerjakan Proyek Tugas Akhir Dalam Pembuatan Aplikasi IPTV Dengan Menggunakan Bahasa Pemrograman Java. Proyek Ini Meliputi Pembuatan Interface, Pembuat Aplikasi IPTV.'),
            new UsulanlTA('Penjadwalan Ujian', 'A. B. Tjandranini, S.Si., M.Kom.', 'Penjadwalan Ujian Meliputi Penjadwalan UTS dan UAS. Penjadwalan Melibatkan Tanggal Pelaksanaan Ujian, Jam Shift Ujian, Ruang Ujian dan Kapasitasnya, Jumlah Petugas Jaga Ujian, Mata Pelajaran.'),
            new UsulanlTA('Penjadwalan Ujian', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Peramalan Jumlah Peserta MataKuliah', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Analisis Faktor-Faktor Kepuasan Pelanggan Pada Pelayanan Akademik', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Penjadwalan Ujian', 'A. B. Tjandranini, S.Si., M.Kom.', 'Penjadwalan Ujian Meliputi Penjadwalan UTS dan UAS. Penjadwalan Melibatkan Tanggal Pelaksanaan Ujian, Jam Shift Ujian, Ruang Ujian dan Kapasitasnya, Jumlah Petugas Jaga Ujian, Mata Pelajaran.'),
            new UsulanlTA('Penjadwalan Ujian', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Peramalan Jumlah Peserta MataKuliah', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Analisis Faktor-Faktor Kepuasan Pelanggan Pada Pelayanan Akademik', 'Vivine Nurcahyawati, M.Kom, OCP', 'Deskripsi tidak tersedia pada gambar.'),
            new UsulanlTA('Internet Protocol TV (IPTV) Project', 'Dr. Jusak', 'Dibutuhkan 5-6 Orang Untuk Mengerjakan Proyek Tugas Akhir Dalam Pembuatan Aplikasi IPTV Dengan Menggunakan Bahasa Pemrograman Java. Proyek Ini Meliputi Pembuatan Interface, Pembuat Aplikasi IPTV.'),

        ]);

        // Pagination: Menampilkan 6 item per halaman
        $paginatedJudulTugasAkhir = new LengthAwarePaginator(
            $judulTugasAkhir->forPage(
                request('page', 1),
                2
            ),
            $judulTugasAkhir->count(),
            2,
            request('page', 1),
            ['path' => request()->url()]
        );

        return view(
            'mahasiswa.usulan',
            compact('paginatedJudulTugasAkhir')
        );
    }
}
