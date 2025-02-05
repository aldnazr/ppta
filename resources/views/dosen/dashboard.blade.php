@extends('layouts.app')

@section('content')
    <div class="bg-white border-b border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <!-- Header Section -->
        <x-header>Dashboard Penilaian</x-header>

        <div class="p-4 lg:p-6">
            <!-- Notification Card -->
            <div
                class="bg-amber-50/70 border-l-4 border-amber-400 shadow-sm rounded-xl p-4 mt-1 md:mt-2 mb-5 md:mb-7 flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg lg:text-xl font-semibold text-amber-800">Penilaian Tertunda</h3>
                    <div class="mt-1 text-xl lg:text-2xl font-bold text-amber-900">{{ $unassessedCount }}</div>
                </div>
            </div>

            <!-- Assessment List -->
            <ul class="space-y-4">
                @foreach ($paginated as $item)
                    <li class="relative p-4 md:px-5 md:py-6 ring ring-gray-200 shadow shadow-sm rounded-lg">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <!-- Left Content -->
                            <div class="flex-1 space-y-3">
                                <!-- Badge + Title -->
                                <div class="flex flex-col md:flex-row items-start gap-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $item['tipe'] === 'proposal' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ str_replace('_', ' ', Str::title($item['tipe'])) }}
                                    </span>
                                    <h3 class="lg:text-lg font-semibold text-gray-900">
                                        {{ $item['judul'] }}
                                    </h3>
                                </div>

                                <!-- Student Info -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-gray-400 shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="truncate">{{ $item['nama_mahasiswa'] }}</span>
                                    </div>

                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-gray-400 shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Sidang:
                                            {{ date('d M Y', strtotime($item['tgl_pengajuan_proposal'])) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('dosen.dashboard.penilaian', ['mhs_nim' => $item['id']]) }}"
                                class="w-full md:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                <span>Beri Penilaian</span>
                                <i class="fa-solid fa-arrow-right fa-xs ml-2 mt-0.5"></i>
                            </a>
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
