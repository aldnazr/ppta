@if ($paginator->hasPages())
    <div class="min-w-full mt-5 mx-auto flex flex-col gap-y-2 lg:flex-row lg:gap-y-0 lg:justify-between items-center">
        <div>
            <p class="text-gray-600">
                Menampilkan
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                sampai
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                dari
                <span class="font-medium">{{ $paginator->total() }}</span>
                hasil
            </p>
        </div>
        <div>
            <nav aria-label="Pagination"
                class="bg-white relative inline-flex rounded-xl border shadow-sm space-x-1 p-1.5">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fa-regular fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="group px-3 py-1 text-gray-500 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition-colors">
                        <i class="fa-regular fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    {{-- @if (is_string($element))
                <span class="px-3 py-1 text-red-900 bg-red-900 rounded-lg">
                    {{ $element }}
                </span>
            @endif --}}

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                    class="min-w-[34px] px-3 py-1 bg-blue-400 text-center text-white rounded-lg">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="min-w-[34px] px-3 py-1 text-center text-gray-600 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-3 py-1 text-gray-500 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition-colors">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fa-regular fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        </div>
    </div>
@endif
