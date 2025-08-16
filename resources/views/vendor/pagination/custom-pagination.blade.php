{{-- pagination-view.blade.php --}}
@if ($paginator->hasPages())
    <div class="min-w-full mt-5 mx-auto flex flex-col gap-y-2 lg:flex-row lg:gap-y-0 lg:justify-between items-center">
        {{-- Showing results text --}}
        <div>
            <p class="text-gray-600">
                Menampilkan {{ $paginator->firstItem() }} sampai {{ $paginator->lastItem() }} dari
                {{ $paginator->total() }} hasil
            </p>
        </div>

        {{-- Pagination navigation --}}
        <div>
            <nav class="bg-white relative inline-flex rounded-xl border border-gray-200 shadow-sm space-x-1 p-1.5">
                {{-- Previous Page --}}
                @if ($paginator->onFirstPage())
                    <span
                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 bg-zinc-100 opacity-50 px-3 py-1 text-gray-500 rounded-lg cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left fa-sm"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500 hover:text-blue-600 bg-zinc-100 hover:bg-indigo-100 rounded-lg transition-colors duration-200 ease-in-out">
                        <i class="fa-solid fa-chevron-left fa-sm"></i>
                    </a>
                @endif

                {{-- Numbered pages --}}
                @php
                    $start = $paginator->currentPage() - 2; // show 2 pages before current
                    $end = $paginator->currentPage() + 2; // show 2 pages after current
                    $start = max($start, 1); // never less than 1
                    $end = min($end, $paginator->lastPage()); // never greater than last page

                    // Adjust start and end to always show 5 pages if possible
                    if ($end - $start + 1 < 5) {
                        if ($start == 1) {
                            $end = min($end + (5 - ($end - $start + 1)), $paginator->lastPage());
                        } elseif ($end == $paginator->lastPage()) {
                            $start = max(1, $start - (5 - ($end - $start + 1)));
                        }
                    }
                @endphp

                {{-- First Page + Dots --}}
                @if ($start > 1)
                    <a href="{{ $paginator->url(1) }}"
                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500 hover:text-blue-600 bg-zinc-100 hover:bg-indigo-100 rounded-lg transition-colors duration-200 ease-in-out">
                        1
                    </a>
                    @if ($start > 2)
                        <span class="min-w-9 min-h-9 flex justify-center items-center px-3 py-1">...</span>
                    @endif
                @endif

                {{-- Page Links --}}
                @foreach (range($start, $end) as $page)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="min-w-9 min-h-9 flex justify-center items-center px-3 py-1 bg-indigo-500 text-white rounded-lg">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}"
                            class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500 hover:text-blue-600 bg-zinc-100 hover:bg-indigo-100 rounded-lg transition-colors duration-200 ease-in-out">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Last Page + Dots --}}
                @if ($end < $paginator->lastPage())
                    @if ($end < $paginator->lastPage() - 1)
                        <span class="min-w-9 min-h-9 flex justify-center items-center px-3 py-1">...</span>
                    @endif
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500 hover:text-blue-600 bg-zinc-100 hover:bg-indigo-100 rounded-lg transition-colors duration-200 ease-in-out">
                        {{ $paginator->lastPage() }}
                    </a>
                @endif

                {{-- Next Page --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 px-3 py-1 text-gray-500 hover:text-blue-600 bg-zinc-100 hover:bg-indigo-100 rounded-lg transition-colors duration-200 ease-in-out">
                        <i class="fa-solid fa-chevron-right fa-sm"></i>
                    </a>
                @else
                    <span
                        class="min-w-9 min-h-9 flex justify-center items-center border border-zinc-200 bg-zinc-100 opacity-50 px-3 py-1 text-gray-500 rounded-lg cursor-not-allowed">
                        <i class="fa-solid fa-chevron-right fa-sm"></i>
                    </span>
                @endif
            </nav>
        </div>
    </div>
@endif
