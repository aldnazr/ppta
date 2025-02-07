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
                    <li
                        class="p-5 md:p-6 relative overflow-hidden bg-white rounded-xl border border-gray-200 shadow-md transition-all">
                        <div class="space-y-4">
                            <!-- Header Section -->
                            <div
                                class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row sm:items-center sm:justify-between">
                                <!-- Type Badge -->
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium tracking-wide {{ $item['tipe'] === 'proposal'
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20'
                                        : 'bg-amber-50 text-amber-700 ring-1 ring-amber-600/20' }}">
                                    {{ str_replace('_', ' ', Str::title($item['tipe'])) }}
                                </span>

                                <!-- Date -->
                                <div class="flex items-center text-gray-500 text-sm">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Sidang: {{ date('d M Y', strtotime($item['tgl_pengajuan_proposal'])) }}</span>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="md:text-lg font-semibold text-gray-900 leading-tight">
                                {{ $item['judul'] }}
                            </h3>

                            <!-- Student Info -->
                            <div class="flex items-center space-x-2">
                                <div class="relative">
                                    <div class="w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item['nama_mahasiswa'] }}</p>
                                    <p class="text-sm text-gray-500">{{ $item['nim'] }}</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="pt-2">
                                <a href="{{ route('dosen.dashboard.penilaian', ['mhs_nim' => $item['id']]) }}"
                                    class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-100 transition-all duration-300">
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
