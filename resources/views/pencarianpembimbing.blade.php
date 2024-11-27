<x-layout>
    <div class="min-h-[75vh] p-4 md:p-6 bg-white rounded-lg shadow-lg">
        <!-- Search Form -->
        <div class="max-w-xl mx-auto">
            <h1 class="text-xl md:text-2xl font-semibold text-center text-gray-800 mb-6">
                Pencarian Pembimbing
            </h1>

            <!-- Search Form with Autocomplete -->
            <div class="relative">
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

                    <!-- Input Field -->
                    <input type="text" name="lecturer" id="autocomplete-input" value="{{ $lecturer ?? '' }}"
                        placeholder="Cari nama dosen..." class="w-full px-4 py-3 text-gray-700 focus:outline-none"
                        autocomplete="off" oninput="showSuggestions(this.value); toggleClearButton(this.value)"
                        onkeydown="handleKeyDown(event)">

                    <!-- Clear Button -->
                    <button type="button" id="clear-button"
                        class="hidden px-4 text-gray-400 hover:text-gray-600 focus:outline-none" onclick="clearInput()">
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
                    <!-- Suggestions will be inserted here -->
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
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Daftar Nama Mahasiswa</h3>
                <p class="text-gray-500 mb-6">Silakan cari nama dosen untuk melihat daftar nama mahasiswa bimbingan.</p>
            </div>
        </div>

        <!-- Students List -->
        <div id="studentList" class="hidden space-y-6 px-1 mt-8">

        </div>

        <!-- Pagination Links -->
        <div class="flex mt-8 w-full justify-center">
            {{ $paginatedDataBimbingan->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>
</x-layout>

<script>
    const dosens = @json($dosens);
    const list = document.getElementById("autocomplete-list");
    const inputField = document.getElementById("autocomplete-input");
    const clearButton = document.getElementById("clear-button");
    const emptyState = document.getElementById("empty-state");
    const studentList = document.getElementById("studentList");

    function loadSchedule(dosen) {
        // Disable input during loading
        inputField.disabled = true;

        // Show loading state
        studentList.innerHTML = `
        <div class="text-center text-gray-600 py-8">
            <svg class="animate-spin h-8 w-8 mx-auto text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-4">Memuat jadwal...</p>
        </div>
        `;
        studentList.classList.remove('hidden');

        // Perform AJAX request
        fetch(`{{ route('pencarianpembimbing') }}?lecturer=${encodeURIComponent(dosen)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal memuat jadwal');
                }
                return response.json();
            })
            .then(data => {
                // Clear previous content
                studentList.innerHTML = '';

                // Check if data exists
                if (data.dataBimbingan && data.dataBimbingan.length > 0) {
                    data.dataBimbingan.forEach(taMhs => {
                        const studentListItem = `
                            <div class="bg-white border border-gray-200 shadow-md rounded-xl overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg md:text-xl font-semibold text-blue-700">${taMhs.title}</h2>
                            </div>

                            <div class="p-6">
                                <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-md md:text-lg font-medium text-gray-700 mb-3">
                                    Informasi Mahasiswa
                                    </h3>
                                    <div class="space-y-2 text-gray-600">
                                    <div class="flex items-center">
                                        <svg
                                        class="w-5 h-5 mr-2 text-blue-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        ></path>
                                        </svg>
                                        <span>${taMhs.student_name}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg
                                        class="w-5 h-5 mr-2 text-blue-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                                        ></path>
                                        </svg>
                                        <span>${taMhs.student_id}</span>
                                    </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-md md:text-lg font-medium text-gray-700 mb-3">Pembimbing</h3>
                                    <div class="space-y-2 text-gray-600">
                                    <div class="flex items-center">
                                        <svg
                                        class="w-5 h-5 mr-2 text-green-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        ></path>
                                        </svg>
                                        <span>Pembimbing 1: ${taMhs.pembimbing1}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg
                                        class="w-5 h-5 mr-2 text-green-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        ></path>
                                        </svg>
                                        <span>Pembimbing 2: ${taMhs.pembimbing2}</span>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <h3 class="text-md md:text-lg font-medium text-gray-700 mt-6 mb-3">Detail Sidang</h3>
                                <div class="bg-gray-100 rounded-lg p-3 md:p-5">
                                    <div class="grid md:flex md:justify-evenly gap-y-2">
                                        <div class="flex items-center space-x-2">
                                        <svg
                                            class="w-5 h-5 text-red-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            ></path>
                                        </svg>
                                        <div>
                                            <span class="text-gray-600">Tanggal Sidang</span>
                                            <p
                                            class="text-sm md:text-lg font-semibold lg:font-medium ${taMhs.sidang_date ? 'text-gray-600' : 'text-red-600'}"
                                            >
                                            ${taMhs.sidang_date || 'Belum Ditentukan'}
                                            </p>
                                        </div>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                        <svg
                                            class="w-5 h-5 text-blue-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                            ></path>
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                            ></path>
                                        </svg>
                                        <div>
                                            <span class="text-gray-600">Ruang</span>
                                            <p
                                            class="text-sm md:text-lg font-semibold lg:font-medium ${ taMhs.room ? 'text-gray-600' : 'text-red-600'}"
                                            >
                                            ${taMhs.room || 'Belum Ditentukan'}
                                            </p>
                                        </div>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                        <svg
                                            class="w-5 h-5 text-green-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                        <div>
                                            <span class="text-gray-600">Jam</span>
                                            <p
                                            class="text-sm md:text-lg font-semibold lg:font-medium ${ taMhs.time ? 'text-gray-600' : 'text-red-600'}"
                                            >
                                            ${taMhs.time || 'Belum Ditentukan'}
                                            </p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    `;

                        studentList.innerHTML += studentListItem;
                    });

                    // Ensure the student list is visible
                    studentList.classList.remove('hidden');
                } else {
                    // Handle no data scenario
                    studentList.innerHTML = `
                    <div class="text-center text-gray-600 py-4">
                        Tidak ada data mahasiswa ditemukan.
                    </div>
                    `;
                    studentList.classList.remove('hidden');
                }
            })
            .catch(error => {
                studentList.innerHTML = `
                <div class="text-center text-red-600 py-4">
                    Terjadi kesalahan: ${error.message}
                </div>
                `;
                studentList.classList.remove('hidden');
            })
            .finally(() => {
                // Re-enable input
                inputField.disabled = false;
            });
    }

    // Modify the existing showSuggestions function to use event delegation
    function showSuggestions(value) {
        list.innerHTML = ""; // Clear previous suggestions
        if (value.trim() === "") {
            list.classList.add("hidden");
            return;
        }

        const suggestions = dosens.filter(dosen =>
            dosen.toLowerCase().includes(value.toLowerCase())
        ).sort();

        if (suggestions.length > 0) {
            // Use document fragment for better performance
            const fragment = document.createDocumentFragment();
            suggestions.forEach(dosen => {
                const li = document.createElement("li");
                li.textContent = dosen;
                li.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer";
                li.setAttribute('data-dosen', dosen);
                fragment.appendChild(li);
            });
            list.appendChild(fragment);
            list.classList.remove("hidden");
        } else {
            list.classList.add("hidden");
        }
    }

    // Use event delegation for list clicks
    list.addEventListener('click', function(event) {
        const li = event.target.closest('li');
        if (li) {
            const dosen = li.getAttribute('data-dosen');
            if (dosen) {
                inputField.value = dosen;
                list.classList.add("hidden");
                loadSchedule(dosen);
            }
        }
    });

    // Existing event handlers remain the same
    function handleKeyDown(event) {
        // If Enter key is pressed and list is visible, select the first suggestion
        if (event.key === 'Enter' && !list.classList.contains('hidden')) {
            const firstSuggestion = list.querySelector('li');
            if (firstSuggestion) {
                const dosen = firstSuggestion.getAttribute('data-dosen');
                inputField.value = dosen;
                list.classList.add("hidden");
                loadSchedule(dosen);
                event.preventDefault();
            }
        }
    }

    function clearInput() {
        inputField.value = "";
        toggleClearButton("");
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
