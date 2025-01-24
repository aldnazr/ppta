@extends('layouts.app')

@section('content')
    <div class="rounded-xl shadow-lg border border-gray-200 mx-auto overflow-hidden">
        <x-header>Dashboard</x-header>
        <div class="p-4 lg:p-6">
            <!-- Unassessed Data Section -->
            <div class="bg-white rounded-lg p-4 lg:p-5 border border-gray-300">
                <p class="text-xl font-semibold mb-4">Data Yang Belum Dinilai</p>
                <div class="bg-yellow-100 rounded-lg p-4 mb-4">
                    <p class="items-center text-center flex text-yellow-800 font-medium">Penilaian Tertunda: <span
                            class="text-2xl">{{ $unassessedCount }}</span>
                    </p>
                </div>
                <ul class="divide-y divide-gray-200 space-y-4">
                    @foreach ($paginated as $item)
                        <li
                            class="flex flex-col md:flex-row items-center justify-between p-4 rounded-lg shadow-md border border-gray-100">
                            <div class="flex-1 min-w-0">
                                <!-- Badge -->
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $item['tipe'] === 'proposal' ? 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-600/20' : 'bg-lime-100 text-lime-700 ring-1 ring-lime-600/20' }}">
                                    {{ str_replace('_', ' ', Str::title($item['tipe'])) }}
                                </span>

                                <!-- Title -->
                                <h3 class="mt-2 text-base lg:text-lg font-semibold text-gray-900">
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
                                class="inline-flex items-center justify-center mt-3 md:mt-0 w-full md:w-auto px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Nilai
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
