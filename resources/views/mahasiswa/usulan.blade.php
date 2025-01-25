@extends('layouts.app')

@section('content')
    <div class="overflow-hidden bg-white rounded-xl shadow-sm" x-data="{ open: false, titleData: '', title() { return 'Judul: ' + this.titleData; }, pengusul: '', description: '' }">
        <x-header>Usulan Judul Tugas Akhir</x-header>
        <div class="p-4 lg:p-6">
            <ul class="space-y-4">
                @foreach ($paginatedJudulTugasAkhir as $ta)
                    <li @click="
                            titleData = '{{ $ta->judul }}';
                            pengusul = '{{ $ta->pengusul }}';
                            description = '{{ $ta->deskripsi }}';
                            open = true;"
                        class="p-4 border border-zinc-200 rounded-md lg:rounded-lg shadow-sm transition-shadow duration-200 cursor-pointer">
                        <h2 class="text-lg font-semibold text-blue-600">Judul TA: {{ $ta->judul }}</h2>
                        <p class="text-sm text-gray-600 mt-2"><strong>Pengusul:</strong> {{ $ta->pengusul }}</p>
                        <p class="text-sm text-gray-600 mt-2 line-clamp-1"><strong>Deskripsi:</strong>
                            {{ $ta->deskripsi }}</p>
                    </li>
                @endforeach
            </ul>

            {{-- Pagination Links --}}
            <div>
                {{ $paginatedJudulTugasAkhir->links() }}
            </div>

            <!-- Popup Window -->
            <x-popup-window>
                <div class="flex flex-col space-y-4 text-sm md:text-base">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-4 font-medium text-gray-600">
                            <span class="block mb-1">Pengusul</span>
                        </div>
                        <div class="col-span-8 text-gray-800" x-text="pengusul">
                            <!-- Nama Pengusul -->
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-4 font-medium text-gray-600">
                            <span class="block mb-1">Deskripsi</span>
                        </div>
                        <div class="col-span-8 text-gray-800 leading-relaxed" x-text="description">
                            <!-- Deskripsi Proposal -->
                        </div>
                    </div>
                </div>
            </x-popup-window>
        </div>
    </div>
@endsection
