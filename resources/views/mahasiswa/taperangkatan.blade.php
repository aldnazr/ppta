@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg mb-0.5 overflow-hidden" x-data="{
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
                const response = await fetch(`/taperangkatan/jurusan?jurusan=${jurusan}`);
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
            <div class="flex flex-wrap gap-2 p-6">
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
                                class="cursor-pointer block p-4 border border-gray-200 rounded-lg group-hover:border-blue-300 group-hover:shadow-md transition-all duration-200">
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
                    <div class="mb-4">
                        <template x-for="mahasiswa in paginatedMahasiswa" :key="mahasiswa.nim">
                            <div class="mb-5 pb-4 border-b last:border-b-0">
                                <h4 class="font-semibold text-gray-700" x-text="mahasiswa.judul"></h4>
                                <div class="text-sm text-gray-600 space-y-0.5">
                                    <p><strong>Nama:</strong> <span x-text="mahasiswa.nama"></span></p>
                                    <p><strong>NIM:</strong> <span x-text="mahasiswa.nim"></span></p>
                                    <p><strong>Pembimbing 1:</strong> <span x-text="mahasiswa.pembimbing_1"></span></p>
                                    <p><strong>Pembimbing 2:</strong> <span x-text="mahasiswa.pembimbing_2"></span></p>
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
                    </div>
                </template>

                <template x-if="dataTaMhs.length === 0">
                    <div class="text-center text-gray-500">Tidak ada data mahasiswa.</div>
                </template>
            </x-popup-window>
        </div>
    </div>
@endsection
