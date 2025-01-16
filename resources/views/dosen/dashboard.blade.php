@extends('layouts.app')

@section('content')
    <div class="container bg-white rounded-xl shadow-lg border border-gray-200 mx-auto overflow-hidden">
        <x-header>Dashboard</x-header>
        <div class="p-4 lg:p-6">
            <!-- Unassessed Data Section -->
            <div class="bg-white rounded-lg p-4 lg:p-5 border border-gray-300">
                <p class="text-xl font-semibold mb-4">Data Yang Belum Dinilai</p>
                <div class="bg-yellow-100 rounded-lg p-4 mb-4">
                    <p class="items-center text-center flex text-yellow-800 font-medium">Penilaian Tertunda: <span
                            class="text-2xl">{{ $unassessedCount }}</span>
                    </p>
                </div>
                <ul class="divide-y divide-gray-200 px-2">
                    @foreach ($paginated as $item)
                        <li class="flex py-4 justify-between items-center">
                            <div class="space-y-2">
                                <span
                                    class="capitalize inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $item['tipe'] === 'proposal' ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-lime-100 text-lime-800 border-lime-200' }}">
                                    {{ str_replace('_', ' ', $item['tipe']) }}
                                </span>
                                <p class="font-semibold text-gray-900 text-wrap">{{ $item['judul'] }}</p>
                                <div class="space-y-1">
                                    <p class="text-sm font-medium text-gray-700">{{ $item['nama_mahasiswa'] }}</p>
                                    <p class="text-sm text-gray-600">
                                        Sidang: {{ date('d M, Y', strtotime($item['tgl_pengajuan_proposal'])) }}
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('dashboard.penilaian', ['id' => $item['id']]) }}"
                                class="inline-flex ml-2 items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                Nilai
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- Pagination Links --}}
            <div>
                {{ $paginated->links() }}
            </div>
        </div>
    </div>
@endsection
