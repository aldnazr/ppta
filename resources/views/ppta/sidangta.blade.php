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
        <x-header>Antrian Sidang Tugas Akhir</x-header>
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
            <div class="overflow-x-auto bg-white rounded-md border border-gray-200">
                <table class="w-full text-sm text-left divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700 uppercase tracking-wider">
                        <tr>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium">
                                NO
                            </th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium whitespace-nowrap">
                                NO DAFTAR</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                TANGGAL PENGAJUAN
                            </th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium uppercase">
                                TANGGAL Sidang
                            </th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                NIM
                            </th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium">
                                NAMA
                            </th>
                            <th class="border-e px-6 py-3 text-left text-xs font-medium whitespace-nowrap">
                                PEMBIMBING</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                JADWAL SIDANG TA</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                PROPOSAL TA</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                LAPORAN TA</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                JURNAL</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                SEMINAR</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI BIMBINGAN</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                POSTER</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI ORI</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI UPLOAD JURNAL</th>
                            <th class="border-e px-6 py-3 text-center text-xs font-medium">
                                BUKTI KEASLIAN</th>
                            <th class="px-6 py-3 text-center text-xs font-medium w-2/3">
                                HASIL</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($tugasAkhir as $index => $item)
                            <td rowspan="2" class="text-center px-4 py-2 whitespace-nowrap">{{ $index + 1 }}
                            <td colspan="12" class="border-s px-4 py-4 text-gray-900 font-medium">
                                {{ $item['jdl_proposal'] }}
                            </td>
                            <tr>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $item['kode_antrian'] }}</td>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $item['wkt_ta'] }}</td>
                                <td class="text-center text-zinc-600 border px-4 py-2">
                                    {{ $item['tgl_smn'] ?: 'Belum dijadwalkan' }}</td>
                                <td class="text-center text-zinc-600 border px-4 py-2">{{ $item['mhs_nim'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2">{{ $item['mhs_nama'] }}</td>
                                <td class="text-zinc-600 border px-4 py-2 md:text-nowrap">
                                    <ol class="list-decimal pl-4">
                                        <li>{{ $item['pembimbing_1_nama'] }}</li>
                                        <li>{{ $item['pembimbing_2_nama'] }}</li>
                                    </ol>
                                </td>
                                <td class="border text-center px-4 py-2">
                                    <button
                                        @click="open = true; 
                                            titleData = 'Jadwal Sidang TA'; 
                                            noDaftar = '{{ $item['kode_antrian'] }}';
                                            nim = '{{ $item['mhs_nim'] }}';
                                            nama = '{{ $item['mhs_nama'] }}';
                                            judul = '{{ $item['jdl_proposal'] }}';
                                            ruang = '{{ $item['ruang_smn'] }}';
                                            penguji1 = '{{ $item['penguji'] }}';
                                        "
                                        class="cursor-pointer px-3 py-1.5 rounded rounded-md text-sm text-nowrap ring bg-blue-100 text-blue-800 ring-blue-200">
                                        Atur Jadwal
                                    </button>
                                </td>
                                @php
                                    $links = [
                                        'proposal_link' => 'Proposal',
                                        'laporan_link' => 'Laporan',
                                        'jurnal_link' => 'Jurnal',
                                        'seminar_link' => 'Seminar',
                                        'bimbingan_link' => 'Bimbingan',
                                        'poster_link' => 'Poster',
                                        'original_link' => 'Original',
                                        'upload_jurnal_link' => 'Upload Jurnal',
                                        'keaslian_link' => 'Keaslian',
                                    ];
                                @endphp

                                @foreach ($links as $key => $label)
                                    @php
                                        $isDefaultLink = $item[$key] === 'https://sicyca.dinamika.ac.id/';
                                        $downloadLink = $isDefaultLink ? '#' : $item[$key];
                                        $linkClass = $isDefaultLink ? 'text-blue-400/80' : 'text-blue-500';
                                    @endphp

                                    <td class="text-zinc-600 border px-4 py-2 text-center">
                                        <a href="{{ $downloadLink }}"
                                            class="relative group cursor-pointer {{ $linkClass }}">
                                            <i class="fa-solid fa-download fa-lg"></i>
                                            <span
                                                class="{{ $isDefaultLink ? 'group-hover:block' : '' }} absolute left-1/2 -translate-x-1/2 bottom-full mb-2 hidden w-max px-2 py-1 text-sm text-white bg-gray-800 rounded-md shadow-md opacity-0 transition-opacity group-hover:opacity-100">
                                                Berkas tidak tersedia
                                            </span>
                                        </a>
                                    </td>
                                @endforeach

                                <td class="px-4 py-2">
                                    <form action="#" class="space-y-2">
                                        <select class="hasil ring ring-gray-300 rounded-md px-2 py-1 text-sm">
                                            <option value="" disabled selected>Pilih hasil</option>
                                            <option value="Y">Diterima</option>
                                            <option value="N">Ditolak</option>
                                        </select>
                                        <textarea class="keterangan w-full ring ring-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                            rows="2" placeholder="Keterangan jika ditolak"></textarea>
                                        <button
                                            class="cursor-pointer w-full rounded-md font-medium text-white/90 py-1.5 bg-blue-600 hover:bg-blue-700">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            </td>
                        @empty
                            <tr>
                                <td colspan="13" class="border py-12 text-center">Tidak ada data item</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{ $tugasAkhir->links() }}
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
        function toggleTextareaRequired(selectElement) {
            const keterangan = selectElement.parentElement.querySelector('.keterangan');
            if (selectElement.value === 'N') {
                keterangan.required = true;
                keterangan.style.display = 'block';
            } else {
                keterangan.required = false;
                keterangan.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const selectElements = document.querySelectorAll('.hasil');

            selectElements.forEach(selectElement => {
                selectElement.addEventListener('change', (event) => {
                    toggleTextareaRequired(event.target);
                });

                // Panggil sekali saat halaman dimuat untuk menyetel status awal
                toggleTextareaRequired(selectElement);
            });
        });

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
    </script>
@endsection
