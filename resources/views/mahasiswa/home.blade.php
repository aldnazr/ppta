@extends('layouts.app')

@section('content')
    <div x-data="{ open: true }">
        <div x-show = "open"
            class ="bg-white backdrop-blur-lg rounded-md shadow-xl border border-white/20 overflow-hidden mb-6">
            <!-- Improved Welcome Greeting -->
            <div class="relative py-4 md:py-8">
                <div class="absolute right-0 top-0 p-3 md:p-5">
                    <button @click="open = false"
                        class="cursor-pointer flex items-center justify-center w-7 h-7 md:w-9 md:h-9 bg-blue-900/20 hover:bg-blue-900/40 rounded-full">
                        <i class="fa-solid text-black/60 fa-xmark fa-sm"></i>
                    </button>
                </div>

                <div class="max-w-4xl mx-auto flex flex-col items-center justify-center space-y-6">
                    <!-- Animated Icon Container -->
                    <div
                        class="inline-block p-3 md:p-5 bg-blue-800/20 backdrop-blur-sm rounded-2xl mb-4 transform transition-all duration-300">
                        <svg class="w-8 md:w-14 h-8 md:h-14 text-blue-800 animate-pulse" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>

                    <!-- Text Content -->
                    <div class="text-center space-y-4">
                        <h1 class="text-2xl md:text-4xl font-bold text-blue-700 mb-2 leading-tight">
                            Selamat Datang di<br>
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-amber-400">
                                PPTA
                            </span>
                        </h1>
                        <p class="text-xl text-black/90 font-medium max-w-2xl mx-auto leading-relaxed">
                            Universitas Dinamika
                        </p>
                    </div>
                </div>

                <!-- Decorative Waves -->
                <div class="absolute bottom-0 left-0 right-0">
                    <svg class="w-full h-16 text-blue-500" viewBox="0 0 500 100" preserveAspectRatio="none">
                        <path d="M0,70 C150,110 350,25 500,70 L500,100 L0,100 Z" fill="currentColor" opacity="0.1"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        <x-header>Daftar Sidang Tugas Akhir</x-header>
        <div class="p-4 lg:p-6">
            <form id="searchForm" method="GET" action="{{ url()->current() }}"
                class="mb-4 flex md:justify-end space-x-1.5">
                <!-- Search Bar -->
                <x-search name="search" placeholder="Cari sesuatu..." />
            </form>

            <div class="overflow-x-auto bg-white rounded-md shadow border border-gray-200">
                <table class="w-full text-sm text-left divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-medium">
                                <a href="{{ $currentSort === 'date_asc'
                                    ? request()->fullUrlWithQuery(['sort' => 'date_desc'])
                                    : request()->fullUrlWithQuery(['sort' => 'date_asc']) }}"
                                    class="flex items-center gap-x-2">
                                    Tanggal
                                    <i
                                        class="fa-duotone fa-solid fa-sort {{ $currentSort === 'date_desc' ? 'fa-rotate-180' : '' }}"></i>
                                </a>
                            </th>
                            <th class="px-6 py-4 font-medium tracking-wider">
                                Tugas Akhir
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-top w-48">
                                    <div class="font-medium">{{ $schedule['tgl'] }}
                                    </div>
                                    <div class="text-gray-700">Jam {{ $schedule['jam'] }}</div>
                                    <div class="text-gray-700">Ruang {{ $schedule['ruang_smn'] }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="md:text-base font-medium mb-2">{{ $schedule['jdl_proposal'] }}</div>
                                    <div class="text-gray-700 mb-1 text-nowrap">{{ $schedule['nama'] }}
                                        ({{ $schedule['nim'] }})
                                    </div>
                                    <div class="text-gray-700 text-nowrap">Pembimbing 1:
                                        {{ $schedule['pembimbing_1_nama'] }}
                                    </div>
                                    <div class="text-gray-700 text-nowrap">Pembimbing 2:
                                        {{ $schedule['pembimbing_2_nama'] }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination Links --}}
            <div>
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
@endsection
