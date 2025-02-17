@extends('layouts.app')

@section('content')
    <div class="bg-white border-b border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <!-- Header Section -->
        <x-header>Dashboard Penilaian</x-header>

        <div class="p-4 lg:p-6">
            <!-- Notification Card -->
            <div
                class="group bg-red-600/90 border border-red-600/50 shadow-lg transition-all duration-300 rounded-2xl p-4 md:p-6 mb-6 flex items-center space-x-4 backdrop-blur-sm">
                <div
                    class="flex bg-white/40 items-center justify-center backdrop-blur-sm rounded-full h-12 w-12 md:h-14 md:w-14 transition-colors duration-300">
                    <i class="fa-regular fa-circle-exclamation fa-xl text-white/90 md:fa-2xl"></i>
                </div>

                <div class="space-y-1 md:space-y-1">
                    <h3 class="text-sm md:text-base font-medium uppercase tracking-wide text-white/90">
                        Penilaian Tertunda
                    </h3>
                    <div class="text-2xl md:text-3xl font-bold text-white/95 tracking-tight">
                        {{ $count }}
                    </div>
                </div>
            </div>

            <!-- Assessment List -->
            <ul class="space-y-5">
                @foreach ($paginated as $item)
                    <li
                        class="p-5 md:p-6 relative overflow-hidden bg-white rounded-xl border border-gray-200 shadow-md transition-all">
                        <div class="space-y-4">
                            <!-- Header Section -->
                            <div
                                class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row sm:items-center sm:justify-between">
                                <!-- Type Badge -->
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium tracking-wide {{ $item['wkt_ta']
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20'
                                        : 'bg-amber-50 text-amber-700 ring-1 ring-amber-600/20' }}">
                                    {{ $item['wkt_ta'] ? 'Proposal' : 'Tugas Akhir' }}
                                </span>

                                <!-- Date -->
                                <div class="flex items-center text-gray-500 text-sm">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Sidang:
                                        {{ date('d M Y', strtotime($item['wkt_ta'] ?? $item['wkt_proposal'])) }}</span>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="md:text-lg font-semibold text-gray-900 leading-tight">
                                {{ $item['jdl_proposal'] }}
                            </h3>

                            <!-- Student Info -->
                            <div class="flex items-center space-x-2">
                                <div class="relative">
                                    <div class="w-11 h-11 rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-500/80" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item['mhs_nama'] }}</p>
                                    <p class="text-sm text-gray-500">{{ $item['mhs_nim'] }}</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="pt-2">
                                <a href="{{ route('dosen.dashboard.penilaian', ['mhs_nim' => $item['mhs_nim'], 'kode_antri' => $item['kode_antrian']]) }}"
                                    class="inline-flex items-center justify-center w-full sm:w-auto px-5 py-2 text-sm font-medium text-white bg-blue-600/90 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-all duration-300">
                                    <span>Beri Penilaian</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $paginated->links() }}
            </div>
        </div>
    </div>
@endsection
