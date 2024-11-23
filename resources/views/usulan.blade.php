<x-layout>
    <div class="p-4 md:p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-blue-800 mb-6 mt-2">Daftar Usulan Tugas Akhir</h1>

        <ul class="space-y-5">
            @foreach ($paginatedJudulTugasAkhir as $ta)
                <li class="p-4 bg-zinc-100 rounded-lg shadow-xs hover:shadow-md transition-shadow duration-200">
                    <h2 class="text-xl font-semibold text-blue-600"> Judul TA: {{ $ta->judul }}
                    </h2>
                    <p class="text-sm text-gray-600 mt-2"><strong>Pengusul:</strong> {{ $ta->pengusul }}</p>
                    <p class="text-sm text-gray-600 mt-2"><strong>Deskripsi:</strong>
                        {{ Str::limit($ta->deskripsi, 100) }}</p>
                </li>
            @endforeach
        </ul>

        <!-- Pagination Links -->
        <div class="flex mt-6 w-full justify-center">
            {{ $paginatedJudulTugasAkhir->links('vendor.pagination.custom-pagination') }}
        </div>

    </div>
</x-layout>
