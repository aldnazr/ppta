@props(['active' => false, 'tabName' => ''])

<a {{ $attributes }}
    class=" {{ $active ? 'text-indigo-600' : 'text-gray-700 hover:bg-zinc-100 hover:text-indigo-600' }} group flex items-center gap-x-3 rounded-lg p-2 font-semibold text-sm">
    <span
        class="flex h-6 w-6 font-normal text-xs {{ $active ? 'text-indigo-600 border-indigo-600' : 'text-gray-400 border-gray-200 group-hover:text-indigo-600 group-hover:border-indigo-600' }} items-center justify-center rounded-lg bg-white border">
        {{ $tabName[0] }}
    </span>
    {{ $tabName }}
</a>
