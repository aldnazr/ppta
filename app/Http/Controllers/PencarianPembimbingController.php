<?php

namespace App\Http\Controllers;

use App\Data\HomeTugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianPembimbingController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = $request->input('lecturer', '');

        // Sample data - in real app, this would come from database
        $tugasAkhir = collect([
            new HomeTugasAkhir(
                title: 'Rancang Bangun Sistem Informasi Pengendalian Persediaan menggunakan Metode Safety Stock dan Reorder Point pada CV Deha Tech',
                student_name: 'Gagah Primayoga',
                student_id: '17410100066',
                supervisor1: 'Prof. Dr. Bambang Hariadi, M.Pd.',
                supervisor2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '04/11/2024',
                room: 'M504',
                time: '09:10:00'
            ),
            new HomeTugasAkhir(
                title: 'REDESIGN WEBSITE PADA PT KYODO UTAMA INDONESIA UNTUK MENINGKATKAN USABILITY',
                student_name: 'Ahmad Fauzi Ari Ihfaudin',
                student_id: '18410100028',
                supervisor1: 'Dr. M.J. Dewiyani Sunarto',
                supervisor2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '',
                room: '',
                time: ''
            ),
            new HomeTugasAkhir(
                title: 'RANCANG BANGUN APLIKASI PENJUALAN BERBASIS WEBSITE PADA BATIK AL-BAROKAH UNTUK MENINGKAT DAYA JUAL',
                student_name: 'Alif Maulana Muhammad',
                student_id: '18410100201',
                supervisor1: 'Tan Amelia, S.Kom., M.MT., MCP',
                supervisor2: 'Arifin Puji Widodo, S.E., MSA',
                sidang_date: '',
                room: '',
                time: ''
            ),
            new HomeTugasAkhir(
                title: 'Rancang Bangun Sistem Informasi Pengendalian Persediaan menggunakan Metode Safety Stock dan Reorder Point pada CV Deha Tech',
                student_name: 'Gagah Primayoga',
                student_id: '17410100066',
                supervisor1: 'Prof. Dr. Bambang Hariadi, M.Pd.',
                supervisor2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '04/11/2024',
                room: 'M504',
                time: '09:10:00'
            ),
            new HomeTugasAkhir(
                title: 'REDESIGN WEBSITE PADA PT KYODO UTAMA INDONESIA UNTUK MENINGKATKAN USABILITY',
                student_name: 'Ahmad Fauzi Ari Ihfaudin',
                student_id: '18410100028',
                supervisor1: 'Dr. M.J. Dewiyani Sunarto',
                supervisor2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '',
                room: '',
                time: ''
            ),
            new HomeTugasAkhir(
                title: 'RANCANG BANGUN APLIKASI PENJUALAN BERBASIS WEBSITE PADA BATIK AL-BAROKAH UNTUK MENINGKAT DAYA JUAL',
                student_name: 'Alif Maulana Muhammad',
                student_id: '18410100201',
                supervisor1: 'Tan Amelia, S.Kom., M.MT., MCP',
                supervisor2: 'Arifin Puji Widodo, S.E., MSA',
                sidang_date: '',
                room: '',
                time: ''
            ),
            new HomeTugasAkhir(
                title: 'Rancang Bangun Sistem Informasi Pengendalian Persediaan menggunakan Metode Safety Stock dan Reorder Point pada CV Deha Tech',
                student_name: 'Gagah Primayoga',
                student_id: '17410100066',
                supervisor1: 'Prof. Dr. Bambang Hariadi, M.Pd.',
                supervisor2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '04/11/2024',
                room: 'M504',
                time: '09:10:00'
            ),
            new HomeTugasAkhir(
                title: 'REDESIGN WEBSITE PADA PT KYODO UTAMA INDONESIA UNTUK MENINGKATKAN USABILITY',
                student_name: 'Ahmad Fauzi Ari Ihfaudin',
                student_id: '18410100028',
                supervisor1: 'Dr. M.J. Dewiyani Sunarto',
                supervisor2: 'Tan Amelia, S.Kom., M.MT., MCP',
                sidang_date: '',
                room: '',
                time: ''
            ),
            new HomeTugasAkhir(
                title: 'RANCANG BANGUN APLIKASI PENJUALAN BERBASIS WEBSITE PADA BATIK AL-BAROKAH UNTUK MENINGKAT DAYA JUAL',
                student_name: 'Alif Maulana Muhammad',
                student_id: '18410100201',
                supervisor1: 'Tan Amelia, S.Kom., M.MT., MCP',
                supervisor2: 'Arifin Puji Widodo, S.E., MSA',
                sidang_date: '',
                room: '',
                time: ''
            )
        ]);

        $paginatedDataBimbingan = new LengthAwarePaginator(
            $tugasAkhir->forPage(request('page', 1), 3),
            $tugasAkhir->count(),
            3,
            request('page', 1),
            ['path' => request()->url()]
        );

        return view('pencarianpembimbing', compact('paginatedDataBimbingan', 'lecturer'));
    }
}
