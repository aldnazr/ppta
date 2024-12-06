@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-xl border border-gray-200 mx-auto overflow-hidden">
        <x-header>Antrian Sidang Tugas Akhir</x-header>
        <div class="overflow-x-auto shadow-lg rounded-lg p-4 lg:p-6">
            <table class="w-full table-auto border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">No.</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tanggal Pengajuan</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">NIM</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Judul</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Pembimbing 1</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Pembimbing 2</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Proposal/Laporan</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Jurnal/Seminar</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Bukti Bimbingan</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Poster</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Bukti Ori/JurKesalian</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600 w-2/3">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">1</td>
                        <td class="px-4 py-2 text-sm text-gray-700">25-10-2024</td>
                        <td class="px-4 py-2 text-sm text-gray-700">1741010066</td>
                        <td class="px-4 py-2 text-sm text-gray-700">Gagah Primayoga</td>
                        <td class="px-4 py-2 text-sm text-gray-700">Rancang Bangun Sistem Informasi Pengendalian...</td>
                        <td class="px-4 py-2 text-sm text-gray-700">Prof. Dr. Bambang Hariadi, M.Pd</td>
                        <td class="px-4 py-2 text-sm text-gray-700">Tan Amelia, S.Kom, M.MT.</td>
                        <td class="px-4 py-2 text-center">
                            <a href="#" class="text-blue-500 underline">
                                <i class="fa-solid fa-download fa-lg"></i>
                            </a>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="#" class="text-blue-500 underline">
                                <i class="fa-solid fa-download fa-lg"></i></a>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="#" class="text-blue-500 underline">
                                <i class="fa-solid fa-download fa-lg"></i></a>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="#" class="text-blue-500 underline">
                                <i class="fa-solid fa-download fa-lg"></i></a>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="#" class="text-blue-500 underline">
                                <i class="fa-solid fa-download fa-lg"></i></a>
                        </td>
                        <td class="px-4 py-2 space-y-2">
                            <select class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                            <textarea class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                rows="2" placeholder="Keterangan jika ditolak"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
