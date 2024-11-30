@if ($paginator->hasPages())
    <nav aria-label="Pagination"
        class="relative z-0 inline-flex rounded-md border border-gray-200 shadow-sm -space-x-px p-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-md transition-colors">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="px-3 py-1 bg-blue-500 text-white rounded-md font-semibold">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-1 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-md transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-1 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-md transition-colors">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
