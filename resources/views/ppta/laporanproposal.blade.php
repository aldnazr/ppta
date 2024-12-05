@extends('layouts.app')

@section('content')
    <div class="bg-white mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <p class="text-2xl font-bold text-gray-800 mb-4">Laporan Proposal Tugas Akhir</p>
                <form class="space-y-4">
                    <div>
                        <label for="tanggal-awal" class="block text-gray-700 font-medium">Tanggal Awal:</label>
                        <input type="date" id="tanggal-awal" name="tanggal-awal"
                            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="tanggal-akhir" class="block text-gray-700 font-medium">Tanggal Akhir:</label>
                        <input type="date" id="tanggal-akhir" name="tanggal-akhir"
                            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="krs" class="block text-gray-700 font-medium">Hasil Sidang:</label>
                        <select id="krs" name="krs"
                            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih KRS</option>
                            <option value="semua">Semua</option>
                        </select>
                    </div>
                    <div>
                        <label for="prodi" class="block text-gray-700 font-medium">Prodi:</label>
                        <select id="prodi" name="prodi"
                            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Prodi</option>
                            <option value="semua">Semua</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
