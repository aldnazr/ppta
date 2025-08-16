@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" x-data="{
        open: false,
        titleData: '',
        noDaftar: '',
        nim: '',
        nama: '',
        judul: '',
        ruang: '',
        penguji1: '',
        title() { return this.titleData; }
    }">
        <x-header>Antrian Proposal Tugas Akhir</x-header>
        <div class="pb-6 px-6 pt-2">
            <div class="flex flex-col md:flex-row justify-between my-4 space-y-3 lg:space-y-0 lg:space-x-2">
                <form action="{{ url()->current() }}" id="perPageForm">
                    <div class="flex items-center">
                        <label for="per-page" class="mr-2">Tampilkan:</label>
                        <select id="per-page" name="per_page"
                            class="bg-gray-200 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onchange="document.getElementById('perPageForm').submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </div>
                </form>
                <form id="searchForm" method="GET" action="{{ url()->current() }}" class="w-auto flex items-center">
                    <!-- Search Bar -->
                    <x-search name="search" placeholder="Cari sesuatu..." />
                </form>
            </div>
            <div class="overflow-x-auto bg-white rounded-md ring ring-gray-200">
                <table class="w-full text-sm text-left divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                NO
                            </th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-nowrap">
                                NO DAFTAR</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                tanggal pengajuan
                            </th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Tanggal Sidang Proposal
                            </th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                NIM
                            </th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                NAMA
                            </th>
                            <th
                                class="border-e px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                PEMBIMBING</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                jadwal sidang proposal</th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                revisi</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                proposal ta
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                hasl</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($proposals as $index => $proposal)
                            <td rowspan="2" class="text-center px-4 py-2">{{ $index + 1 }}
                            <td colspan="11" class="border-s px-4 py-4 text-gray-900 font-medium">
                                {{ $proposal['jdl_proposal'] }}
                            </td>
                            <tr>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['kode_antrian'] }}</td>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $proposal['wkt_proposal'] }}
                                </td>
                                <td class="text-center text-zinc-600 border px-4 py-2">
                                    {{ $proposal['sidang_prop'] ?: 'Belum dijadwalkan' }}
                                </td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['mhs_nim'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $proposal['mhs_nama'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2 md:text-nowrap">
                                    <ol class="list-decimal pl-4">
                                        <li>{{ $proposal['pembimbing_1_nama'] }}</li>
                                        <li>{{ $proposal['pembimbing_2_nama'] }}</li>
                                    </ol>
                                </td>
                                <td class="border text-center px-4 py-2">
                                    <button
                                        @click="open = true; 
                                            titleData = 'Jadwal Sidang Proposal TA'; 
                                            noDaftar = '{{ $proposal['kode_antrian'] }}';
                                            nim = '{{ $proposal['mhs_nim'] }}';
                                            nama = '{{ $proposal['mhs_nama'] }}';
                                            judul = '{{ $proposal['jdl_proposal'] }}';
                                            ruang = '{{ $proposal['ruang'] }}';
                                            penguji1 = '{{ $proposal['nik_penguji1'] }}';
                                            "
                                        class="cursor-pointer px-3 py-1.5 ring rounded-md text-sm text-nowrap bg-blue-100 text-blue-800 ring-blue-200">Atur
                                        Jadwal
                                    </button>
                                </td>
                                <td class="text-zinc-600 border px-4 py-2"></td>
                                <td class="text-center text-zinc-600 border px-4 py-2">
                                    <a href="{{ $proposal['prop_link'] }}" class="cursor-pointer text-blue-500 underline">
                                        <i class="fa-solid fa-download fa-lg"></i>
                                    </a>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="relative" x-data="{ isUpdateopen: false }">
                                        <button @click="isUpdateopen = !isUpdateopen"
                                            class="cursor-pointer px-3 py-1 text-gray-800 hover:text-gray-900 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none inline-flex items-center"
                                            type="button">
                                            <span>Update Status</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d=" M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div x-show="isUpdateopen" @click.outside="isUpdateopen = false"
                                            class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-sm z-50 border"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100">
                                            <div class="py-1">
                                                <!-- ACC -->
                                                <div>
                                                    <input type="hidden" name="status" value="ACC">
                                                    <button
                                                        class="cursor-pointer w-full px-4 py-2 text-sm text-left text-gray-800 hover:bg-green-50 hover:text-green-800 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        ACC
                                                    </button>
                                                </div>

                                                <!-- ACC Bersyarat -->
                                                <div>
                                                    <input type="hidden" name="status" value="ACC Bersyarat">
                                                    <button
                                                        class="cursor-pointer w-full px-4 py-2 text-sm text-left text-gray-800 hover:bg-blue-50 hover:text-blue-800 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                        ACC Bersyarat
                                                    </button>
                                                </div>

                                                <!-- ACC Bersyarat Sidang Ulang -->
                                                <div>
                                                    <input type="hidden" name="status"
                                                        value="ACC Bersyarat Sidang Ulang">
                                                    <button
                                                        class="cursor-pointer w-full px-4 py-2 text-sm text-left text-gray-800 hover:bg-purple-50 hover:text-purple-800 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                        Sidang Ulang
                                                    </button>
                                                </div>

                                                <!-- Materi Kurang -->
                                                <div>
                                                    <input type="hidden" name="status" value="Materi Kurang">
                                                    <button
                                                        class="cursor-pointer w-full px-4 py-2 text-sm text-left text-gray-800 hover:bg-yellow-50 hover:text-yellow-800 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                        Ditolak
                                                    </button>
                                                </div>

                                                <!-- Ditolak -->
                                                <div>
                                                    <input type="hidden" name="status" value="Ditolak">
                                                    <button
                                                        class="cursor-pointer w-full px-4 py-2 text-sm text-left text-gray-800 hover:bg-red-50 hover:text-red-800 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Hangus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </td>
                        @empty
                            <tr>
                                <td colspan="14" class="border py-12 text-center">Tidak ada data proposal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $proposals->links() }}
            </div>
        </div>

        <x-popup-window>
            <form method="POST" class="space-y-4 mb-4 text-sm">
                @csrf
                <!-- Registration Details -->
                <div class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">No Daftar</label>
                        <input type="text" x-model="noDaftar" readonly
                            class="mt-2 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">NIM</label>
                        <input type="text" x-model="nim" readonly
                            class="mt-2 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-700">
                    </div>
                </div>

                <!-- Student Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" x-model="nama" readonly
                        class="mt-2 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-700">
                </div>

                <!-- Thesis Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-900">Judul</label>
                    <textarea readonly
                        class="mt-2 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-700 resize-none"
                        rows="3" x-model="judul"></textarea>
                </div>

                <!-- Schedule Details -->
                <fieldset class="flex flex-col bg-white rounded-md border border-gray-300 p-4">
                    <legend class="text-sm font-semibold text-gray-700">Isi/Update Jadwal</legend>
                    <div class="grid grid-cols-1 mb-1 gap-4 sm:gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-900">Tanggal</label>
                            <input type="date" name="defense_date" value="{{ date('Y-m-d') }}"
                                class="mt-2 block bg-white w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Jam</label>
                            <input type="time" name="defense_time" value="08:00"
                                class="mt-2 block bg-white w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                    </div>
                </fieldset>

                <!-- Examiners -->
                <div>
                    <label class="block text-sm font-medium text-gray-900">Penguji</label>
                    <select name="examiner1" x-model="penguji1"
                        class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </select>
                </div>

                <!-- Room -->
                <div>
                    <label class="block text-sm font-medium text-gray-900">Ruang</label>
                    <select name="ruangs" x-model="ruang"
                        class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="cursor-pointer w-full sm:w-auto px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md transition-colors">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </x-popup-window>
    </div>
    <script>
        let searchTimeout;

        fetch('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/dosens')
            .then(response => response.json())
            .then(data => {
                const selectElement = document.querySelector('select[name="examiner1"]');

                // Membersihkan opsi yang sudah ada (opsional)
                selectElement.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Silahkan pilih dosen';
                defaultOption.selected = true;
                defaultOption.disabled = true;
                selectElement.appendChild(defaultOption);

                // Iterasi data dari API dan membuat opsi baru
                data.forEach(dosen => {
                    const option = document.createElement('option');
                    option.value = dosen.nik;
                    option.textContent = dosen.nama_gelar;
                    selectElement.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

        fetch('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/ruangs')
            .then(response => response.json())
            .then(data => {
                const selectElement = document.querySelector('select[name="ruangs"]');

                // Membersihkan opsi yang sudah ada
                selectElement.innerHTML = '';

                // Menambahkan opsi dengan value kosong sebagai selected
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Silahkan pilih ruang';
                defaultOption.selected = true;
                defaultOption.disabled = true;
                selectElement.appendChild(defaultOption);

                // Iterasi data dari API dan membuat opsi baru
                data.forEach(ruang => {
                    const option = document.createElement('option');
                    option.value = ruang.id;
                    option.textContent = ruang.id;
                    selectElement.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function submitSearchForm() {
            const form = document.getElementById('searchForm');

            // Hentikan timeout sebelumnya (debouncing)
            clearTimeout(searchTimeout);

            // Tetapkan timeout baru
            searchTimeout = setTimeout(() => {
                form.submit();
            }, 300); // Tunggu 300ms setelah pengguna berhenti mengetik
        }
    </script>
@endsection
