@extends('layouts.app')

@section('content')
    <div class="pb-2 overflow-hidden bg-white rounded-xl shadow-sm" x-data="{
        open: false,
        title() { return 'Usulan Judul' },
        titleData: '',
        pengusul: '',
        description: ''
    }">
        <x-header>Usulan Judul Tugas Akhir</x-header>
        <div class="p-4 lg:p-6">
            <ul class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($paginatedJudulTugasAkhir as $ta)
                    <li
                        class="bg-white flex flex-col justify-between rounded-xl shadow-md overflow-hidden hover:ring hover:ring-blue-200 transition-all duration-300">
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg lg:text-xl font-bold text-gray-800 line-clamp-2">{{ $ta['usul_judul'] }}
                                </h2>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $ta['nama_gelar'] }}</span>
                                </p>
                                <p class="text-sm text-gray-500 flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                    <span class="{{ $ta['usul_ket'] ? '' : 'italic' }} line-clamp-2">
                                        {{ $ta['usul_ket'] ?: 'Tidak ada deskripsi' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-100/70 flex justify-end">
                            <button
                                @click="
                                        titleData = {{ json_encode($ta['usul_judul']) }};
                                        pengusul = {{ json_encode($ta['nama_gelar']) }};
                                        description = {{ json_encode($ta['usul_ket'] ?: 'Tidak ada deskripsi') }};
                                        open = true;
                                        "
                                class="text-blue-600 hover:text-blue-700 cursor-pointer text-sm font-medium">
                                Lihat Detail
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- Pagination Links --}}
            <div>
                {{ $paginatedJudulTugasAkhir->links() }}
            </div>

            <!-- Popup Window -->
            <x-popup-window :maxWidthLG="'lg:max-w-3xl'">
                <div class="flex flex-col space-y-4 text-sm md:text-base">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-4 font-semibold text-gray-600">
                            <span class="block mb-1">Judul</span>
                        </div>
                        <div class="col-span-8 font-semibold text-gray-800" x-text="titleData">
                            <!-- Nama Pengusul -->
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-4 font-medium text-gray-600">
                            <span class="block mb-1">Pengusul</span>
                        </div>
                        <div class="col-span-8 text-gray-800" x-text="pengusul">
                            <!-- Nama Pengusul -->
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-4 font-medium text-gray-600">
                            <span class="block mb-1">Deskripsi</span>
                        </div>
                        <div class="col-span-8 text-gray-800 leading-relaxed" x-text="description">
                            <!-- Deskripsi Proposal -->
                        </div>
                    </div>
                </div>
            </x-popup-window>
        </div>
    </div>
@endsection
