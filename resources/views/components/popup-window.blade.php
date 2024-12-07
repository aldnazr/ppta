@props(['css' => ''])

<div class=" overflow-hidden fixed inset-0 flex items-center justify-center z-50 backdrop-blur-xs backdrop-opacity-10 bg-zinc-950/40"
    x-show="open" x-transition>
    <div @click.outside="open = false"
        class="{{ $css }} overflow-auto m h-screen w-screen lg:max-w-4xl bg-white border border-gray-200 rounded-xl shadow-lg">
        <!-- Sticky header section -->
        <div class="sticky border-b border-gray-200 bg-white top-0 flex justify-between items-start px-6 py-4">
            <h2 class="text-lg font-bold text-gray-700" x-text="title"></h2>
            <button class="text-gray-500 hover:text-gray-700 cursor-pointer" @click="open = false">
                <i class="fa-regular fa-xmark fa-lg"></i>
            </button>
        </div>
        <!-- Scrollable content -->
        <div class="p-6">{{ $slot }}</div>
    </div>
</div>
