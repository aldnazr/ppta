@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mx-auto overflow-hidden">
        <x-header>Dashboard</x-header>
        <div class="p-4 lg:p-6">
            <!-- Unassessed Data Section -->
            <div class="bg-white rounded-lg p-2 lg:p-2">
                <div class="bg-yellow-100 rounded-lg p-4 mb-4 border border-yellow-200">
                    <p class="items-center text-center flex text-yellow-800 font-medium">Penilaian Tertunda: <span
                            class="text-2xl">{{ $unassessedCount }}</span>
                    </p>
                </div>
                <ul class="space-y-4">
                    @foreach ($paginated as $item)
                        <li
                            class="border border-gray-200 flex flex-col md:flex-row items-center justify-between py-5 px-4 lg:p-5 rounded-xl">
                            <div class="flex-1 min-w-0">
                                <!-- Badge -->
                                <span
                                    class="inline-flex items-center px-2.5 py-1.5 md:px-3 rounded-md text-xs font-medium ring-1 ring-inset {{ $item['tipe'] === 'proposal' ? 'bg-green-50 text-green-700 ring-green-600/20' : 'bg-yellow-50 text-yellow-800 ring-yellow-600/20' }}">
                                    {{ str_replace('_', ' ', Str::title($item['tipe'])) }}
                                </span>

                                <!-- Title -->
                                <h3 class="mt-2 text-base font-semibold text-gray-900">
                                    {{ $item['judul'] }}
                                </h3>

                                <!-- Student Info -->
                                <div class="mt-2 space-y-1">
                                    <div class="flex items-center text-sm text-gray-700">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $item['nama_mahasiswa'] }}
                                    </div>

                                    <!-- Date -->
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Sidang: {{ date('d M, Y', strtotime($item['tgl_pengajuan_proposal'])) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('dosen.dashboard.penilaian', ['id' => $item['id']]) }}"
                                class="inline-flex items-center justify-center mt-3 md:mt-0 w-full md:w-auto px-3 py-1.5 md:px-4 md:py-2 text-sm font-semibold text-white bg-blue-700/90 rounded-md md:rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow">
                                Nilai
                                <i class="fa-regular fa-arrow-right ml-3 hidden"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- Pagination Links --}}
            <div>
                {{ $paginated->links() }}
            </div>
        </div>
    </div>
@endsection
