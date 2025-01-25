@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" x-data="{ open: false, titleData: '', jadwal: '', title() { return this.titleData; } }">
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
                            class="w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-normal duration-300 bg-gray-50 py-2 pl-8 pr-4 text-sm" />
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto bg-white rounded-md border border-gray-200">
                <table class="w-full text-sm text-left divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700 uppercase tracking-wider">
                        <tr>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium">
                                NO
                            </th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium whitespace-nowrap">
                                NO DAFTAR</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                TANGGAL PENGAJUAN</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                NIM
                            </th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium">
                                NAMA
                            </th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium whitespace-nowrap">
                                PEMBIMBING 1</th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium whitespace-nowrap">
                                PEMBIMBING 2</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                JADWAL SIDANG TA</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                PROPOSAL TA</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                LAPORAN TA</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                JURNAL</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                SEMINAR</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI BIMBINGAN</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                POSTER</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI ORI</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI UPLOAD JURNAL</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI KEASLIAN</th>
                            <th class="px-6 py-3 text-center text-xs font-medium w-2/3">
                                HASIL</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($tugasAkhir as $index => $item)
                            <td rowspan="2" class="text-center px-4 py-2 whitespace-nowrap">{{ $index + 1 }}
                            <td colspan="12" class="border-s px-4 py-4 text-gray-900 font-medium">{{ $item['judul'] }}
                            </td>
                            <tr>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $item['no_daftar'] }}</td>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $item['tgl_pengajuan'] }}</td>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $item['nim'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $item['nama'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $item['pembimbing1'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $item['pembimbing2'] }}</td>
                                <td class="border text-center px-4 py-2">
                                    <button
                                        @click="open = true; titleData = 'Jadwal Sidang Tugas Akhir'; jadwal = '{{ $item['status'] === 'Dijadwalkan' ? '05-02-2025' : 'Belum dijadwalkan' }}'"
                                        class="cursor-pointer px-3 py-1.5 rounded rounded-md text-sm shadow-sm {{ $item['status'] === 'Dijadwalkan' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $item['status'] }}
                                    </button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i>
                                    </button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2 text-center">
                                    <button href="#" class="cursor-pointer text-blue-500">
                                        <i class="fa-solid fa-download fa-lg"></i></button>
                                </td>
                                <td class="px-4 py-2 space-y-2">
                                    <select class="ring ring-gray-300 rounded-md px-2 py-1 text-sm">
                                        <option value="diterima">Diterima</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                    <textarea class="w-full ring ring-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                        rows="2" placeholder="Keterangan jika ditolak"></textarea>
                                </td>
                            </tr>
                            </td>
                        @empty
                            <tr>
                                <td colspan="13" class="border py-12 text-center">Tidak ada data proposal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{ $tugasAkhir->links() }}
            </div>
        </div>
        <x-popup-window>
            <form method="POST" class="space-y-4 mb-4">
                @csrf
                <!-- Registration Details -->
                <div class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No Daftar</label>
                        <input type="text" value="2025010004" readonly
                            class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" value="20410100030" readonly
                            class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600">
                    </div>
                </div>

                <!-- Student Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" value="Reza Maulana Winardi" readonly
                        class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600">
                </div>

                <!-- Thesis Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <textarea readonly
                        class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600 resize-none"
                        rows="3">Evaluasi Dan Redesain Aplikasi GOBIS Suroboyo Bus Dengan Pendekatan Design Thinking Untuk Meningkatkan Pengalaman Pengguna</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jadwal</label>
                    <input type="text" readonly
                        class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600 resize-none"
                        x-model="jadwal">
                </div>

                <!-- Schedule Details -->
                <div class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="defense_date" value="2025-01-16"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jam</label>
                        <input type="time" name="defense_time" value="08:00"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Examiners -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Penguji</label>
                    <select name="examiner1"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="1" selected>Dr. Anjik Sukmaaji, S.Kom., M.Eng.</option>
                        <option value="2">Other Examiner 1</option>
                        <option value="3">Other Examiner 2</option>
                    </select>
                </div>

                <!-- Room -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ruang</label>
                    <select name="room"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="M504" selected>M504</option>
                        <option value="M505">M505</option>
                        <option value="M506">M506</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="cursor-pointer w-full sm:w-auto px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </x-popup-window>
    </div>
@endsection
