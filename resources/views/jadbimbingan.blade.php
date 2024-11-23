<x-layout>
    <div class="min-h-96 p-4 md:p-6 bg-white rounded-md shadow-lg">
        <div class="max-w-xl mx-auto">
            <h1 class="text-xl md:text-2xl font-semibold text-center text-blue-800 mb-3 md:mb-4">Jadwal Bimbingan Dosen
            </h1>
            <div class="relative">
                <div
                    class="flex items-center border border-gray-300 rounded-md focus-within:ring-2 focus-within:ring-blue-500">
                    <input type="text" id="autocomplete-input" placeholder="Masukkan nama dosen"
                        class="w-full px-4 py-2 focus:outline-hidden rounded-l-md"
                        oninput="showSuggestions(this.value); toggleClearButton(this.value)" autocomplete="off">
                    <button id="clear-button" class="hidden px-3 text-gray-500 hover:text-gray-700 focus:outline-hidden"
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

        <div id="schedule-table" class="hidden mt-8 relative overflow-x-auto shadow-lg rounded-md">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs bg-gray-200 text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Jam Mulai</th>
                        <th scope="col" class="px-6 py-3">Jam Selesai</th>
                        <th scope="col" class="px-6 py-3">Ruang</th>
                        <th scope="col" class="px-6 py-3">Ket</th>
                    </tr>
                </thead>
                <tbody id="schedule-body">
                </tbody>
            </table>
        </div>
    </div>

</x-layout>

<script>
    const dosen = @json($dosens);
    const list = document.getElementById("autocomplete-list");
    const clearButton = document.getElementById("clear-button");
    const inputField = document.getElementById("autocomplete-input");
    const sortedList = dosen.sort();
    const scheduleBody = document.getElementById("schedule-body");
    const table = document.getElementById("schedule-table");

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
            table.classList.add("hidden");
            clearButton.classList.add("hidden");
        }
    }

    function clearInput() {
        inputField.value = "";
        list.classList.add("hidden");
        toggleClearButton("");
    }

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
                    loadSchedule(city); // Panggil fungsi untuk memuat jadwal
                };
                list.appendChild(li);
            });
            list.classList.remove("hidden");
        } else {
            list.classList.add("hidden");
        }
    }

    function loadSchedule(dosen) {
        // Kirim permintaan ke server untuk mendapatkan jadwal berdasarkan dosen
        $.get(`/jadbimbingan-dosen?dosen=${encodeURIComponent(dosen)}`, function(response) {
            scheduleBody.innerHTML = ""; // Bersihkan jadwal sebelumnya

            if (response.schedules.length > 0) {
                response.schedules.forEach(schedule => {
                    const row = `
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            ${schedule.tanggal}
                        </th>
                        <td class="px-6 py-4">${schedule.jam_mulai}</td>
                        <td class="px-6 py-4">${schedule.jam_selesai}</td>
                        <td class="px-6 py-4">${schedule.ruang}</td>
                        <td class="px-6 py-4">${schedule.ket}</td>
                    </tr>
                `;
                    scheduleBody.insertAdjacentHTML("beforeend", row);
                });
            } else {
                const noDataRow = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada jadwal tersedia</td>
                </tr>
            `;
                scheduleBody.insertAdjacentHTML("beforeend", noDataRow);
            }

            // Tampilkan tabel
            table.classList.remove("hidden");
        }).fail(function() {
            alert("Gagal memuat jadwal. Coba lagi.");
        });
    }
</script>
