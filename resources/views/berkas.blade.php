<x-layout>
    <div class="bg-gray-50 py-8">
        <!-- Header Card -->
        <div class="bg-white rounded-lg shadow-sm mb-6 p-6">
            <div class="grid grid-cols-1 gap-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-900">Nilai Detail</h1>
                    <span class="text-sm text-gray-500">Log Out (Tan Amelia)</span>
                </div>

                <!-- Student Info -->
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">NIM</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="18410100143" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Nama Mahasiswa</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="Muhammad Alauddin Azhary" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Judul</div>
                        <div class="col-span-2">
                            <textarea class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                rows="2" readonly>PENGARUH BANTUAN AI UPSCALE FHD MODEL PADA UNIVERSITAS SURABAYA</textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Tanggal Seminar TA</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="*************" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Status Dosen</div>
                        <div class="col-span-2">
                            <input type="text"
                                class="w-full border border-gray-300 rounded-md py-1 px-2 focus:border-green-500 focus:ring-green-500"
                                value="Pembimbing 1" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-sm text-gray-900">Berkas</div>
                        <div class="col-span-2">
                            <div
                                class="flex flex-wrap md:flex-nowrap gap-2 overflow-x-auto py-2 px-1 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                                <button
                                    class="flex-shrink-0 px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-md shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Proposal
                                </button>
                                <button
                                    class="flex-shrink-0 px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-md shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Proposal (Digi)
                                </button>
                                <button
                                    class="flex-shrink-0 px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-md shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Ujian
                                </button>
                                <button
                                    class="flex-shrink-0 px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-md shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Bimbingan
                                </button>
                                <button
                                    class="flex-shrink-0 px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-md shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Hasil Ujian
                                </button>
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
        <div class="bg-white rounded-lg shadow-sm p-2 mx-auto">
            {{-- Tab Menu --}}
            <div
                class="mx-auto flex justify-center bg-zinc-100 rounded-lg mt-2 mb-4 border-b border-gray-200 p-2 overflow-x-auto">
                <div class="my-1 w-full">
                    <ul class="flex flex-wrap md:flex-nowrap justify-center gap-2 text-sm font-medium text-center"
                        id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="w-full md:w-auto" role="presentation">
                            <button
                                class="w-full inline-block px-4 py-2 rounded-md hover:bg-blue-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                id="profile-tab" data-tabs-target="#proposal" type="button" role="tab"
                                aria-controls="profile" aria-selected="false">
                                <span class="block md:inline">Proposal</span>
                                <span class="block md:inline md:ml-1">(10%): 0</span>
                            </button>
                        </li>
                        <li class="w-full md:w-auto" role="presentation">
                            <button
                                class="w-full inline-block px-4 py-2 rounded-md hover:bg-blue-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                id="dashboard-tab" data-tabs-target="#bimbingan" type="button" role="tab"
                                aria-controls="dashboard" aria-selected="false">
                                <span class="block md:inline">Bimbingan</span>
                                <span class="block md:inline md:ml-1">(40%): 0</span>
                            </button>
                        </li>
                        <li class="w-full md:w-auto" role="presentation">
                            <button
                                class="w-full inline-block px-4 py-2 rounded-md hover:bg-blue-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                id="settings-tab" data-tabs-target="#sidang" type="button" role="tab"
                                aria-controls="settings" aria-selected="false">
                                <span class="block md:inline">Sidang</span>
                                <span class="block md:inline md:ml-1">(100%): 0</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Tab Content --}}
            <div id="default-tab-content">
                {{-- Tab Content 1 --}}
                <div class="hidden p-4 rounded-lg" id="proposal" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- Supervision Forms -->
                    <div class="grid grid-cols-1 gap-y-3 lg:grid-cols-2 lg:gap-x-8">
                        <!-- Pembimbing Section -->
                        <div class="p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-black font-semibold">Pembimbing</span>
                                    <span
                                        class="text-blue-700 bg-blue-100 py-1 px-3 rounded-full text-sm font-medium">60%</span>
                                </div>
                            </div>

                            <!-- Form Section -->
                            <div class="space-y-4">
                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Penulisan
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

                            <!-- Buttons -->
                            <div class="mt-6">
                                <button type="button"
                                    class="w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Berita Acara Pembimbing
                                </button>
                            </div>

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="penulisan_masalah_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Penulisan masalah
                                            (25%)</label>
                                        <input type="number" id="penulisan_masalah_nilai"
                                            name="penulisan_masalah_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="kajian_pustaka_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5">Kajian
                                            pustaka (25%)</label>
                                        <input type="number" id="kajian_pustaka_nilai" name="kajian_pustaka_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="metodologi_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Metodologi
                                            (25%)</label>
                                        <input type="number" id="metodologi_nilai" name="metodologi_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="luaran_tugas_akhir_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Luaran tugas akhir
                                            (25%)</label>
                                        <input type="number" id="luaran_tugas_akhir_nilai"
                                            name="luaran_tugas_akhir_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button"
                                    class="w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Nilai Pembimbing
                                </button>
                            </div>
                        </div>

                        <!-- Pembahas Section -->
                        <div class="p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-black font-semibold">Pembahas</span>
                                    <span
                                        class="text-blue-700 bg-blue-100 py-1 px-3 rounded-full text-sm font-medium">40%</span>
                                </div>
                            </div>

                            <!-- Form Section -->
                            <div class="space-y-4">
                                <div>
                                    <label for="penulisan_masalah"
                                        class="block text-gray-900 text-sm font-medium mb-2.5">Penulisan
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

                            <!-- Buttons -->
                            <div class="mt-6">
                                <button type="button"
                                    class="hidden w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Berita Acara Pembimbing
                                </button>
                            </div>

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="penulisan_masalah_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Penulisan masalah
                                            (25%)</label>
                                        <input type="number" id="penulisan_masalah_nilai"
                                            name="penulisan_masalah_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="kajian_pustaka_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5">Kajian
                                            pustaka (25%)</label>
                                        <input type="number" id="kajian_pustaka_nilai" name="kajian_pustaka_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="metodologi_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Metodologi
                                            (25%)</label>
                                        <input type="number" id="metodologi_nilai" name="metodologi_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="luaran_tugas_akhir_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Luaran tugas akhir
                                            (25%)</label>
                                        <input type="number" id="luaran_tugas_akhir_nilai"
                                            name="luaran_tugas_akhir_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button"
                                    class="hidden w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Nilai Pembimbing
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tab Content 2 --}}
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="bimbingan" role="tabpanel"
                    aria-labelledby="dashboard-tab">
                    <div class="grid grid-cols-1 gap-y-3 lg:grid-cols-2 lg:gap-x-8">
                        <div class="p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-black font-semibold">Pembimbing 1: 0</span>
                                    <span
                                        class="text-blue-700 bg-blue-100 py-1 px-3 rounded-full text-sm font-medium">50%</span>
                                </div>
                            </div>

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="penulisan_masalah_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Penulisan
                                            masalah
                                            (25%)</label>
                                        <input type="number" id="penulisan_masalah_nilai"
                                            name="penulisan_masalah_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="kajian_pustaka_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5">Kajian
                                            pustaka (25%)</label>
                                        <input type="number" id="kajian_pustaka_nilai" name="kajian_pustaka_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="metodologi_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Metodologi
                                            (25%)</label>
                                        <input type="number" id="metodologi_nilai" name="metodologi_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="luaran_tugas_akhir_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Luaran tugas
                                            akhir
                                            (25%)</label>
                                        <input type="number" id="luaran_tugas_akhir_nilai"
                                            name="luaran_tugas_akhir_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="button"
                                    class="w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring focus:ring-white">
                                    Simpan Nilai Pembimbing
                                </button>
                            </div>
                        </div>
                        <div class="p-6 bg-white shadow border rounded-lg">
                            <!-- Top Bar -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-black font-semibold">Pembimbing 2: 0</span>
                                    <span
                                        class="text-blue-700 bg-blue-100 py-1 px-3 rounded-full text-sm font-medium">50%</span>
                                </div>
                            </div>

                            <!-- Penilaian Section -->
                            <div class="mt-8 space-y-4">
                                <h2 class="text-black font-semibold">Penilaian</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="penulisan_masalah_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Penulisan
                                            masalah
                                            (25%)</label>
                                        <input type="number" id="penulisan_masalah_nilai"
                                            name="penulisan_masalah_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="kajian_pustaka_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5">Kajian
                                            pustaka (25%)</label>
                                        <input type="number" id="kajian_pustaka_nilai" name="kajian_pustaka_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="metodologi_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Metodologi
                                            (25%)</label>
                                        <input type="number" id="metodologi_nilai" name="metodologi_nilai"
                                            min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>

                                    <div>
                                        <label for="luaran_tugas_akhir_nilai"
                                            class="block text-gray-900 text-sm font-medium mb-2.5 ">Luaran tugas
                                            akhir
                                            (25%)</label>
                                        <input type="number" id="luaran_tugas_akhir_nilai"
                                            name="luaran_tugas_akhir_nilai" min="0" max="100"
                                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tab Content 3 --}}
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="sidang" role="tabpanel"
                    aria-labelledby="settings-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                            class="font-medium text-gray-800 dark:text-white">Settings tab's associated
                            content</strong>. Clicking another tab will toggle the visibility of this one for the next.
                        The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all tab buttons and content
        const tabButtons = document.querySelectorAll('[role="tab"]');
        const tabContents = document.querySelectorAll('[role="tabpanel"]');

        // Function to set active tab
        function setActiveTab(tabId) {
            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active states from all tabs
            tabButtons.forEach(button => {
                button.classList.remove('bg-white', 'shadow-sm');
                button.setAttribute('aria-selected', 'false');
            });

            // Show selected tab content
            const selectedContent = document.querySelector(tabId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }

            // Set active state for the selected tab
            const selectedTab = document.querySelector(`[data-tabs-target="${tabId}"]`);
            if (selectedTab) {
                selectedTab.classList.add('bg-white', 'shadow-sm');
                selectedTab.setAttribute('aria-selected', 'true');
            }
        }

        // Add click event listeners to all tabs
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabTarget = button.getAttribute('data-tabs-target');
                setActiveTab(tabTarget);
            });
        });

        // Set initial active tab (Profile tab)
        setActiveTab('#proposal');
    });
</script>
