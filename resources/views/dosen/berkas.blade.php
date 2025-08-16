@extends('layouts.app')

@section('content')
    <div class="bg-white border-b border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <x-header>Berkas</x-header>
        <div class="p-5 lg:p-8">
            <div class="flex flex-col md:flex-row justify-between mb-6 space-y-3 md:space-y-0">
                <!-- Per Page Selector -->
                <form method="GET" action="{{ url()->current() }}" id="perPageForm"
                    class="w-full md:w-auto flex items-center justify-start gap-2">
                    <label for="per-page" class="text-nowrap">Tampilkan:</label>
                    <select id="per-page" name="per_page"
                        class="w-20 bg-gray-200 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>

                    <!-- Keep existing search and filter values to maintain state -->
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                </form>

                <div class="w-full md:w-auto flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 md:space-x-2">
                    <!-- Search Form -->
                    <form id="searchForm" method="GET" action="{{ url()->current() }}" class="w-auto flex items-center">
                        <!-- Search Bar -->
                        <div class="relative flex w-full md:w-72 items-center">
                            <i class="fa-solid fa-magnifying-glass fa-sm absolute left-3 text-gray-700/90"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                @keydown.enter="event.target.form.submit()" placeholder="Pencarian"
                                class="w-full py-2 pl-10 pr-4 bg-gray-100 placeholder-gray-500 text-sm text-gray-700/90 rounded-lg ring ring-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" />
                        </div>

                        <!-- Keep existing per_page and filter values to maintain state -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                    </form>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ url()->current() }}" class="relative" x-data="{ isMenuOpen: false }">
                        <button type="button" @click="isMenuOpen = !isMenuOpen"
                            class="bg-blue-100 text-blue-700 px-3 py-1.5 rounded-md flex items-center hover:text-blue-700 hover:bg-blue-200 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 16v-4.414L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter
                        </button>

                        <!-- Advanced Filter Dropdown -->
                        <div id="advancedFilterDropdown" x-transition x-show="isMenuOpen"
                            @click.outside="isMenuOpen = false"
                            class="absolute lg:right-0 z-10 mt-2 bg-zinc-50 shadow-md rounded-lg p-4 border border-gray-200">
                            <h3 class="mb-2 font-semibold text-gray-900">Berkas</h3>
                            <div class="grid gap-4">
                                <ul
                                    class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                                    <li class="w-full border-b border-gray-200 rounded-t-lg">
                                        <div class="flex items-center ps-3">
                                            <!-- Gunakan name filter_berkas -->
                                            <input id="list-radio-semua" type="radio" value="semua" name="filter_berkas"
                                                class="w-4 h-4 text-blue-700 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                {{ request('filter_berkas', 'semua') == 'semua' ? 'checked' : '' }}
                                                onchange="this.closest('form').submit()">
                                            <label for="list-radio-semua"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Semua</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-proposal" type="radio" value="proposal"
                                                name="filter_berkas"
                                                class="w-4 h-4 text-blue-700 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                {{ request('filter_berkas') == 'proposal' ? 'checked' : '' }}
                                                onchange="this.closest('form').submit()">
                                            <label for="list-radio-proposal"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Proposal</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-tugas_akhir" type="radio" value="tugas_akhir"
                                                name="filter_berkas"
                                                class="w-4 h-4 text-blue-700 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                {{ request('filter_berkas') == 'tugas_akhir' ? 'checked' : '' }}
                                                onchange="this.closest('form').submit()">
                                            <label for="list-radio-tugas_akhir"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Tugas
                                                Akhir</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Pertahankan nilai per_page dan search untuk menjaga state -->
                            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        </div>
                    </form>

                </div>
            </div>

            <div class="overflow-x-auto rounded-md border border-gray-300">
                <table class="min-h-[35vh] w-full text-sm text-left divide-y divide-gray-300">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th scope="col"
                                class="border-e p-4 text-left text-xs font-medium uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="border-e p-4 text-center text-xs font-medium uppercase tracking-wider">
                                Tgl Pengajuan Proposal
                            </th>
                            <th scope="col"
                                class="border-e p-4 text-center text-xs font-medium uppercase tracking-wider">
                                Tgl Pengajuan TA
                            </th>
                            <th scope="col"
                                class="border-e p-4 text-left text-xs font-medium uppercase tracking-wider">
                                Mahasiswa
                            </th>
                            <th scope="col"
                                class="border-e p-4 text-left text-xs font-medium uppercase tracking-wider">
                                Pembiming
                            </th>
                            <th scope="col"
                                class="border-e p-4 text-left text-xs font-medium uppercase tracking-wider">
                                Penguji
                            </th>
                            <th scope="col"
                                class="border-e p-4 text-left text-xs font-medium uppercase tracking-wider">
                                Siap Transfer
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($proposals->isEmpty())
                            <tr>
                                <td colspan="8" class="px-6 text-base pt-8 text-center">Tidak ada data tersedia</td>
                            </tr>
                        @else
                            @foreach ($proposals as $index => $proposal)
                                <td rowspan="2" class="text-center p-4 text-nowrap">
                                    {{ $index + 1 }}
                                <td colspan="8" class="border-s p-4 text-gray-900 font-medium">
                                    {{ $proposal['jdl_proposal'] }}
                                </td>
                                <tr>
                                    <td class="border text-zinc-700 text-center p-4 text-nowrap">
                                        {{ $proposal['wkt_proposal'] ? date('d-m-Y', strtotime($proposal['wkt_proposal'])) : '' }}
                                    </td>
                                    <td class="border text-zinc-700 text-center p-4 text-nowrap">
                                        {{ $proposal['wkt_ta'] ? date('d-m-Y', strtotime($proposal['wkt_ta'])) : '' }}
                                    </td>
                                    <td class="border p-4 text-zinc-700 text-nowrap">
                                        {{ $proposal['mhs_nim'] }}
                                        <br>
                                        {{ $proposal['mhs_nama'] }}
                                    </td>
                                    <td class="border p-4 text-zinc-700 md:text-nowrap">
                                        <ol class="list-decimal pl-4">
                                            <li>{{ $proposal['pembimbing_1_nama'] }}</li>
                                            <li>{{ $proposal['pembimbing_2_nama'] }}</li>
                                        </ol>
                                    </td>
                                    <td class="border p-4 text-zinc-700 md:text-nowrap">
                                        {{ $proposal['penguji_1_nama'] }}
                                    </td>
                                    <td class="border p-4 text-zinc-700 text-nowrap">
                                        {{ $proposal['siap_transfer'] ?? '' }}
                                    </td>
                                    <td class="border p-4 text-zinc-700 text-nowrap">
                                        <a href="{{ route('dosen.berkas.penilaian', ['mhs_nim' => $proposal['mhs_nim'], 'kode_antri' => $proposal['kode_antrian']]) }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 px-2.5 rounded">
                                            Nilai
                                        </a>
                                    </td>
                                </tr>
                                </td>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div>
                {{ $proposals->links() }}
            </div>
        </div>

    </div>
@endsection
