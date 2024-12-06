@extends('layouts.app')

@section('content')
    <div class="mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden">
            <x-header>
                Laporan Proposal Tugas Akhir
            </x-header>

            <form action="{{ route('ppta.laporan_proposal_pdf') }}" method="GET" class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal-awal" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Awal
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-calendar-days text-gray-400"></i>
                            </div>
                            <input type="date" id="tanggal-awal" name="tanggal-awal"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                text-sm text-gray-900 transition-all duration-300 ease-in-out">
                        </div>
                    </div>

                    <div>
                        <label for="tanggal-akhir" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Akhir
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-calendar-days text-gray-400"></i>
                            </div>
                            <input type="date" id="tanggal-akhir" name="tanggal-akhir"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                text-sm text-gray-900 transition-all duration-300 ease-in-out">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="krs" class="block text-sm font-semibold text-gray-700 mb-2">
                            Hasil Sidang
                        </label>
                        <div class="relative">
                            <select id="krs" name="krs"
                                class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                text-sm text-gray-900 appearance-none transition-all duration-300 ease-in-out">
                                <option value="semua">Semua</option>
                                <option value="sudah">Sudah</option>
                                <option value="belum">Belum</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="prodi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Program Studi
                        </label>
                        <div class="relative">
                            <select id="prodi" name="prodi"
                                class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                text-sm text-gray-900 appearance-none transition-all duration-300 ease-in-out">
                                <option value="semua">Semua Program Studi</option>
                                <option value="sistem_informasi">Sistem Informasi</option>
                                <option value="sistem_informasi_manajemen">Manajemen</option>
                                <option value="sistem_informasi_akuntansi">Akuntansi</option>
                                <option value="teknik_komputer">Teknik Komputer</option>
                                <option value="desain_komunikasi_visual">Desain Komunikasi Visual</option>
                                <option value="desain_produk">Desain Produk</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold py-3 px-4 
                        rounded-lg shadow-md hover:from-blue-600 hover:to-indigo-700 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                        transition-all duration-300 ease-in-out transform hover:scale-105 cursor-pointer">
                        Tampilkan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
