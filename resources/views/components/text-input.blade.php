@props(['label', 'placeholder', 'type' => 'text'])

@php
    $labelId = str_replace(' ', '_', strtolower($label));
@endphp

<div>
    <label for="{{ $labelId }}" class="block text-gray-900 text-sm font-medium mb-2.5">
        {{ $label }}
    </label>
    <input id="{{ $labelId }}" type="{{ $type }}" name="{{ $labelId }}"
        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800"
        placeholder="{{ $placeholder }}"></input>
</div>
