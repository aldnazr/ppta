@extends('layouts.app')

@section('content')
    <div class="rounded-lg shadow-xl border border-gray-200 overflow-hidden">
        <x-header>Antrian Sidang Tugas Akhir</x-header>
        <div class="pb-6 px-6 pt-2">
            <div class="flex flex-col md:flex-row justify-between my-4 space-y-3 lg:space-y-0 lg:space-x-2">
                <form action="{{ url()->current() }}" id="perPageForm">
                    <div class="flex items-center">
                        <label for="per-page" class="mr-2">Tampilkan:</label>
                        <select id="per-page" name="per_page"
                            class="bg-gray-200 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onchange="document.getElementById('perPageForm').submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </div>
                </form>
                <form id="searchForm" method="GET" action="{{ url()->current() }}" class="w-auto flex items-center">
                    <!-- Search Bar -->
                    <div class="relative w-full md:w-72">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute h-full left-2 flex items-center h-4 w-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            @keydown.enter="event.target.form.submit()" placeholder="Pencarian..."
                            class="w-full rounded-lg border border-gray-400 outline-blue-500 bg-gray-50 py-2 pl-8 pr-4 text-sm" />
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto bg-white rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="text-center px-6 py-4 font-medium">No</th>
                            <th class="px-6 py-4 font-medium">No Daftar</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Tanggal Pengajuan</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">NIM</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Judul</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Pembimbing 1</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Pembimbing 2</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-600">Proposal/Laporan</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-600">Jurnal/Seminar</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-600">Bukti Bimbingan</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-600">Poster</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-600">Bukti Ori/JurKesalian</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-600 w-2/3">Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugasAkhir as $index => $item)
                            <tr>
                                <td class="border text-center px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700">{{ $item['no_daftar'] }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700">{{ $item['tgl_pengajuan'] }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700">{{ $item['nim'] }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700">{{ $item['nama'] }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700">{{ $item['judul'] }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700">{{ $item['pembimbing1'] }}</td>
                                <td class="border px-4 py-2 text-sm text-gray-700">{{ $item['pembimbing2'] }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="#" class="text-blue-500 underline">
                                        <i class="fa-solid fa-download fa-lg"></i>
                                    </a>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="#" class="text-blue-500 underline">
                                        <i class="fa-solid fa-download fa-lg"></i></a>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="#" class="text-blue-500 underline">
                                        <i class="fa-solid fa-download fa-lg"></i></a>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="#" class="text-blue-500 underline">
                                        <i class="fa-solid fa-download fa-lg"></i></a>
                                </td>
                                <td class="border px-4 py-2 text-center">
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
                        @empty
                            <tr>
                                <td colspan="14" class="border py-12 text-center">Tidak ada data proposal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{ $tugasAkhir->links() }}
            </div>
        </div>
    </div>
@endsection
