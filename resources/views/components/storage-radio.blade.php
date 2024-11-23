@props(['name' => 'storage', 'selected' => '64'])

@php
    $storageSizes = [
        ['value' => '4', 'label' => '4 GB'],
        ['value' => '8', 'label' => '8 GB'],
        ['value' => '16', 'label' => '16 GB'],
        ['value' => '32', 'label' => '32 GB'],
        ['value' => '64', 'label' => '64 GB'],
        ['value' => '128', 'label' => '12800000 GB'],
    ];
@endphp

<div class="flex flex-wrap gap-4 max-w-2xl p-4">
    @foreach ($storageSizes as $size)
        <label
            class="inline-flex py-2 px-4 relative items-center justify-center rounded-xl border-2 cursor-pointer transition-all duration-200 
            {{ $selected == $size['value']
                ? 'border-indigo-600 bg-indigo-600 text-white'
                : 'border-gray-200 bg-white text-gray-900 hover:border-gray-300' }}">
            <input type="radio" name="{{ $name }}" value="{{ $size['value'] }}"
                {{ $selected == $size['value'] ? 'checked' : '' }} class="sr-only">
            <span class="text-sm font-medium">{{ $size['label'] }}</span>
        </label>
    @endforeach
</div>
