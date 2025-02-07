@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <x-header>Home</x-header>
        <div class="p-4 lg:p-6">
            <form id="searchForm" method="GET" action="{{ url()->current() }}" class="mb-4 flex md:justify-end space-x-1.5">
                <!-- Search Bar -->
                <div class="relative flex w-full md:w-72 items-center">
                    <i class="fa-solid fa-magnifying-glass fa-sm absolute left-3 text-gray-700/90"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        @keydown.enter="event.target.form.submit()" placeholder="Pencarian"
                        class="w-full py-2 pl-10 pr-4 bg-gray-100 placeholder-gray-500 text-sm text-gray-700 rounded-lg ring ring-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" />
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
                                    <div class="font-medium">{{ $schedule['tgl'] }}
                                    </div>
                                    <div class="text-gray-700">Jam {{ $schedule['jam'] }}</div>
                                    <div class="text-gray-700">Ruang {{ $schedule['ruang_smn'] }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="md:text-base font-medium mb-2">{{ $schedule['jdl_proposal'] }}</div>
                                    <div class="text-gray-700 mb-1 text-nowrap">{{ $schedule['nama'] }}
                                        ({{ $schedule['nim'] }})
                                    </div>
                                    <div class="text-gray-700 text-nowrap">Pembimbing 1:
                                        {{ $schedule['pembimbing_1_nama'] }}
                                    </div>
                                    <div class="text-gray-700 text-nowrap">Pembimbing 2:
                                        {{ $schedule['pembimbing_2_nama'] }}
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
