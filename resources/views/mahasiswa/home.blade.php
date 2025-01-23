@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
        <x-header>Home</x-header>
        <div class="p-4 lg:p-6">
            <form id="searchForm" method="GET" action="{{ url()->current() }}" class="mb-4 flex md:justify-end space-x-1.5">
                <!-- Search Bar -->
                <div class="relative w-full md:w-72">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="absolute h-full left-2 flex items-center h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        @keydown.enter="event.target.form.submit()" placeholder="Pencarian..."
                        class="w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-normal duration-300 bg-gray-50 py-2 pl-8 pr-4 text-sm" />
                </div>
            </form>

            <div class="overflow-x-auto bg-white rounded-md shadow border border-gray-200">
                <table class="w-full text-sm text-left divide-y divide-gray-200">
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
                            <th class="px-6 py-4 font-medium tracking-wider">
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
                                    <div class="md:text-base font-medium mb-2">{{ $schedule['title'] }}</div>
                                    <div class="text-gray-600 mb-1 text-nowrap">{{ $schedule['student'] }}</div>
                                    <div class="text-gray-600 text-nowrap">Pembimbing 1: {{ $schedule['supervisor1'] }}
                                    </div>
                                    <div class="text-gray-600 text-nowrap">Pembimbing 2: {{ $schedule['supervisor2'] }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination Links --}}
            <div>
                {{ $schedules->links() }}
            </div>
        </div>


    </div>
@endsection
