@props(['maxWidthLG' => 'lg:max-w-4xl'])

<div class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center p-4 backdrop-blur-sm bg-black/40"
    x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div @click.outside="open = false"
        class="relative w-full {{ $maxWidthLG }} mx-auto max-h-[80vh] overflow-hidden bg-white border border-gray-200 rounded-xl shadow-lg">

        <!-- Sticky header section -->
        <div class="flex justify-between sticky bg-white top-0 z-10 shadow-sm items-center px-4 py-3 md:px-6 md:py-4">
            <h2 class="text-base md:text-lg font-bold text-gray-700 truncate" x-text="title()"></h2>
            <button
                class="text-gray-500 hover:text-gray-700 cursor-pointer rounded-full py-2 px-3 hover:bg-gray-100 transition-colors"
                @click="open = false">
                <i class="fa-regular fa-xmark fa-lg"></i>
            </button>
        </div>

        <!-- Scrollable content -->
        <div class="p-4 md:p-6 overflow-y-auto max-h-[calc(80vh-57px)]">
            {{ $slot }}
        </div>
    </div>
</div>
