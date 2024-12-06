@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg mb-0.5 overflow-hidden">
        <div class="grid border-b border-gray-200">
            <x-header>Judul TA Perangkatan</x-header>

            <!-- Filter Chips -->
            <div class="flex flex-wrap gap-2 p-6">
                @foreach ($jurusan as $jur)
                    <button data-jurusan="{{ $jur }}"
                        class="text-sm lg:text-base filter-btn px-4 py-2 rounded-full font-medium transition-colors hover:bg-blue-100 {{ $jur === $activeJurusan ? 'bg-blue-100 text-blue-800' : 'bg-gray-200 text-gray-700' }}">
                        {{ $jur }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Content Card -->
        <div id="content-container" class="transition-all duration-300 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl lg:text-2xl font-semibold text-gray-800" id="jurusan-title">{{ $activeJurusan }}</h2>
                <div id="total-mahasiswa"
                    class="bg-blue-100 text-blue-800 px-3 lg:px-4 py-2 rounded-lg text-sm font-medium">
                    Total Mahasiswa: {{ array_sum($angkatan) }}
                </div>
            </div>

            <!-- List Angkatan -->
            <div id="angkatan-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @if (!empty($angkatan))
                    @foreach ($angkatan as $tahun => $total)
                        <div class="group">
                            <a href="#"
                                class="block p-4 border border-gray-200 rounded-lg group-hover:border-blue-300 group-hover:shadow-md transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-500 text-sm">Angkatan</span>
                                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">
                                            {{ $tahun }}</h3>
                                    </div>
                                    <div
                                        class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium group-hover:bg-blue-100">
                                        {{ $total }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center text-gray-500">Tidak ada data untuk jurusan ini.</div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.filter-btn').click(function() {
                const jurusan = $(this).data('jurusan');

                // Update active state
                $('.filter-btn').removeClass('bg-blue-100 text-blue-800').addClass(
                    'bg-gray-200 text-gray-700');
                $(this).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-100 text-blue-800');

                // Fetch data
                $.get(`/taperangkatan/jurusan?jurusan=${jurusan}`, function(response) {
                    const data = response.data;
                    let html = '';
                    let total = 0;

                    // Update title
                    $('#jurusan-title').text(jurusan);

                    // Generate new grid items
                    Object.entries(data)
                        .sort(([tahunA], [tahunB]) => tahunB - tahunA)
                        .forEach(([tahun, jumlah]) => {
                            total += jumlah;
                            html += `
                                <div class="group">
                                    <a href="#" class="block p-4 border border-gray-200 rounded-lg group-hover:border-blue-300 group-hover:shadow-md transition-all duration-200">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-gray-500 text-sm">Angkatan</span>
                                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">${tahun}</h3>
                                            </div>
                                            <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium group-hover:bg-blue-100">
                                                ${jumlah}
                                            </div>
                                        </div>
                                    </a>
                                </div>`;
                        });

                    // Update grid and total
                    $('#angkatan-grid').html(html);
                    $('#total-mahasiswa').text(`Total Mahasiswa: ${total}`);

                }).fail(function() {
                    // Show error
                    alert('Gagal memuat data. Coba lagi.');
                });
            });
        });
    </script>
@endsection
