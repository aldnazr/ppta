@extends('layouts.app')

@section('content')
    <div class="container bg-white rounded-xl shadow-lg border border-gray-200 mx-auto overflow-hidden">
        <x-header>Dashboard</x-header>
        <div class="p-4 lg:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Assessed Data Section -->
                <div class="bg-white rounded-lg p-6 border border-gray-300">
                    <p class="text-xl font-semibold mb-4">Assessed Data</p>
                    <div class="bg-green-100 rounded-lg p-4 mb-4">
                        <p class="text-green-800 font-medium">Total Assessed: <span
                                class="text-2xl">{{ $assessedCount }}</span>
                        </p>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($assessedData as $item)
                            <li class="py-4">
                                <p class="font-medium">{{ $item['name'] }}</p>
                                <p class="text-sm text-gray-600">Score: {{ $item['score'] }}</p>
                                <p class="text-xs text-gray-500">Assessed on:
                                    {{ date('M d, Y', strtotime($item['assessed_at'])) }}</p>
                            </li>
                        @endforeach
                    </ul>
                    @if ($assessedCount > 5)
                        <a href="#" class="mt-4 inline-block text-blue-600 hover:underline">View all
                            assessed data</a>
                    @endif
                </div>

                <!-- Unassessed Data Section -->
                <div class="bg-white rounded-lg p-6 border border-gray-300">
                    <p class="text-xl font-semibold mb-4">Unassessed Data</p>
                    <div class="bg-yellow-100 rounded-lg p-4 mb-4">
                        <p class="text-yellow-800 font-medium">Pending Assessment: <span
                                class="text-2xl">{{ $unassessedCount }}</span></p>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($unassessedData as $item)
                            <li class="py-4">
                                <p class="font-medium">{{ $item['name'] }}</p>
                                <p class="text-sm text-gray-600">Status: Pending</p>
                                <p class="text-xs text-gray-500">Submitted on:
                                    {{ date('M d, Y', strtotime($item['created_at'])) }}</p>
                            </li>
                        @endforeach
                    </ul>
                    @if ($unassessedCount > 5)
                        <a href="#" class="mt-4 inline-block text-blue-600 hover:underline">View
                            all unassessed data</a>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection

<script></script>
