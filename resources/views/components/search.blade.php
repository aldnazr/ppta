@props([
    'name' => 'search',
    'placeholder' => 'Cari sesuatu...',
])

<div class="relative flex w-full md:w-72 items-center">
    <i class="fa-solid fa-magnifying-glass fa-sm absolute left-3 text-gray-700/90"></i>
    <input type="text" name="{{ $name }}" value="{{ request($name) }}"
        @keydown.enter="event.target.form.submit()" placeholder="{{ $placeholder }}"
        class="w-full py-2 pl-9 pr-4 bg-gray-100 placeholder-gray-500 text-sm text-gray-700/90 rounded-lg ring ring-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" />
</div>
