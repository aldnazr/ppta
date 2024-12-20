@props([
    'type' => 'info',
    'title',
    'message',
])

@php
    $colors = match ($type) {
        'success' => [
            'bg' => 'bg-green-100',
            'icon' => 'text-green-600',
            'title' => 'text-green-800',
            'message' => 'text-green-700',
        ],
        'error' => [
            'bg' => 'bg-red-100',
            'icon' => 'text-red-600',
            'title' => 'text-red-800',
            'message' => 'text-red-700',
        ],
        'warning' => [
            'bg' => 'bg-yellow-100',
            'icon' => 'text-yellow-600',
            'title' => 'text-yellow-800',
            'message' => 'text-yellow-700',
        ],
        'info' => [
            'bg' => 'bg-blue-100',
            'icon' => 'text-blue-600',
            'title' => 'text-blue-800',
            'message' => 'text-blue-700',
        ],
        default => [
            'bg' => 'bg-gray-100',
            'icon' => 'text-gray-600',
            'title' => 'text-gray-800',
            'message' => 'text-gray-700',
        ],
    };
@endphp

<div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" x-init="setTimeout(() => show = false, 5000)"
    {{ $attributes->merge([
        'class' => "fixed top-4 right-4 max-w-full min-w-96 max-w-[calc(100%-2rem)] z-50 flex items-start space-x-4 p-4 rounded-lg shadow-lg {$colors['bg']} transition-all duration-300 ease-in-out",
    ]) }}>
    {{-- Icon --}}
    <div class="shrink-0">
        @switch($type)
            @case('success')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 {{ $colors['icon'] }}" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @break

            @case('error')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 {{ $colors['icon'] }}" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @break

            @case('warning')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 {{ $colors['icon'] }}" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            @break

            @default
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 {{ $colors['icon'] }}" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
        @endswitch
    </div>

    {{-- Content --}}
    <div class="flex-1 min-w-0">
        @if ($title)
            <p class="font-bold mb-1 {{ $colors['title'] }}">{{ $title }}</p>
        @endif

        @if ($message)
            <p class="text-sm {{ $colors['message'] }}">{{ $message }}</p>
        @endif
    </div>

    {{-- Close Button --}}
    <button @click="show = false"
        class="cursor-pointer shrink-0 text-opacity-50 hover:text-opacity-75 transition-all duration-200 {{ $colors['icon'] }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
