<x-layout>
    <div class="p-4 md:p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-xl flex justify-center md:justify-start md:text-2xl text-blue-800 font-semibold mb-6 mt-2">Daftar
            Sidang Tugas Akhir
        </h1>
        <div class="container mx-auto">
            <form id="searchForm" method="GET" action="{{ url()->current() }}" class="flex justify-end mb-4">
                <div class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau judul..."
                        class="bg-gray-200 rounded-md px-2 py-1 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="overflow-x-auto bg-white rounded-md shadow border border-gray-200">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-medium">
                                <a href="#" class="w-max flex items-center gap-x-2">Waktu <i
                                        class="fa-solid fa-sort fa-sm"></i></a>
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
                                    <div class="font-medium">{{ $schedule['date'] }}</div>
                                    <div class="text-gray-600">{{ $schedule['time'] }}</div>
                                    <div class="text-gray-600">{{ $schedule['room'] }}</div>
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
        </div>
    </div>

</x-layout>
