<x-layout>
    <h1 class="text-xl text-gray-700 font-semibold mb-6 mt-2">Daftar Sidang Tugas Akhir</h1>
    <div class="container mx-auto">
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                            <a href="#" class="w-max flex items-center gap-x-2">Waktu <i
                                    class="fa-solid fa-sort fa-sm"></i></a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
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
</x-layout>
