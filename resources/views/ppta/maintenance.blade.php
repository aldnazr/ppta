@extends('layouts.app')

@section('content')
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden" x-data="{ open: false, title() { return 'Data Penguji' }, nik: '', nama: '', tingkat: '', status: '' }">
        <x-header>Maintenance Data Penguji</x-header>
        <div class="p-4 lg:p-6">
            <div class="flex flex-col mb-6 space-y-2">
                <div
                    class="w-full justify-end lg:w-auto flex flex-col lg:flex-row lg:items-center space-y-3 lg:space-y-0 lg:space-x-2">
                    <!-- Search Form -->
                    <form id="searchForm" method="GET" action="{{ url()->current() }}"
                        class="w-auto flex items-center space-x-1.5">
                        <!-- Search Bar -->
                        <x-search name="search" placeholder="Cari sesuatu..." />
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
                                        <option value="{{ $item }}">
                                            {{ $item }}
                                        </option>
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
            <div class="overflow-x-auto rounded-md border border-gray-300">
                <table class="min-h-[35vh] w-full divide-y divide-gray-300">
                    <thead class="bg-gray-200 text-gray-700 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium">
                                NIK
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium">
                                Tingkat
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium">
                                Status
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium">
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
                                        {{ $employee['nama_gelar'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        {{ $employee['tingkat'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        {{ $employee['sts_aktif'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <button
                                            @click="
                                                open = true;
                                                nik = '{{ $employee['nik'] }}';
                                                nama = '{{ $employee['nama_gelar'] }}';
                                                tingkat = '{{ $employee['tingkat'] }}';
                                                status = '{{ $employee['sts_aktif'] }}';
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
                <form method="POST" action="#" class="-mt-1 md:-mt-2 mb-1 space-y-4">
                    @csrf

                    <div class="space-y-1.5">
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input disabled type="number" id="nik" name="nik" :value="nik"
                            class="w-full h-10 px-1.5 bg-gray-200 rounded-md border border-gray-300 shadow-sm opacity-70">
                        </input>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input disabled type="text" id="nama" name="nama" :value="nama"
                            class="w-full h-10 px-1.5 bg-gray-200 rounded-md border border-gray-300 shadow-sm opacity-70">
                        </input>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkat</label>
                        <select id="tingkat" name="tingkat" :value="tingkat"
                            class="w-full h-10 px-1.5 text-slate-800 rounded-md border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                        @error('tingkat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" x-model="status"
                            class="w-full h-10 px-1.5 text-slate-800 border rounded-md border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                            @foreach ($uniqueStatus as $item)
                                <option value="{{ $item }}">
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="mt-6 cursor-pointer w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Simpan
                    </button>
                </form>
            </x-popup-window>
        </div>
    </div>
@endsection
