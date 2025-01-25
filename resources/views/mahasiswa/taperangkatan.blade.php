@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-0.5 overflow-hidden" x-data="{
        open: false,
        titleData: '',
        activeJurusan: '{{ $activeJurusan }}',
        angkatan: @js($angkatan),
        totalData: {{ $totalData }},
        currentPage: 1,
        itemsPerPage: 5,
        title() { return 'Angkatan: ' + this.titleData; },
        dataTaMhs: [],
        get paginatedMahasiswa() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.dataTaMhs.slice(start, end);
        },
        get totalPages() {
            return Math.ceil(this.dataTaMhs.length / this.itemsPerPage);
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        },
        async fetchJurusan(jurusan) {
            try {
                const response = await fetch(`{{ route('taperangkatan.jurusan') }}?jurusan=${jurusan}`);
                const result = await response.json();
                this.angkatan = result.data;
                this.activeJurusan = jurusan;
                this.totalData = Object.values(this.angkatan).flat().length;
                this.currentPage = 1; // Reset to first page when changing jurusan
            } catch (error) {
                console.error('Error fetching jurusan data:', error);
            }
        }
    }">
        <div class="grid border-b border-gray-200">
            <x-header>Judul TA Perangkatan</x-header>

            <!-- Filter Chips -->
            <div class="flex flex-wrap gap-2 p-4 md:p-6">
                @foreach ($jurusan as $jur)
                    <button @click="fetchJurusan('{{ $jur }}')"
                        :class="{
                            'bg-blue-100 text-blue-800': activeJurusan === '{{ $jur }}',
                            'bg-gray-200 text-gray-700': activeJurusan !== '{{ $jur }}'
                        }"
                        class="cursor-pointer text-sm lg:text-base filter-btn px-4 py-2 rounded-full font-medium transition-colors hover:text-blue-800 hover:bg-blue-100">
                        {{ $jur }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Content Card -->
        <div id="content-container" class="transition-all duration-300 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl lg:text-2xl font-semibold text-gray-800" x-text="activeJurusan"></h2>
                <div class="bg-blue-100 text-blue-800 px-3 lg:px-4 py-2 rounded-lg text-sm font-medium"
                    x-text="`Total Mahasiswa: ${totalData}`">
                </div>
            </div>

            <!-- List Angkatan -->
            <div id="angkatan-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <template x-if="Object.keys(angkatan).length > 0">
                    <template x-for="(mahasiswaTa, tahun) in angkatan" :key="tahun">
                        <div class="group">
                            <div @click="
                                    titleData = tahun;
                                    dataTaMhs = mahasiswaTa;
                                    open = true;"
                                class="cursor-pointer block p-4 border border-gray-300 rounded-lg group-hover:border-blue-300 group-hover:shadow-md transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-500 text-sm">Angkatan</span>
                                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600"
                                            x-text="tahun"></h3>
                                    </div>
                                    <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium group-hover:bg-blue-100"
                                        x-text="mahasiswaTa.length">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </template>
                <template x-if="Object.keys(angkatan).length === 0">
                    <div class="col-span-full text-center text-gray-500">Tidak ada data untuk jurusan ini.</div>
                </template>
            </div>

            <x-popup-window>
                <template x-if="dataTaMhs.length > 0">
                    <div class="container mx-auto mb-4">
                        <template x-for="mahasiswa in paginatedMahasiswa" :key="mahasiswa.nim">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6 p-6">
                                <div class="space-y-4">
                                    <!-- Judul -->
                                    <div class="border-l-4 border-indigo-500 pl-4">
                                        <h4 class="font-bold md:text-lg text-gray-800 line-clamp-2 hover:line-clamp-none transition-all duration-200"
                                            x-text="mahasiswa.judul">
                                        </h4>
                                    </div>

                                    <!-- Informasi Mahasiswa -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                        <div class="space-y-3">
                                            <!-- Nama -->
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <div>
                                                    <span class="text-gray-600 font-medium">Nama:</span>
                                                    <span class="text-gray-800 ml-1" x-text="mahasiswa.nama"></span>
                                                </div>
                                            </div>

                                            <!-- NIM -->
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1" />
                                                </svg>
                                                <div>
                                                    <span class="text-gray-600 font-medium">NIM:</span>
                                                    <span class="text-gray-800 ml-1" x-text="mahasiswa.nim"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pembimbing -->
                                        <div class="space-y-3">
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <div>
                                                    <span class="text-gray-600 font-medium">Pembimbing 1:</span>
                                                    <span class="text-gray-800 ml-1" x-text="mahasiswa.pembimbing_1"></span>
                                                </div>
                                            </div>

                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <div>
                                                    <span class="text-gray-600 font-medium">Pembimbing 2:</span>
                                                    <span class="text-gray-800 ml-1" x-text="mahasiswa.pembimbing_2"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Pagination Controls -->
                        <div class="flex justify-center items-center mt-4">
                            <button @click="prevPage" :disabled="currentPage === 1"
                                class="mr-1 px-4 py-2 bg-gray-200 rounded-lg disabled:opacity-50 cursor-pointer disabled:cursor-not-allowed hover:bg-gray-300">
                                Previous
                            </button>

                            <template x-for="page in totalPages" :key="page">
                                <button @click="goToPage(page)"
                                    :class="{
                                        'bg-blue-500 text-white': currentPage === page,
                                        'bg-gray-200 hover:bg-gray-300': currentPage !== page
                                    }"
                                    class="px-4 py-2 rounded-lg mx-1 cursor-pointer">
                                    <span x-text="page"></span>
                                </button>
                            </template>

                            <button @click="nextPage" :disabled="currentPage === totalPages"
                                class="ml-1 px-4 py-2 bg-gray-200 rounded-lg disabled:opacity-50 cursor-pointer disabled:cursor-not-allowed hover:bg-gray-300">
                                Next
                            </button>
                        </div>
                </template>

                <template x-if="dataTaMhs.length === 0">
                    <div class="text-center text-gray-500">Tidak ada data mahasiswa.</div>
                </template>
            </x-popup-window>
        </div>
    </div>
@endsection
