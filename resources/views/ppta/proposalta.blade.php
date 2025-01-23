@extends('layouts.app')

@section('content')
    <div class="rounded-xl shadow-lg border border-gray-200 overflow-hidden" x-data="{ open: false, titleData: '', title() { return this.titleData; } }">
        <x-header>Antrian Proposal Tugas Akhir</x-header>
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
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th
                                class="border-e px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                NO
                            </th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider whitespace-nowrap">
                                NO DAFTAR</th>
                            <th
                                class="border-e px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                TANGGAL PENGAJUAN</th>
                            <th
                                class="border-e px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                NIM
                            </th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                NAMA
                            </th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider whitespace-nowrap">
                                PEMBIMBING 1</th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                PEMBIMBING 2</th>
                            <th
                                class="border-e px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                JADWAL SIDANG PROPOSAL</th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                REVISI</th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                FILE
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                HASIL</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($proposals as $index => $proposal)
                            <td rowspan="2" class="text-center px-4 py-2">{{ $index + 1 }}
                            <td colspan="11" class="border-s px-4 py-4 font-medium">{{ $proposal['judul'] }}</td>
                            <tr>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['no_daftar'] }}</td>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $proposal['tgl_pengajuan'] }}
                                </td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['nim'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['nama'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['pembimbing1'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['pembimbing2'] }}</td>
                                <td class="border text-center px-4 py-2">
                                    <button @click="open = true; titleData = 'Jadwal Sidang Proposal TA'"
                                        class="cursor-pointer px-2.5 py-1.5 rounded text-sm
                                                {{ $proposal['status'] === 'Dijadwalkan' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                        {{ $proposal['status'] }}
                                    </button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2"></td>
                                <td class="text-center text-zinc-600 border px-4 py-2">
                                    <button href="#" class="cursor-pointer text-blue-500 underline">
                                        <i class="fa-solid fa-download fa-lg"></i>
                                    </button>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="relative" x-data="{ isUpdateopen: false }">
                                        <button @click="isUpdateopen = !isUpdateopen"
                                            class="cursor-pointer px-3 py-1 text-gray-600 hover:text-gray-800 border border-gray-400 rounded-md hover:bg-gray-100 focus:outline-none inline-flex items-center"
                                            type="button">
                                            <span>Update Status</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div x-show="isUpdateopen" @click.outside="isUpdateopen = false"
                                            class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-50 border"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100">
                                            <div class="py-1">
                                                <!-- ACC -->
                                                <div>
                                                    <input type="hidden" name="status" value="ACC">
                                                    <button
                                                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-green-50 hover:text-green-700 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        ACC
                                                    </button>
                                                </div>

                                                <!-- ACC Bersyarat -->
                                                <div>
                                                    <input type="hidden" name="status" value="ACC Bersyarat">
                                                    <button
                                                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-blue-50 hover:text-blue-700 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                        ACC Bersyarat
                                                    </button>
                                                </div>

                                                <!-- ACC Bersyarat Sidang Ulang -->
                                                <div>
                                                    <input type="hidden" name="status"
                                                        value="ACC Bersyarat Sidang Ulang">
                                                    <button
                                                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-purple-50 hover:text-purple-700 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                        Sidang Ulang
                                                    </button>
                                                </div>

                                                <!-- Materi Kurang -->
                                                <div>
                                                    <input type="hidden" name="status" value="Materi Kurang">
                                                    <button
                                                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                        Ditolak
                                                    </button>
                                                </div>

                                                <!-- Ditolak -->
                                                <div>
                                                    <input type="hidden" name="status" value="Ditolak">
                                                    <button
                                                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Hangus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </td>
                        @empty
                            <tr>
                                <td colspan="14" class="border py-12 text-center">Tidak ada data proposal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $proposals->links() }}
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
                        value="Belum Di jadwalkan">
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
    <script>
        let searchTimeout;

        function submitSearchForm() {
            const form = document.getElementById('searchForm');

            // Hentikan timeout sebelumnya (debouncing)
            clearTimeout(searchTimeout);

            // Tetapkan timeout baru
            searchTimeout = setTimeout(() => {
                form.submit();
            }, 300); // Tunggu 300ms setelah pengguna berhenti mengetik
        }
    </script>
@endsection
