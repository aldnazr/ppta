@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
        <x-header>Home</x-header>
        <div class="p-4 lg:p-6">
            <div class="w-full lg:w-auto mb-4 flex flex-col lg:justify-end lg:flex-row space-y-3 lg:space-y-0 lg:space-x-2">
                <form id="searchForm" method="GET" action="{{ url()->current() }}" class="flex items-center space-x-1.5">
                    <div class="flex-grow lg:flex-grow-0 lg:w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama atau judul..."
                            class="w-full h-10 lg:h-auto bg-gray-200 text-sm rounded-md px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <button type="submit"
                        class="bg-blue-500 w-10 lg:w-auto h-10 lg:h-auto hover:bg-blue-700 text-white font-bold py-1 px-2 rounded cursor-pointer">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto bg-white rounded-md shadow border border-gray-200">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-medium">
                                <a href="{{ $currentSort === 'date_asc'
                                    ? request()->fullUrlWithQuery(['sort' => 'date_desc'])
                                    : request()->fullUrlWithQuery(['sort' => 'date_asc']) }}"
                                    class="flex items-center gap-x-2">
                                    Tanggal
                                    <i
                                        class="fa-duotone fa-solid fa-sort {{ $currentSort === 'date_desc' ? 'fa-rotate-180' : '' }}"></i>
                                </a>
                            </th>
                            <th class="px-6 py-4 font-medium">
                                Tugas Akhir
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-top w-48">
                                    <div class="font-medium">{{ \Carbon\Carbon::parse($schedule['date'])->format('d-m-Y') }}
                                    </div>
                                    <div class="text-gray-600">Jam {{ $schedule['time'] }}</div>
                                    <div class="text-gray-600">Ruang {{ $schedule['room'] }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="font-medium mb-2">{{ $schedule['title'] }}</div>
                                    <div class="text-gray-600 mb-1">{{ $schedule['student'] }}</div>
                                    <div class="text-gray-600">Pembimbing 1: {{ $schedule['supervisor1'] }}</div>
                                    <div class="text-gray-600">Pembimbing 2: {{ $schedule['supervisor2'] }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination Links --}}
            <div>
                {{ $schedules->links('vendor.pagination.custom-pagination') }}
            </div>
        </div>


    </div>
@endsection
