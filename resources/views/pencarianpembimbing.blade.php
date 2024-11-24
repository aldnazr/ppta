<x-layout>
    <div class="p-4 md:p-6 bg-white rounded-lg shadow-lg">
        <div class="mb-8">
            <!-- Search Form -->
            <div class="max-w-xl mx-auto">
                <h1 class="text-xl md:text-2xl font-semibold text-center text-gray-800 mb-6">
                    Jadwal Bimbingan Dosen
                </h1>

                <!-- Search Input -->
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
                        <input type="text" id="autocomplete-input" placeholder="Cari nama dosen..."
                            class="w-full px-4 py-3 text-gray-700 focus:outline-none" autocomplete="off"
                            oninput="showSuggestions(this.value); toggleClearButton(this.value)">

                        <!-- Clear Button -->
                        <button id="clear-button"
                            class="hidden px-4 text-gray-400 hover:text-gray-600 focus:outline-none"
                            onclick="clearInput()">
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
        </div>

        <!-- taMhs List -->
        <div class="space-y-6 px-1">
            <!-- Results count -->
            <div class="text-gray-600 mb-4">
                Menampilkan {{ $paginatedDataBimbingan->firstItem() }}-{{ $paginatedDataBimbingan->lastItem() }} dari
                {{ $paginatedDataBimbingan->total() }} hasil
            </div>
            @foreach ($paginatedDataBimbingan as $taMhs)
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-blue-600 font-bold mb-2">
                        {{ $taMhs->title }}
                    </h2>

                    <div class="space-y-1 text-gray-700">
                        <p>{{ $taMhs->student_name }} ({{ $taMhs->student_id }})</p>
                        <p>Pembimbing 1 : {{ $taMhs->supervisor1 }}</p>
                        <p>Pembimbing 2 : {{ $taMhs->supervisor2 }}</p>

                        <div class="flex gap-4 mt-2">
                            <p>
                                <span>Tanggal Sidang : </span>
                                <span class="text-red-600">{{ $taMhs->sidang_date ?: 'Belum Ditentukan' }}</span>
                            </p>
                            <p>
                                <span>Ruang : </span>
                                <span class="font-bold">{{ $taMhs->room ?: 'Belum Ditentukan' }}</span>
                            </p>
                            <p>
                                <span>Jam : </span>
                                <span>{{ $taMhs->time ?: 'Belum Ditentukan' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="flex mt-8 w-full justify-center">
            {{ $paginatedDataBimbingan->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>

</x-layout>


<script>
    const cities = ["Julianto Lemantara, S.Kom., M.Eng.", "Yoppy Mirza Maulana, S.Kom., M.MT.",
        "Vivine Nurcahyawati, M.Kom.", "Teguh Sutanto, M.Kom.", "Sri Hariani Eko Wulandari, S.Kom., M.MT.",
        "Valentinus Roby Hananto, S.Kom., M.Sc.", "Agus Dwi Churniawan, S.Si., M.Kom.",
        "Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA", "Slamet, M.T, CCNA", "Dr. M.J. Dewiyani Sunarto"
    ];
    const list = document.getElementById("autocomplete-list");
    const clearButton = document.getElementById("clear-button");
    const inputField = document.getElementById("autocomplete-input");
    const sortedList = cities.sort();

    function showSuggestions(value) {
        list.innerHTML = ""; // Clear previous suggestions
        if (value.trim() === "") {
            list.classList.add("hidden");
            return;
        }
        const suggestions = sortedList.filter(city => city.toLowerCase().includes(value.toLowerCase()));
        if (suggestions.length > 0) {
            suggestions.forEach(city => {
                const li = document.createElement("li");
                li.textContent = city;
                li.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer";
                li.onclick = () => {
                    document.getElementById("autocomplete-input").value = city;
                    list.classList.add("hidden");
                };
                list.appendChild(li);
            });
            list.classList.remove("hidden");
        } else {
            list.classList.add("hidden");
        }
    }

    function toggleClearButton(value) {
        if (value.trim() !== "") {
            clearButton.classList.remove("hidden");
        } else {
            clearButton.classList.add("hidden");
        }
    }

    function clearInput() {
        inputField.value = "";
        list.classList.add("hidden");
        toggleClearButton("");
    }
</script>
