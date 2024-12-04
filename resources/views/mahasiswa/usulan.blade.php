@extends('layouts.app')

@section('content')
    <div class="p-4 md:p-6 bg-white rounded-md shadow-md" x-data="{ open: false, title: '', pengusul: '', description: '' }">
        <h1 class="text-2xl font-semibold text-blue-800 mb-6 mt-2">Daftar Usulan Tugas Akhir</h1>

        <ul class="space-y-4">
            @foreach ($paginatedJudulTugasAkhir as $ta)
                <li @click="
                title = '{{ $ta->judul }}';
                pengusul = '{{ $ta->pengusul }}';
                description = '{{ $ta->deskripsi }}';
                    open = true;"
                    class="p-4 bg-zinc-50 border border-zinc-200 rounded-xl shadow-xs hover:shadow-md transition-shadow duration-200 cursor-pointer">
                    <h2 class="text-lg font-semibold text-blue-600">Judul TA: {{ $ta->judul }}</h2>
                    <p class="text-sm text-gray-600 mt-2"><strong>Pengusul:</strong> {{ $ta->pengusul }}</p>
                    <p class="text-sm text-gray-600 mt-2"><strong>Deskripsi:</strong>
                        {{ Str::limit($ta->deskripsi, 100) }}</p>
                </li>
            @endforeach
        </ul>

        {{-- Pagination Links --}}
        <div>
            {{ $paginatedJudulTugasAkhir->links('vendor.pagination.custom-pagination') }}
        </div>

        <!-- Popup Window -->
        <x-popup-window>
            <div class="flex flex-col">
                <strong class="text-gray-700 mb-0.5">Pengusul:</strong>
                <p class="mb-2" x-text="pengusul"></p>
                <strong class="text-gray-700 mb-0.5">Deskripsi:</strong>
                <p class="text-gray-700" x-text="description"></p>
            </div>
        </x-popup-window>

    </div>
@endsection
