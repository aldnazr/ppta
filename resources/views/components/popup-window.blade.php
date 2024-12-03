<div class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-xs backdrop-opacity-10 bg-zinc-950/40"
    x-show="open" x-transition @click="open = false">
    <div class="w-full bg-white border border-gray-200 rounded-xl shadow-lg p-6 mx-6 lg:mx-0 lg:max-w-2xl" @click.stop>
        <div class="flex justify-between items-start -mt-2 mb-4">
            <h2 class="text-lg font-bold text-gray-700" x-text="title"></h2>
            <button class="text-gray-500 hover:text-gray-700 cursor-pointer" @click="open = false">
                <i class="fa-regular fa-xmark fa-lg"></i>
            </button>
        </div>
        {{ $slot }}
    </div>
</div>
</div>
