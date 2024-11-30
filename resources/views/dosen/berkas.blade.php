<x-layout>
    <div class="flex flex-col bg-white">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg px-6">
                {{-- Filter and Search --}}
                <div class="flex flex-col md:flex-row justify-between items-center bg-white my-4 space-y-3 md:space-y-0">
                    <!-- Per Page Selector - Responsive Layout -->
                    <form method="GET" action="{{ url()->current() }}" id="perPageForm"
                        class="w-full md:w-auto flex items-center justify-start gap-2">
                        <label for="per-page" class="whitespace-nowrap">Tampilkan:</label>
                        <select id="per-page" name="per_page"
                            class="w-20 bg-gray-200 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onchange="document.getElementById('perPageForm').submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>

                    <!-- Search and Filter - Responsive Layout -->
                    <form method="GET" action="{{ url()->current() }}"
                        class="w-full md:w-auto flex items-center justify-end space-x-2">
                        <div class="flex-grow md:flex-grow-0 md:w-64">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Pencarian..."
                                class="w-full bg-gray-200 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        <button type="button"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded"
                            data-filter-toggle>
                            <i class="fa-solid fa-filter"></i>
                        </button>

                        <!-- Optional Advanced Filter Dropdown (Hidden by Default) -->
                        <div id="advancedFilterDropdown"
                            class="hidden mt-[19rem] absolute z-10 bg-zinc-50 shadow-md rounded-md p-4 border border-gray-200">
                            <h3 class="mb-2 font-semibold text-gray-900">Berkas</h3>
                            <div class="grid gap-4">
                                <!-- Add your advanced filter fields here -->
                                <ul
                                    class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                                    <li class="w-full border-b border-gray-200 rounded-t-lg">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-license" type="radio" value=""
                                                name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                            <label for="list-radio-license"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Semua</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-id" type="radio" value="" name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                            <label for="list-radio-id"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Proposal</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg">
                                        <div class="flex items-center ps-3">
                                            <input id="list-radio-military" type="radio" value=""
                                                name="list-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                            <label for="list-radio-military"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Tugas
                                                Akhir</label>
                                        </div>
                                    </li>
                                </ul>
                                <!-- Add more filter fields as needed -->
                            </div>
                            <div class="mt-4 flex justify-between space-x-2">
                                <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded"
                                    data-filter-reset>
                                    Reset
                                </button>
                                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded"
                                    data-filter-apply>
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto bg-white rounded-lg">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tgl Pengajuan Proposal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tgl Pengajuan TA
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mahasiswa
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pembiming
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penguji
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siap Transfer
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($proposals as $index => $proposal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposals->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['tgl_pengajuan_proposal'] ? date('d-m-Y', strtotime($proposal['tgl_pengajuan_proposal'])) : '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['tgl_pengajuan_ta'] ? date('d-m-Y', strtotime($proposal['tgl_pengajuan_ta'])) : '' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proposal['nim'] }}
                                        {{ $proposal['nama_mahasiswa'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proposal['judul'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        1. {{ $proposal['pembimbing1'] }}
                                        2. {{ $proposal['pembimbing2'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['penguji'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['siap_transfer'] ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('penilaian', $proposal['id']) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                            Nilai
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="min-w-full mx-auto">
                    <div class="py-3">
                        <div class="flex justify-between items-center">
                            <div class="flex-1 flex items-center justify-between">
                                <p class="text-sm text-gray-700">
                                    Menampilkan
                                    <span class="font-medium">{{ $proposals->firstItem() }}</span>
                                    sampai
                                    <span class="font-medium">{{ $proposals->lastItem() }}</span>
                                    dari
                                    <span class="font-medium">{{ $proposals->total() }}</span>
                                    hasil
                                </p>
                                <div>
                                    {{ $proposals->links('vendor.pagination.custom-pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    // Toggle advanced filter dropdown
    document.querySelector('[data-filter-toggle]').addEventListener('click', function() {
        const dropdown = document.getElementById('advancedFilterDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Reset filter
    document.querySelector('[data-filter-reset]')?.addEventListener('click', function() {
        // Reset filter form logic here
        document.getElementById('advancedFilterDropdown').classList.add('hidden');
    });

    // Apply filter
    document.querySelector('[data-filter-apply]')?.addEventListener('click', function() {
        // Collect and apply filter logic here
        document.getElementById('advancedFilterDropdown').classList.add('hidden');
    });
</script>
