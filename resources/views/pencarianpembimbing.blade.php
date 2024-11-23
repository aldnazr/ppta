<x-layout>
    <div class="mx-auto p-6 bg-white rounded-lg shadow-lg">
        <div class="mb-8">
            <!-- Search Form -->
            <div class="max-w-lg mx-auto">
                <h1 class="text-2xl font-bold text-center text-blue-800 mb-4">Pencarian Pembimbing</h1>
                <div class="relative">
                    <div
                        class="flex items-center border border-gray-300 rounded-md focus-within:ring-2 focus-within:ring-blue-500">
                        <input type="text" id="autocomplete-input" placeholder="Masukkan nama dosen"
                            class="w-full px-4 py-2 focus:outline-hidden rounded-l-md"
                            oninput="showSuggestions(this.value); toggleClearButton(this.value)" autocomplete="off">
                        <button id="clear-button"
                            class="hidden px-3 text-gray-500 hover:text-gray-700 focus:outline-hidden"
                            onclick="clearInput()">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </div>
                    <ul id="autocomplete-list"
                        class="absolute z-10 overflow-y-auto h-auto max-h-60 md:max-h-80 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <!-- Suggestions will appear here -->
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
