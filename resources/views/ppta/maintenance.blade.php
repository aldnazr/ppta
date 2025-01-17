@extends('layouts.app')

@section('content')
    <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden" x-data="{ open: false, title() { return 'Data Penguji' }, nik: '', nama: '', tingkat: '', status: '' }">
        <x-header>Maintenance Data Penguji</x-header>
        <div class="p-4 lg:p-6">
            <div class="flex flex-col mb-6 space-y-2">
                <div
                    class="w-full justify-end lg:w-auto flex flex-col lg:flex-row lg:items-center space-y-3 lg:space-y-0 lg:space-x-2">
                    <!-- Search Form -->
                    <form id="searchForm" method="GET" action="{{ url()->current() }}"
                        class="w-auto flex items-center space-x-1.5">
                        <div class="relative w-full md:w-72">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute h-full left-2 flex items-center h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}"
                                @keydown.enter="event.target.form.submit()" placeholder="Cari nik atau nama..."
                                class="w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-normal duration-300 bg-gray-50 py-2 pl-8 pr-4 text-sm" />
                        </div>
                    </form>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ url()->current() }}" class="relative" x-data="{ isMenuOpen: false }">
                        <button type="button" @click="isMenuOpen = !isMenuOpen"
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
                        <div id="advancedFilterDropdown" x-show="isMenuOpen" x-transition
                            @click.outside = "isMenuOpen = false"
                            class="absolute z-10 mt-2 bg-zinc-50 lg:-ml-[7rem] shadow-md rounded-lg p-4 border border-gray-200">
                            <h3 class="mb-2 font-semibold text-gray-900">Filter</h3>
                            <div class="space-y-2 text-sm">
                                <select name="tingkat"
                                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="" disabled selected>Tingkat</option>
                                    @foreach ($uniqueTingkat as $item)
                                        <option value="{{ $item }}"
                                            {{ $selectedTingkat == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                <select name="status"
                                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="" disabled selected>Status</option>
                                    @foreach ($uniqueStatus as $item)
                                        <option value="{{ $item }}"
                                            {{ $selectedStatus == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                <div class="flex justify-between space-x-2">
                                    <a href="{{ url()->current() }}"
                                        class="w-full flex justify-center bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Reset
                                    </a>
                                    <button type="submit"
                                        class="w-full flex justify-center bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto rounded-md border border-gray-200">
                <table class="min-h-[35vh] w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                NIK
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                Tingkat
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($employees->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 pt-8 text-center text-gray-500">Tidak ada
                                    data
                                    tersedia</td>
                            </tr>
                        @else
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $employee['nik'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $employee['name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $employee['tingkat'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $employee['status'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button
                                            @click="
                                                open = true;
                                                nik = '{{ $employee['nik'] }}';
                                                nama = '{{ $employee['name'] }}';
                                                tingkat = '{{ $employee['tingkat'] }}';
                                                status = '{{ $employee['status'] }}';
                                            "
                                            class="cursor-pointer bg-blue-500 px-2 py-0.5 rounded text-white hover:bg-blue-700">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <x-popup-window maxWidthLG="max-w-2xl">
                <form method="POST" action="#" class="-mt-3 space-y-4">
                    @csrf

                    <div class="space-y-1">
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input disabled type="number" id="nik" name="nik" :value="nik"
                            class="w-full h-10 px-1.5 bg-gray-200 rounded-md border border-gray-300 shadow-sm opacity-70">
                        </input>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input disabled type="text" id="nama" name="nama" :value="nama"
                            class="w-full h-10 px-1.5 bg-gray-200 rounded-md border border-gray-300 shadow-sm opacity-70">
                        </input>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkat</label>
                        <select id="tingkat" name="tingkat" :value="tingkat"
                            class="w-full h-10 px-1.5 text-slate-800 rounded-md border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                            <option value="">Select Level</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                        @error('tingkat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" x-model="status"
                            class="w-full h-10 px-1.5 text-slate-800 border rounded-md border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                            <option value="">Select Status</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Nonaktif</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="cursor-pointer w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Simpan
                    </button>
                </form>
            </x-popup-window>
        </div>
    </div>
@endsection
