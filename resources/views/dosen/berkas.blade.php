@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden border-b border-gray-200 rounded-xl shadow-lg overflow-hidden">
        <x-header>Berkas</x-header>
        <div class="p-4 lg:p-6">
            <div class="flex flex-col md:flex-row justify-between mb-6 space-y-3 md:space-y-0">
                <!-- Per Page Selector -->
                <form method="GET" action="{{ url()->current() }}" id="perPageForm"
                    class="w-full md:w-auto flex items-center justify-start gap-2">
                    <label for="per-page" class="whitespace-nowrap">Tampilkan:</label>
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

                        <!-- Keep existing per_page and filter values to maintain state -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                    </form>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ url()->current() }}" class="relative" x-data="{ isMenuOpen: false }">
                        <button type ="button" @click="isMenuOpen = !isMenuOpen"
                            class="bg-blue-100 text-blue-600 px-3 py-1.5 rounded-md flex items-center hover:text-blue-700 hover:bg-blue-200 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 16v-4.414L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter
                        </button>

                        <!-- Advanced Filter Dropdown -->
                        <div id="advancedFilterDropdown" x-show="isMenuOpen" @click.outside = "isMenuOpen = false"
                            class="absolute lg:right-0 z-10 mt-1 bg-zinc-50 shadow-md rounded-lg p-4 border border-gray-200">
                            <h3 class="mb-2 font-semibold text-gray-900">Berkas</h3>
                            <div class="grid gap-4">
                                <ul
                                    class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                                    <li class="w-full border-b border-gray-200 rounded-t-lg">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-semua" type="radio" value="" name="filter"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                {{ request('filter') == '' ? 'checked' : '' }}
                                                onchange="this.closest('form').submit()">
                                            <label for="list-radio-semua"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Semua</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-proposal" type="radio" value="proposal" name="filter"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                {{ request('filter') == 'proposal' ? 'checked' : '' }}
                                                onchange="this.closest('form').submit()">
                                            <label for="list-radio-proposal"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Proposal</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-tugas_akhir" type="radio" value="tugas_akhir"
                                                name="filter"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                {{ request('filter') == 'tugas_akhir' ? 'checked' : '' }}
                                                onchange="this.closest('form').submit()">
                                            <label for="list-radio-tugas_akhir"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Tugas
                                                Akhir</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Keep existing per_page and search values to maintain state -->
                            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto rounded-md border border-gray-200">
                <table class="min-h-[35vh] w-full text-sm text-left divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tgl Pengajuan Proposal
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tgl Pengajuan TA
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mahasiswa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pembiming
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Penguji
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Siap Transfer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($proposals->isEmpty())
                            <tr>
                                <td colspan="9" class="px-6 text-base pt-8 text-center text-gray-500">Tidak ada
                                    data
                                    tersedia</td>
                            </tr>
                        @else
                            @foreach ($proposals as $index => $proposal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposals->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['tgl_pengajuan_proposal'] ? date('d-m-Y', strtotime($proposal['tgl_pengajuan_proposal'])) : '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['tgl_pengajuan_ta'] ? date('d-m-Y', strtotime($proposal['tgl_pengajuan_ta'])) : '' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proposal['nim'] }}
                                        {{ $proposal['nama_mahasiswa'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proposal['judul'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        1. {{ $proposal['pembimbing1'] }}
                                        2. {{ $proposal['pembimbing2'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['penguji'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['siap_transfer'] ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('berkas.penilaian', ['id' => $proposal['id']]) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 rounded">
                                            Nilai
                                        </a>
                                    </td>
                                </tr>
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
