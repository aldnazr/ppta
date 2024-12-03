@props(['tabName' => ''])

<a {{ $attributes }}
    class="group flex items-center gap-x-3 rounded-lg px-2 py-2 font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
    <span
        class="flex h-6 w-6 font-normal text-xs text-gray-400 items-center justify-center rounded-lg bg-white border border-gray-200 group-hover:text-indigo-600 group-hover:border-indigo-600">
        {{ $tabName[0] }}
    </span>
    {{ $tabName }}
</a>
