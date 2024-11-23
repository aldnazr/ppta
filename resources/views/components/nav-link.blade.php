@props(['active' => false, 'iconClass' => ''])

@php
    $linkClass = $active ? 'text-indigo-600' : 'text-slate-700 hover:text-indigo-600 hover:bg-sky-50';
    $iconClass = trim(($active ? 'text-indigo-600' : 'text-zinc-500 group-hover:text-indigo-600') . ' ' . $iconClass);
@endphp

<a {{ $attributes }}
    class="{{ $linkClass }} group mt-2 flex items-center gap-x-4 rounded-lg p-3 font-semibold text-sm"
    aria-current="{{ $active ? 'page' : false }}">
    <i class="{{ $iconClass }}"></i>
    {{ $slot }}
</a>
