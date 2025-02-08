@props([
    'label',
    'bobot' => null,
    'id' => '',
    'name' => '',
    'value' => '',
    'min' => 0,
    'max' => 100,
    'disabled' => false, // Tambahkan opsi disabled (default: false)
])

<div>
    <label for="{{ $id }}" class="block text-gray-900 text-sm font-medium mb-2.5">
        {{ $label }}
        @if ($bobot)
            ({{ $bobot }}%)
        @endif
    </label>
    <input type="number" id="{{ $id }}" name="{{ $name }}" min="{{ $min }}"
        max="{{ $max }}" value="{{ $value }}" {{ $disabled ? 'disabled' : '' }}
        class="w-full px-3 py-2 border text-sm border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-800">
</div>
