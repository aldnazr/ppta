@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <x-header>Jadwal Bimbingan Dosen</x-header>
        <div class="min-h-[60vh] lg:min-h-[75vh] p-4 md:p-6 mt-4 lg:mt-8">
            <div class="max-w-xl mx-auto">
                <!-- Search Input -->
                <div class="relative">
                    <div
                        class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all duration-200 bg-white">
                        <!-- Search Icon -->
                        <span class="pl-3.5 md:pl-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>

                        <!-- Input Field -->
                        <input type="text" id="autocomplete-input" placeholder="Cari nama dosen"
                            class="w-full px-4 py-2.5 md:py-3 text-gray-700 focus:outline-none" autocomplete="off"
                            oninput="showSuggestions(this.value); toggleClearButton(this.value)">

                        <!-- Clear Button -->
                        <button id="clear-button"
                            class="hidden px-4 text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer""
                            @click="clearInput()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Autocomplete List -->
                    <ul id="autocomplete-list"
                        class="absolute z-10 max-h-60 md:max-h-80 overflow-y-auto w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg hidden">
                        <!-- List items will be inserted here via JavaScript -->
                    </ul>
                </div>
            </div>

            <!-- Empty State (shown when no dosen is selected) -->
            <div id="empty-state" class="mt-12 text-center">
                <div class="mx-auto max-w-md p-6">
                    <!-- Empty State Icon -->
                    <div class="mx-auto w-16 h-16 mb-4 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Jadwal</h3>
                    <p class="text-gray-500 mb-6">Silakan cari nama dosen untuk melihat jadwal bimbingan yang tersedia.</p>
                </div>
            </div>

            <!-- Schedule Table (hidden by default) -->
            <div id="schedule-table" class="hidden mt-8">
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-200 text-gray-700 uppercase tracking-wider text-xs">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium">No</th>
                                <th scope="col" class="px-6 py-4 font-medium">Tanggal</th>
                                <th scope="col" class="px-6 py-4 font-medium">Jam Mulai</th>
                                <th scope="col" class="px-6 py-4 font-medium">Jam Selesai</th>
                                <th scope="col" class="px-6 py-4 font-medium">Ruang</th>
                                <th scope="col" class="px-6 py-4 font-medium">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="schedule-body" class="divide-y divide-gray-200 bg-white">
                            <!-- Table rows will be inserted here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var dosens = [];
            const autocompleteList = document.getElementById("autocomplete-list");
            const clearButton = document.getElementById("clear-button");
            const inputField = document.getElementById("autocomplete-input");
            const scheduleBody = document.getElementById("schedule-body");
            const table = document.getElementById("schedule-table");
            const emptyState = document.getElementById('empty-state');

            async function loadDosen() {
                const response = await fetch(
                    'https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/dosens');
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

            function toggleClearButton(value) {
                if (value.trim() !== "") {
                    clearButton.classList.remove("hidden");
                    emptyState.classList.add("hidden");
                } else {
                    emptyState.classList.remove("hidden");
                    table.classList.add("hidden");
                    clearButton.classList.add("hidden");
                }
            }

            function clearInput() {
                inputField.value = "";
                toggleClearButton("");
            }

            function loadSchedule(dosenName) {
                const days = {
                    1: 'Senin',
                    2: 'Selasa',
                    3: 'Rabu',
                    4: 'Kamis',
                    5: 'Jumat'
                };

                // Fetch schedule data from server using Fetch API
                fetch(`{{ route('jadbimbingan.dosen') }}?dosen=${encodeURIComponent(dosenName)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        scheduleBody.innerHTML = ""; // Clear previous schedules

                        if (data.schedules && data.schedules.length > 0) {
                            let nomor = 0;
                            data.schedules.forEach(schedule => {
                                const row = `
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">${++nomor}</td>
                                <td scope="row" class="px-6 py-4 text-sm text-gray-500">
                                    ${days[schedule.hari]}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">${schedule.awal}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">${schedule.akhir}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">${schedule.ruang}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">${schedule.ket}</td>
                            </tr>
                        `;
                                scheduleBody.insertAdjacentHTML("beforeend", row);
                            });
                        } else {
                            const noDataRow = `
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">Tidak ada jadwal tersedia</td>
                        </tr>
                    `;
                            scheduleBody.insertAdjacentHTML("beforeend", noDataRow);
                        }

                        // Show table
                        table.classList.remove("hidden");
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Gagal memuat jadwal. Coba lagi.");
                    });
            }

            // Event Listeners
            inputField.addEventListener('input', (e) => {
                showSuggestions(e.target.value);
                toggleClearButton(e.target.value);
            });

            clearButton.addEventListener('click', clearInput);
        });
    </script>
@endsection
