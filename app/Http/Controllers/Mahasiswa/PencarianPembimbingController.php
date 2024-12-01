<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Data\HomeTugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianPembimbingController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = $request->input('lecturer', '');

        $tugasAkhirData  = collect([
            new HomeTugasAkhir(
                title: 'Rancang Bangun Sistem Informasi Pengendalian Persediaan menggunakan Metode Safety Stock dan Reorder Point pada CV Deha Tech',
                student_name: 'Gagah Primayoga',
                student_id: '17410100066',
                pembimbing1: 'Prof. Dr. Bambang Hariadi, M.Pd.',
                pembimbing2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '04/11/2024',
                room: 'M504',
                time: '09:10:00'
            ),
            new HomeTugasAkhir(
                title: 'Rancang Bangun Sistem Informasi Pengendalian Persediaan menggunakan Metode Safety Stock dan Reorder Point pada CV Deha Tech',
                student_name: 'Gagah Primayoga',
                student_id: '17410100066',
                pembimbing1: 'Prof. Dr. Bambang Hariadi, M.Pd.',
                pembimbing2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '04/11/2024',
                room: 'M504',
                time: '09:10:00'
            ),
            new HomeTugasAkhir(
                title: 'RANCANG BANGUN APLIKASI PENGENDALIAN STOK ATK DAN ALAT KEBERSIHAN MENGGUNAKAN METODE REORDER POINT BERBASIS WEB PADA CV. AMIIN NUGERAHA',
                student_name: 'Achmad Lukman Hakim',
                student_id: '17410100004',
                pembimbing1: 'Agus Dwi Churniawan, S.Si., M.Kom.',
                pembimbing2: 'Vivine Nurcahyawati, M.Kom, OCP',
                sidang_date: '29/11/2024',
                room: 'M504',
                time: ''
            ),
            new HomeTugasAkhir(
                title: 'RANCANG BANGUN APLIKASI PENJUALAN MENGGUNAKAN METODE GAMIFICATION PADA UMKM SALSABILLAH HIJAB',
                student_name: 'Rizaldy Pasya Wijaya',
                student_id: '17410100017',
                pembimbing1: 'Agus Dwi Churniawan, S.Si., M.Kom.',
                pembimbing2: 'Ir. Henry Bambang Setyawan, M.M.',
                sidang_date: '29/11/2024',
                room: 'M504',
                time: '01:11:00'
            ),
            new HomeTugasAkhir(
                title: 'RANCANG BANGUN APLIKASI PENJADWALAN PROYEK PADA CV TIGA BERSAMA MANDIRI DENGAN MENGGUNAKAN METODE CRITICAL PATH METHOD (CPM)',
                student_name: 'Alwi Shabab',
                student_id: '17410100132',
                pembimbing1: 'Agus Dwi Churniawan, S.Si., M.Kom.',
                pembimbing2: 'Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA',
                sidang_date: '26/11/2024',
                room: 'M504',
                time: '02:11:00'
            ),
            new HomeTugasAkhir(
                title: 'ANALISIS SENTIMEN PUBLIK TERHADAP PELAYANAN IBADAH HAJI MENGGUNAKAN ALGORITMA NAIVE BAYES CLASSIFIER',
                student_name: 'Muhammad Rheza Malano',
                student_id: '17410100172',
                pembimbing1: 'Tutut Wurijanto, M.Kom.',
                pembimbing2: 'Agus Dwi Churniawan, S.Si., M.Kom.',
                sidang_date: '',
                room: '',
                time: ''
            ),
            new HomeTugasAkhir(
                title: 'Rancang Bangun Aplikasi Persediaan menggunakan Metode Safety Stock dan Reorder Point (ROP) pada PT. Go Part Car Surabaya',
                student_name: 'Muhammad Yusuf Ash-Shiddiq',
                student_id: '17410100192',
                pembimbing1: 'Dr. M.J. Dewiyani Sunarto',
                pembimbing2: 'Agus Dwi Churniawan, S.Si., M.Kom.',
                sidang_date: '',
                room: '',
                time: ''
            )
        ]);

        // Prepare the list of unique lecturers
        $dosens = $tugasAkhirData->flatMap(function ($item) {
            return [$item->pembimbing1, $item->pembimbing2];
        })->unique()->values()->toArray();

        // Filter data only if lecturer input is provided
        if (!empty($lecturer)) {
            $filteredData = $tugasAkhirData->filter(function ($item) use ($lecturer) {
                return $item->pembimbing1 === $lecturer || $item->pembimbing2 === $lecturer;
            });
        } else {
            $filteredData = collect(); // Empty collection if no lecturer input
        }

        $paginatedDataBimbingan = new LengthAwarePaginator(
            $filteredData->forPage(request('page', 1), 5),
            $filteredData->count(),
            5,
            request('page', 1),
            ['path' => request()->url()]
        );

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'dataBimbingan' => $paginatedDataBimbingan->items(),
                'total' => $paginatedDataBimbingan->total(),
                'lecturer' => $lecturer
            ]);
        }

        return view('mahasiswa.pencarianpembimbing', [
            'paginatedDataBimbingan' => $paginatedDataBimbingan,
            'lecturer' => $lecturer,
            'dosens' => $dosens
        ]);
    }
}
