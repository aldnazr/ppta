@extends('layouts.app')

@section('content')
    <div>
        <!-- Header Card -->
        <div class="border border-gray-200 bg-white rounded-lg shadow-md mb-6 p-6">
            <div class="grid grid-cols-1 gap-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-900">Nilai Detail</h1>
                </div>

                <!-- Student Info -->
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">NIM</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="{{ $proposal['mhs_nim'] }}" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Nama Mahasiswa</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="{{ $proposal['mhs_nama'] }}" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Judul</div>
                        <div class="col-span-2">
                            <textarea class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                rows="2" readonly>{{ $proposal['jdl_proposal'] }}</textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Tanggal Seminar TA</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="{{ $proposal['wkt_ta'] ?? '*************' }}" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Status Dosen</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="{{ $proposal['status_dosen'] }}" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Berkas</div>
                        <div class="col-span-2">
                            <div
                                class="flex flex-wrap md:flex-nowrap gap-2 overflow-x-auto py-2 px-1 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                                @php
                                    $baseUrl = 'https://sicyca.dinamika.ac.id/';
                                    $buttonClasses =
                                        'flex-shrink-0 px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-md shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50';
                                @endphp

                                <a href="{{ $proposal['file_proposal'] ? $baseUrl . $proposal['file_proposal'] : '#' }}"
                                    class="{{ $buttonClasses }}">
                                    Proposal
                                </a>

                                <a href="#" class="{{ $buttonClasses }}">
                                    Proposal (Digi)
                                </a>

                                <a href="#" class="{{ $buttonClasses }}">
                                    BAP
                                </a>

                                <a href="{{ $proposal['file_bimbingan'] ? $baseUrl . $proposal['file_bimbingan'] : '#' }}"
                                    class="{{ $buttonClasses }}">
                                    Bimbingan
                                </a>

                                <a href="#" class="{{ $buttonClasses }}">
                                    Hasil Ujian
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="mt-3 grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Nilai TA</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="0" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab Layout --}}
        <div x-data="{ activeTab: 'proposal' }" class="border border-gray-200 bg-white rounded-lg shadow-md p-4 mx-auto">
            {{-- Tab Menu --}}
            <div
                class="mx-auto p-2 flex justify-center bg-zinc-100 rounded-lg mb-4 border-b border-gray-200 overflow-x-auto">
                <div class="my-1 w-full">
                    <ul class="flex flex-wrap md:flex-nowrap justify-center gap-2 text-sm font-medium text-center"
                        id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="w-full md:w-auto">
                            <button @click="activeTab = 'proposal'"
                                :class="{ 'bg-white shadow-sm': activeTab === 'proposal' }"
                                class="cursor-pointer w-full inline-block px-4 py-2 rounded-md hover:bg-blue-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <span class="block md:inline">Proposal</span>
                                <span class="block md:inline md:ml-1">(10%): 0</span>
                            </button>
                        </li>
                        <li class="w-full md:w-auto">
                            <button @click="activeTab = 'bimbingan'"
                                :class="{ 'bg-white shadow-sm': activeTab === 'bimbingan' }"
                                class="cursor-pointer w-full inline-block px-4 py-2 rounded-md hover:bg-blue-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <span class="block md:inline">Bimbingan</span>
                                <span class="block md:inline md:ml-1">(40%): 0</span>
                            </button>
                        </li>
                        <li class="w-full md:w-auto">
                            <button @click="activeTab = 'sidang'"
                                :class="{ 'bg-white shadow-sm': activeTab === 'sidang' }"
                                class="cursor-pointer w-full inline-block px-4 py-2 rounded-md hover:bg-blue-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <span class="block md:inline">Sidang</span>
                                <span class="block md:inline md:ml-1">(100%): 0</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Tab Content --}}
            <div id="default-tab-content">
                {{-- Content for Proposal Tab --}}
                <div x-show="activeTab === 'proposal'" class="rounded-lg pb-3" id="proposal" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <div class="grid grid-cols-1 gap-y-3 lg:grid-cols-2 lg:gap-x-8">
                        <!-- Pembimbing Section -->
                        <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <x-dosen.profile-bobot role="Pembimbing 1" bobot="60" />

                            <!-- Form Section -->
                            <div class="space-y-4">
                                <h2 class="text-black font-semibold">Berita Acara</h2>
                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Perumusan masalah</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan penulisan masalah..."></textarea>
                                </div>

                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Kajian pustaka</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan kajian pustaka..."></textarea>
                                </div>

                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Metodologi</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan metodologi..."></textarea>
                                </div>

                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Luaran tugas akhir</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan luaran tugas akhir..."></textarea>
                                </div>

                                <div>
                                    <label for="tanggal_review"
                                        class="text-gray-900 text-sm font-medium mb-2.5 flex items-center gap-x-2">
                                        <i class="fa-solid fa-calendar-days text-zinc-500"></i>
                                        Tanggal Review</label>
                                    <input type="date" id="tanggal_review" name="tanggal_review"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button"
                                    {{ $proposal['status_dosen'] === 'Pembimbing 1' ? '' : 'disabled' }}
                                    class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Berita Acara
                                </button>
                            </div>

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ($penilaianProposalPembimbing as $index => $nilai)
                                        <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                            bobot="{{ $nilai['bobot'] }}"
                                            id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Pembimbing 1'" />
                                    @endforeach
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button"
                                    {{ $proposal['status_dosen'] === 'Pembimbing 1' ? '' : 'disabled' }}
                                    class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Nilai
                                </button>
                            </div>
                        </div>

                        <!-- Pembahas Section -->
                        <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <x-dosen.profile-bobot role="Pembahas 1" bobot="40" />

                            <!-- Form Section -->
                            <div class="space-y-4">
                                <h2 class="text-black font-semibold">Berita Acara</h2>
                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Perumusan
                                        masalah</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan penulisan masalah..."></textarea>
                                </div>

                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Kajian pustaka</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan kajian pustaka..."></textarea>
                                </div>

                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Metodologi</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan metodologi..."></textarea>
                                </div>

                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Luaran tugas
                                        akhir</label>
                                    <textarea id="penulisan_masalah" name="penulisan_masalah"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
                                        placeholder="Masukkan luaran tugas akhir..."></textarea>
                                </div>

                                <div>
                                    <label for="tanggal_review"
                                        class="text-gray-900 text-sm font-medium mb-2.5 flex items-center gap-x-2">
                                        <i class="fa-solid fa-calendar-days text-zinc-500"></i>
                                        Tanggal Review</label>
                                    <input type="date" id="tanggal_review" name="tanggal_review"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button" {{ $proposal['status_dosen'] === 'Penguji 1' ? '' : 'disabled' }}
                                    class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Berita Acara
                                </button>
                            </div>

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ($penilaianProposalPembahas as $index => $nilai)
                                        <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                            bobot="{{ $nilai['bobot'] }}"
                                            id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Penguji 1'" />
                                    @endforeach
                                </div>

                                <!-- Save Button -->
                                <div class="mt-6">
                                    <button type="button"
                                        {{ $proposal['status_dosen'] === 'Penguji 1' ? '' : 'disabled' }}
                                        class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                        Simpan Nilai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Content for Bimbingan Tab --}}
                <div x-show="activeTab === 'bimbingan'" class="rounded-lg pb-3" id="bimbingan" role="tabpanel"
                    aria-labelledby="dashboard-tab">
                    <div class="grid grid-cols-1 gap-y-3 lg:grid-cols-2 lg:gap-x-8">
                        {{-- Pembimbing 1 --}}
                        <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <x-dosen.profile-bobot role="Pembimbing 1" bobot="50" />

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ($penilaianBimbinganPembimbing1 as $index => $nilai)
                                        <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                            bobot="{{ $nilai['bobot'] }}"
                                            id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Pembimbing 1'" />
                                    @endforeach
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button"
                                    {{ $proposal['status_dosen'] === 'Pembimbing 1' ? '' : 'disabled' }}
                                    class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Nilai
                                </button>
                            </div>
                        </div>

                        {{-- Pembimbing 2 --}}
                        <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <x-dosen.profile-bobot role="Pembimbing 2" bobot="50" />

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ($penilaianBimbinganPembimbing2 as $index => $nilai)
                                        <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                            bobot="{{ $nilai['bobot'] }}"
                                            id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                            value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Pembimbing 2'" />
                                    @endforeach
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button"
                                    {{ $proposal['status_dosen'] === 'Pembimbing 2' ? '' : 'disabled' }}
                                    class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Nilai
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Content for Sidang Tab --}}
                <div x-show="activeTab === 'sidang'" class="rounded-lg pb-3" id="sidang" role="tabpanel"
                    aria-labelledby="settings-tab">
                    <!-- Pembimbing Section -->
                    <div class="grid grid-cols-1 gap-y-3 lg:grid-cols-2 lg:gap-x-8">
                        {{-- Pembahas 1 Section --}}
                        <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <x-dosen.profile-bobot role="Pembahas 1" bobot="20" />

                            <!-- Form Section -->
                            <div class="space-y-4">
                                <h2 class="text-black font-semibold">Berita Acara</h2>
                                <div>
                                    <label for="pembahas1" class="block text-gray-900 text-sm font-medium mb-2.5">Pembahas
                                        1</label>
                                    <textarea id="pembahas1" name="pembahas1"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"></textarea>
                                </div>

                                <div>
                                    <label for="tanggal_revisi"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Tanggal Revisi
                                    </label>
                                    <input id="tanggal_revisi" type="text" name="tanggal_revisi"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"></input>
                                </div>

                                <!-- Save Button -->
                                <div class="mt-6">
                                    <button type="button"
                                        {{ $proposal['status_dosen'] === 'Penguji 1' ? '' : 'disabled' }}
                                        class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                        Simpan Berita Acara
                                    </button>
                                </div>

                                <!-- Penilaian Section -->
                                <div class="mt-8 space-y-4 mb-4">
                                    <h2 class="text-black font-semibold">Penilaian</h2>
                                    <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                                        <!-- Top Bar -->
                                        <x-dosen.profile-bobot :isRole="false" role="Presentasi" bobot="20" />

                                        <!-- Form Section -->
                                        <div class="space-y-4">
                                            @foreach ($penilaianSidangPembahas1p1 as $index => $nilai)
                                                <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                                    bobot="{{ $nilai['bobot'] }}"
                                                    id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Penguji 1'" />
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                                        <!-- Top Bar -->
                                        <x-dosen.profile-bobot :isRole="false" role="Buku" bobot="40" />

                                        <!-- Form Section -->
                                        <div class="space-y-4">
                                            @foreach ($penilaianSidangPembahas1p2 as $index => $nilai)
                                                <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                                    bobot="{{ $nilai['bobot'] }}"
                                                    id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Penguji 1'" />
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                                        <!-- Top Bar -->
                                        <x-dosen.profile-bobot :isRole="false" role="Tanya-jawab" bobot="40" />

                                        <!-- Form Section -->
                                        <div class="space-y-4">
                                            @foreach ($penilaianSidangPembahas1p3 as $index => $nilai)
                                                <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                                    bobot="{{ $nilai['bobot'] }}"
                                                    id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Penguji 1'" />
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="mt-6">
                                        <button type="button"
                                            {{ $proposal['status_dosen'] === 'Penguji 1' ? '' : 'disabled' }}
                                            class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                            Simpan Nilai
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pembahas 2 Section -->
                        <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <x-dosen.profile-bobot role="Pembahas 2" bobot="20" />

                            <!-- Form Section -->
                            <div class="space-y-4">
                                <h2 class="text-black font-semibold">Berita Acara</h2>
                                <div>
                                    <label for="pembahas2" class="block text-gray-900 text-sm font-medium mb-2.5">Pembahas
                                        1</label>
                                    <textarea id="pembahas2" name="pembahas2"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"></textarea>
                                </div>

                                <div>
                                    <label for="tanggal_revisi"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Tanggal Revisi
                                    </label>
                                    <input id="tanggal_revisi" type="text" name="tanggal_revisi"
                                        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"></input>
                                </div>

                                <!-- Save Button -->
                                <div class="mt-6">
                                    <button type="button"
                                        {{ $proposal['status_dosen'] === 'Penguji 2' ? '' : 'disabled' }}
                                        class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                        Simpan Berita Acara
                                    </button>
                                </div>

                                <!-- Penilaian Section -->
                                <div class="mt-8 space-y-4 mb-4">
                                    <h2 class="text-black font-semibold">Penilaian</h2>
                                    <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                                        <!-- Top Bar -->
                                        <x-dosen.profile-bobot :isRole="false" role="Presentasi" bobot="20" />

                                        <!-- Form Section -->
                                        <div class="space-y-4">
                                            @foreach ($penilaianSidangPembahas2p1 as $index => $nilai)
                                                <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                                    bobot="{{ $nilai['bobot'] }}"
                                                    id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Penguji 2'" />
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                                        <!-- Top Bar -->
                                        <x-dosen.profile-bobot :isRole="false" role="Buku" bobot="40" />

                                        <!-- Form Section -->
                                        <div class="space-y-4">
                                            @foreach ($penilaianSidangPembahas2p2 as $index => $nilai)
                                                <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                                    bobot="{{ $nilai['bobot'] }}"
                                                    id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Penguji 2'" />
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="p-4 md:p-6 bg-white shadow border rounded-lg">
                                        <!-- Top Bar -->
                                        <x-dosen.profile-bobot :isRole="false" role="Tanya-jawab" bobot="40" />

                                        <!-- Form Section -->
                                        <div class="space-y-4">
                                            @foreach ($penilaianSidangPembahas2p3 as $index => $nilai)
                                                <x-input-number label="{{ $nilai['kriteria_nama'] }}"
                                                    bobot="{{ $nilai['bobot'] }}"
                                                    id="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    name="{{ str_replace(' ', '_', strtolower($nilai['kriteria_nama'])) }}"
                                                    value="{{ $nilai['nilai'] ?? '0' }}" :disabled="$proposal['status_dosen'] !== 'Penguji 2'" />
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="mt-6">
                                        <button type="button"
                                            {{ $proposal['status_dosen'] === 'Penguji 2' ? '' : 'disabled' }}
                                            class="cursor-pointer disabled:bg-black disabled:opacity-60 disabled:cursor-not-allowed w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                            Simpan Nilai
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
