@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
        <x-header>Jadwal Bimbingan Dosen</x-header>
        <div class="min-h-[60vh] lg:min-h-[75vh] p-4 md:p-6 mt-4 lg:mt-8">
            <div class="max-w-xl mx-auto">
                <!-- Search Form -->
                <form action="{{ route('pencarianpembimbing') }}" method="GET" class="relative">
                    <div
                        class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all duration-200 bg-white">
                        <!-- Search Icon -->
                        <span class="pl-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>

                        <!-- Input Field with Autocomplete -->
                        <input type="text" name="lecturer" id="lecturer-input" value="{{ request('lecturer') }}"
                            placeholder="Cari nama dosen..." class="w-full px-4 py-3 text-gray-700 focus:outline-none"
                            autocomplete="off" oninput="toggleClearButton(this.value)">

                        <!-- Clear Button -->
                        <button type="button" id="clear-button"
                            class="hidden px-4 text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer"
                            @click="clearInput()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Datalist for Autocomplete -->
                    <ul id="dosen-list"
                        class="absolute z-10 max-h-60 md:max-h-80 overflow-y-auto w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg">
                        @foreach ($dosens as $dosen)
                            <li class="px-4 py-2 hover:bg-blue-100 cursor-pointer">{{ $dosen }}</li>
                        @endforeach
                    </ul>
                </form>
            </div>

            <!-- Students List -->
            @if ($paginatedDataBimbingan->isNotEmpty())
                <div class="space-y-6 px-1 mt-8">
                    @foreach ($paginatedDataBimbingan as $tugasAkhir)
                        <div class="border border-gray-200 shadow-md rounded-xl overflow-hidden">
                            <div class="px-5 lg:px-6 py-3 lg:py-5 border-b border-gray-200">
                                <h2 class="text-lg md:text-xl font-semibold text-blue-700">
                                    {{ $tugasAkhir->title }}
                                </h2>
                            </div>

                            <div class="p-5 lg:p-6">
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-md md:text-lg font-medium text-gray-700 mb-3">
                                            Informasi Mahasiswa
                                        </h3>
                                        <div class="space-y-2 text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>
                                                <span>{{ $tugasAkhir->student_name }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                    </path>
                                                </svg>
                                                <span>{{ $tugasAkhir->student_id }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h3 class="text-md md:text-lg font-medium text-gray-700 mb-3">Pembimbing</h3>
                                        <div class="space-y-2 text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>Pembimbing 1: {{ $tugasAkhir->pembimbing1 }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>Pembimbing 2: {{ $tugasAkhir->pembimbing2 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="text-md md:text-lg font-medium text-gray-700 mt-6 mb-3">Detail Sidang</h3>
                                <div class="bg-gray-100 rounded-lg p-3 md:p-5">
                                    <div class="grid md:flex md:justify-evenly gap-y-2">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <div>
                                                <span class="text-gray-600">Tanggal Sidang</span>
                                                <p
                                                    class="text-sm md:text-base font-semibold lg:font-medium {{ $tugasAkhir->sidang_date ? 'text-gray-600' : 'text-red-600' }}">
                                                    {{ $tugasAkhir->sidang_date ?: 'Belum Ditentukan' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <div>
                                                <span class="text-gray-600">Ruang</span>
                                                <p
                                                    class="text-sm md:text-base font-semibold lg:font-medium {{ $tugasAkhir->room ? 'text-gray-600' : 'text-red-600' }}">
                                                    {{ $tugasAkhir->room ?: 'Belum Ditentukan' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>
                                                <span class="text-gray-600">Jam</span>
                                                <p
                                                    class="text-sm md:text-base font-semibold lg:font-medium {{ $tugasAkhir->time ? 'text-gray-600' : 'text-red-600' }}">
                                                    {{ $tugasAkhir->time ?: 'Belum Ditentukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-8 w-full">
                    {{ $paginatedDataBimbingan->links('vendor.pagination.custom-pagination') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="mt-12 text-center">
                    <div class="mx-auto max-w-md p-6">
                        <div class="mx-auto w-16 h-16 mb-4 text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Daftar Nama Mahasiswa</h3>
                        <p class="text-gray-500 mb-6">Silakan cari nama dosen untuk melihat daftar nama mahasiswa
                            bimbingan.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const lecturerInput = document.getElementById("lecturer-input");
        const dosenList = document.getElementById("dosen-list");
        const clearButton = document.getElementById("clear-button");
        const searchForm = document.querySelector("form");

        document.addEventListener("DOMContentLoaded", () => {
            // Function to toggle clear button visibility
            function setClearButtonVisibility() {
                if (lecturerInput.value.trim() !== "") {
                    clearButton.classList.remove("hidden");
                } else {
                    clearButton.classList.add("hidden");
                }
            }

            // Sembunyikan datalist di awal
            dosenList.style.display = "none";

            // Tampilkan datalist saat input diisi
            lecturerInput.addEventListener("input", () => {
                if (lecturerInput.value.trim() !== "") {
                    dosenList.style.display = "block";
                    setClearButtonVisibility();
                } else {
                    dosenList.style.display = "none";
                    setClearButtonVisibility();
                }
            });

            // Sembunyikan datalist saat klik di luar
            document.addEventListener("click", (event) => {
                if (!lecturerInput.contains(event.target) && !dosenList.contains(event.target)) {
                    dosenList.style.display = "none";
                }
            });

            // Tambahkan interaksi saat item dipilih
            dosenList.addEventListener("click", (event) => {
                if (event.target.tagName === "LI") {
                    lecturerInput.value = event.target.textContent;
                    dosenList.style.display = "none";
                    setClearButtonVisibility();
                    searchForm.submit();
                }
            });

            setClearButtonVisibility();
        });

        function clearInput() {
            lecturerInput.value = "";
            toggleClearButton("");
            searchForm.submit();
        }

        function toggleClearButton(value) {
            if (value.trim() !== "") {
                clearButton.classList.remove("hidden");
                emptyState.classList.add("hidden");
            } else {
                clearButton.classList.add("hidden");
                emptyState.classList.remove("hidden");
                studentList.classList.add("hidden");
                list.classList.add("hidden");
            }
        }
    </script>
@endsection
