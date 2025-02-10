@extends('layouts.app')

@section('content')
    <div class="mx-auto lg:px-4 lg:py-8">
        <div class="bg-white max-w-2xl mx-auto shadow-xl rounded-xl lg:rounded-2xl overflow-hidden">
            <x-header>
                Form Konfirmasi Proposal
            </x-header>

            <form action="{{ route('ppta.laporan_fk_pdf') }}" method="GET" class="p-8 space-y-6">
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
                                text-sm text-gray-900 transition-all duration-300 ease-in-out"
                                value="{{ $tanggal_awal }}">
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
                                text-sm text-gray-900 transition-all duration-300 ease-in-out"
                                value="{{ $tanggal_akhir }}">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="krs" class="block text-sm font-semibold text-gray-700 mb-2">
                            KRS
                        </label>
                        <div class="relative">
                            <select id="krs" name="krs"
                                class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                text-sm text-gray-900 appearance-none transition-all duration-300 ease-in-out">
                                <option value="semua" {{ request('krs') == 'semua' ? 'selected' : '' }}>Semua
                                </option>
                                <option value="sudah" {{ request('krs') == 'sudah' ? 'selected' : '' }}>Sudah Tercatat
                                </option>
                                <option value="belum" {{ request('krs') == 'belum' ? 'selected' : '' }}>Belum Tercatat
                                </option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-1 flex items-center px-2 text-gray-700">
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
                                <option value="semua" {{ request('prodi') == 'semua' ? 'selected' : '' }}>Semua Program
                                    Studi
                                </option>
                                </option>
                                @foreach ($prodis as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ request('prodi') == $item['id'] ? 'selected' : '' }}>
                                        {{ $item['nama_prodi'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-1 flex items-center px-2 text-gray-700">
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
                        transition-all duration-300 ease-in-out transform cursor-pointer">
                        Tampilkan Laporan
                    </button>
                </div>
            </form>
            @if (session('error'))
                <x-alert type="error" title="{{ session('error.title') }}" message="{{ session('error.message') }}" />
            @endif
        </div>
    </div>
@endsection
