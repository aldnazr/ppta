@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-0.5 overflow-hidden" x-data="{
        open: false,
        titleData: '',
        dataTaMhs: [],
        activeProdiId: '{{ $activeIdProdi }}',
        activeProdiName: '{{ $activeNamaProdi }}',
        angkatan: @js($angkatan),
        totalData: {{ $totalData }},
        currentPage: 1,
        itemsPerPage: 5,
        title() {
            return 'Angkatan: ' + this.titleData;
        },
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
        async fetchDetail(angkatan) {
            try {
                // Panggil endpoint API dengan parameter kode_nim = angkatan (sesuaikan jika perlu)
                const response = await fetch(`https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/mhs/taperangkatan/detail?kode_nim=${encodeURIComponent(angkatan)}&kode_prodi=${encodeURIComponent(this.activeProdiId)}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const result = await response.json();
                // Update data detail mahasiswa
                this.dataTaMhs = result;
            } catch (error) {
                console.error('Error fetching detail data:', error);
            }
        },
        async fetchJurusan(prodiId, prodiName) {
            try {
                // Panggil endpoint API untuk mendapatkan data taperangkatan berdasarkan kode prodi
                const response = await fetch(`{{ route('taperangkatan.jurusan') }}?jurusan=${prodiId}`);
                const result = await response.json();
                // Update data angkatan dengan data baru
                this.angkatan = result.data;
                // Update prodi aktif (ID dan nama)
                this.activeProdiId = prodiId;
                this.activeProdiName = prodiName;
    
                // Hitung total mahasiswa berdasarkan data angkatan yang baru
                let total = 0;
                for (const key in this.angkatan) {
                    if (Array.isArray(this.angkatan[key])) {
                        total += this.angkatan[key].length;
                    } else {
                        total += Number(this.angkatan[key].jumlah_mahasiswa) || 0;
                    }
                }
                this.totalData = total;
                this.currentPage = 1; // Reset ke halaman pertama saat prodi berubah
    
                // Jika ada data detail mahasiswa per angkatan, Anda bisa menetapkannya ke dataTaMhs
                // misalnya: this.dataTaMhs = Array.isArray(this.angkatan[someKey]) ? this.angkatan[someKey] : [];
            } catch (error) {
                console.error('Error fetching jurusan data:', error);
            }
        },
        getPageRangeArray() {
            const total = this.totalPages;
            const current = this.currentPage;
            if (total <= 5) {
                return Array.from({ length: total }, (_, i) => i + 1);
            }
    
            let start = Math.max(current - 2, 1);
            let end = Math.min(current + 2, total);
    
            if (current <= 3) {
                end = 5;
            } else if (current >= total - 2) {
                start = total - 4;
            }
    
            const range = [];
            if (start > 1) {
                range.push(1);
                if (start > 2) {
                    range.push('...');
                }
            }
    
            for (let i = start; i <= end; i++) {
                range.push(i);
            }
    
            if (end < total) {
                if (end < total - 1) {
                    range.push('...');
                }
                range.push(total);
            }
    
            return range;
        },
    }">
        <!-- Header dan Filter Prodi -->
        <div class="grid border-b border-gray-200">
            <x-header>Judul TA Perangkatan</x-header>
            <!-- Wrapper Scroll Horizontal -->
            <div class="overflow-x-auto p-4 md:p-6 scrollbar-none">
                <!-- Filter Chips -->
                <div class="grid md:grid-rows-2 grid-flow-col gap-2">
                    @foreach ($prodi as $id => $nama_prodi)
                        <button @click="fetchJurusan('{{ $id }}', '{{ $nama_prodi }}')"
                            :class="{
                                'bg-blue-100 text-blue-800': activeProdiId === '{{ $id }}',
                                'bg-gray-200 text-gray-700': activeProdiId !== '{{ $id }}'
                            }"
                            class="cursor-pointer text-sm lg:text-base filter-btn px-4 py-2 rounded-full font-medium transition-colors hover:text-blue-800 hover:bg-blue-100 whitespace-nowrap">
                            {{ $nama_prodi }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Content Card -->
        <div id="content-container" class="transition-all duration-300 p-6">
            <div class="flex items-center justify-between mb-6">
                <!-- Tampilkan nama prodi aktif -->
                <h2 class="text-xl lg:text-2xl font-semibold text-gray-800" x-text="activeProdiName"></h2>
                <div class="bg-blue-100 text-blue-800 px-3 lg:px-4 py-2 rounded-lg text-sm font-medium"
                    x-text="`Total Mahasiswa: ${totalData}`">
                </div>
            </div>

            <!-- Grid Angkatan -->
            <div id="angkatan-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <template x-if="Object.keys(angkatan).length > 0">
                    <template x-for="(item, index) in angkatan" :key="index">
                        <div class="group">
                            <div @click="
                                titleData = item.angkatan;
                                fetchDetail(item.angkatan.substring(2, 4));
                                {{-- dataTaMhs = {{ $detail }}; --}}
                                open = true;"
                                class="cursor-pointer block p-4 border border-gray-300 rounded-lg group-hover:border-blue-300 group-hover:shadow-md transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-500 text-sm">Angkatan</span>
                                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600"
                                            x-text="item.angkatan"></h3>
                                    </div>
                                    <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium group-hover:bg-blue-100"
                                        x-text="item.jumlah_mahasiswa">
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

            <!-- Popup Window dengan detail mahasiswa (jika dataTaMhs tersedia) -->
            <x-popup-window>
                <template x-if="dataTaMhs.length > 0">
                    <div class="container mx-auto mb-4">
                        <template x-for="mahasiswa in paginatedMahasiswa" :key="mahasiswa.nim">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6 p-6">
                                <div class="space-y-4">
                                    <!-- Judul -->
                                    <div class="border-l-4 border-indigo-500 pl-4">
                                        <h4 class="font-bold md:text-lg text-gray-800"
                                            x-text="mahasiswa.jdl_proposal ?? 'Tidak Ada Judul Proposal Tugas Akhir'">
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
                                                    <span class="text-gray-800 ml-1"
                                                        x-text="mahasiswa.pembimbing_1_nama"></span>
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
                                                    <span class="text-gray-800 ml-1"
                                                        x-text="mahasiswa.pembimbing_2_nama"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Pagination Controls -->
                        <!-- Pagination Controls -->
                        <div
                            class="min-w-full mt-5 mx-auto flex flex-col gap-y-2 lg:flex-row lg:gap-y-0 lg:justify-between items-center">
                            <!-- Showing results text -->
                            <div>
                                <p class="text-gray-600">
                                    Menampilkan
                                    <span x-text="(currentPage - 1) * itemsPerPage + 1"></span>
                                    sampai
                                    <span x-text="Math.min(currentPage * itemsPerPage, dataTaMhs.length)"></span>
                                    dari
                                    <span x-text="dataTaMhs.length"></span> hasil
                                </p>
                            </div>

                            <!-- Pagination navigation -->
                            <div>
                                <nav
                                    class="bg-white relative inline-flex rounded-xl border border-gray-200 shadow-sm space-x-1 p-1.5">
                                    <!-- Previous Page -->
                                    <button @click="prevPage" :disabled="currentPage === 1"
                                        :class="{
                                            'cursor-not-allowed opacity-50': currentPage === 1,
                                            'cursor-pointer hover:bg-indigo-100 hover:text-blue-600': currentPage !== 1
                                        }"
                                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500 bg-zinc-100 rounded-lg transition-colors duration-200 ease-in-out">
                                        <i class="fa-solid fa-chevron-left fa-sm"></i>
                                    </button>

                                    <!-- Numbered pages -->
                                    <template x-for="page in getPageRangeArray()" :key="page">
                                        <template x-if="typeof page === 'number'">
                                            <button @click="goToPage(page)"
                                                :class="{
                                                    'bg-indigo-500 text-white': currentPage === page,
                                                    'bg-zinc-100 hover:bg-indigo-100 hover:text-blue-600': currentPage !==
                                                        page
                                                }"
                                                class="cursor-pointer min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500  rounded-lg transition-colors duration-200 ease-in-out">
                                                <span x-text="page"></span>
                                            </button>
                                        </template>
                                        <template x-if="typeof page === 'string'">
                                            <span
                                                class="min-w-9 min-h-9 flex justify-center items-center px-3 py-1">...</span>
                                        </template>
                                    </template>

                                    <!-- Next Page -->
                                    <button @click="nextPage" :disabled="currentPage === totalPages"
                                        :class="{
                                            'cursor-not-allowed opacity-50': currentPage === totalPages,
                                            'cursor-pointer hover:bg-indigo-100 hover:text-blue-600': currentPage !==
                                                totalPages
                                        }"
                                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500 bg-zinc-100 rounded-lg transition-colors duration-200 ease-in-out">
                                        <i class="fa-solid fa-chevron-right fa-sm"></i>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </template>

                <template x-if="dataTaMhs.length === 0">
                    <div class="text-center text-gray-500">Tidak ada data mahasiswa.</div>
                </template>
            </x-popup-window>
        </div>
    </div>
@endsection
