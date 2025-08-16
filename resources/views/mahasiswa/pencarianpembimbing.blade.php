@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <x-header>Pencarian Pembimbing</x-header>
        <div class="min-h-[60vh] lg:min-h-[75vh] p-4 md:p-6 mt-4 lg:mt-8">
            <div class="max-w-xl mx-auto">
                <!-- Search Form -->
                <form action="{{ route('pencarianpembimbing') }}" method="GET" class="relative">
                    <div
                        class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-blue-500  focus-within:border-blue-500 transition-all duration-200 bg-white">
                        <!-- Search Icon -->
                        <span class="pl-3.5 md:pl-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>

                        <!-- Input Field -->
                        <input type="text" name="lecturer" id="lecturer-input" value="{{ request('lecturer') }}"
                            placeholder="Cari nama dosen"
                            class="w-full px-4 py-2.5 md:py-3 text-gray-700 focus:outline-none" autocomplete="off"
                            oninput="showSuggestions(this.value); toggleClearButton(this.value)">

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
                    <ul id="autocomplete-list"
                        class="absolute z-10 max-h-60 md:max-h-80 overflow-y-auto w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg">
                        <!-- List items will be inserted here via JavaScript -->
                    </ul>
                </form>
            </div>

            <!-- Students List -->
            @if ($paginatedDataBimbingan->isNotEmpty())
                <div class="space-y-6 px-1 mt-8">
                    @foreach ($paginatedDataBimbingan as $tugasAkhir)
                        <div class="ring ring-gray-200 rounded-lg overflow-hidden">
                            <div class="px-5 lg:px-6 py-3 lg:py-5 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-blue-700">
                                    {{ $tugasAkhir['jdl_proposal'] }}
                                </h2>
                            </div>

                            <div class="p-5 lg:p-6">
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="md:text-lg font-medium text-gray-700 mb-3">
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
                                                <span>{{ $tugasAkhir['nama'] }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                    </path>
                                                </svg>
                                                <span>{{ $tugasAkhir['nim'] }}</span>
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
                                                <span>Pembimbing 1: {{ $tugasAkhir['pemb_1'] }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>Pembimbing 2: {{ $tugasAkhir['pemb_2'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="text-md md:text-lg font-medium text-gray-700 mt-6 mb-3">Detail Sidang</h3>
                                <div class="">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-6">
                                        <!-- Tanggal Sidang -->
                                        <div
                                            class="flex items-start border border-gray-200 shadow-sm p-4 bg-white rounded-lg">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                                    Tanggal Sidang</dt>
                                                <dd
                                                    class="mt-1 font-semibold {{ $tugasAkhir['tgl'] ? 'text-gray-800' : 'text-red-600' }}">
                                                    {{ $tugasAkhir['tgl'] ?: 'Belum Ditentukan' }}
                                                </dd>
                                            </div>
                                        </div>

                                        <!-- Ruang -->
                                        <div
                                            class="flex items-start border border-gray-200 shadow-sm p-4 bg-white rounded-lg">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Ruang
                                                </dt>
                                                <dd
                                                    class="mt-1 font-semibold {{ $tugasAkhir['ruang_smn'] ? 'text-gray-800' : 'text-red-600' }}">
                                                    {{ $tugasAkhir['ruang_smn'] ?: 'Belum Ditentukan' }}
                                                </dd>
                                            </div>
                                        </div>

                                        <!-- Jam -->
                                        <div
                                            class="flex items-start border border-gray-200 shadow-sm p-4 bg-white rounded-lg">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Jam
                                                </dt>
                                                <dd
                                                    class="mt-1 font-semibold {{ $tugasAkhir['jam'] ? 'text-gray-800' : 'text-red-600' }}">
                                                    {{ $tugasAkhir['jam'] ?: 'Belum Ditentukan' }}
                                                </dd>
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
        var dosens = [];
        const lecturerInput = document.getElementById("lecturer-input");
        const autocompleteList = document.getElementById("autocomplete-list");
        const clearButton = document.getElementById("clear-button");
        const searchForm = document.querySelector("form");

        async function loadDosen() {
            const response = await fetch('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/dosens');
            const data = await response.json();
            dosens = data.map(dosen => dosen.nama_gelar); // Ambil hanya nama dosen
        }

        // Panggil loadDosen saat halaman dimuat
        window.onload = loadDosen;

        function showSuggestions(value) {
            autocompleteList.innerHTML = ""; // Clear previous suggestions
            if (value.trim() === "") {
                autocompleteList.classList.add("hidden");
                return;
            }
            const suggestions = dosens.filter(dosenName =>
                dosenName.toLowerCase().includes(value.toLowerCase())
            );

            if (suggestions.length > 0) {
                suggestions.forEach(dosenName => {
                    const li = document.createElement("li");
                    li.textContent = dosenName;
                    li.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer";
                    li.addEventListener('click', () => {
                        inputField.value = dosenName;
                        autocompleteList.classList.add("hidden");
                        loadSchedule(dosenName);
                    });
                    autocompleteList.appendChild(li);
                });
                autocompleteList.classList.remove("hidden");
            } else {
                autocompleteList.classList.add("hidden");
            }
        }

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
            autocompleteList.style.display = "none";

            // Tampilkan datalist saat input diisi
            lecturerInput.addEventListener("input", () => {
                if (lecturerInput.value.trim() !== "") {
                    autocompleteList.style.display = "block";
                    setClearButtonVisibility();
                } else {
                    autocompleteList.style.display = "none";
                    setClearButtonVisibility();
                }
            });

            // Sembunyikan datalist saat klik di luar
            document.addEventListener("click", (event) => {
                if (!lecturerInput.contains(event.target) && !autocompleteList.contains(event.target)) {
                    autocompleteList.style.display = "none";
                }
            });

            // Tambahkan interaksi saat item dipilih
            autocompleteList.addEventListener("click", (event) => {
                if (event.target.tagName === "LI") {
                    lecturerInput.value = event.target.textContent;
                    autocompleteList.style.display = "none";
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
                autocompleteList.classList.add("hidden");
            }
        }
    </script>
@endsection
