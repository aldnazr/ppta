@extends('layouts.app')

@section('content')
    <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
            <h1 class="text-3xl font-extrabold text-white text-center tracking-tight">
                Maintenance Data Penguji
            </h1>
        </div>
        <div class="p-6">
            <div class="flex flex-col mb-6 space-y-2">
                <div
                    class="w-full justify-end lg:w-auto flex flex-col lg:flex-row lg:items-center space-y-3 lg:space-y-0 lg:space-x-2">
                    <!-- Search Form -->
                    <form id="searchForm" method="GET" action="{{ url()->current() }}"
                        class="w-auto flex items-center space-x-1.5">
                        <div class="flex-grow md:flex-grow-0 md:w-64">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Pencarian..."
                                class="w-full bg-gray-200 text-sm rounded-md px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded cursor-pointer">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </form>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ url()->current() }}" class="relative" x-data="{ isMenuOpen: false }">
                        <button type="button" @click="isMenuOpen = !isMenuOpen"
                            class="bg-blue-100 text-blue-600 px-3 py-1.5 rounded flex items-center hover:text-blue-700 hover:bg-blue-200 cursor-pointer">
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
                            class="absolute z-10 mt-1 bg-zinc-50 lg:-ml-[7rem] shadow-md rounded-md p-4 border border-gray-200">
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
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NIK
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tingkat
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
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
                                    <a href="#" class="text-blue-600 hover:text-blue-900">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
