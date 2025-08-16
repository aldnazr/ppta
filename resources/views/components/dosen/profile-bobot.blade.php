@props(['role' => '', 'bobot' => '', 'isRole' => true])

<!-- Top Bar -->
<div class="mb-6">
    <div class="flex flex-row justify-between items-center gap-2 sm:gap-4">
        <!-- Info Pembimbing -->
        <div class="flex items-center gap-3">
            <div class="{{ $isRole ? '' : 'px-[0.72rem]' }} bg-blue-50 p-2 rounded-full">
                {!! $isRole
                    ? '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24"
                                                                                                                                                                                                                                                                                                                                                                                                                    stroke="currentColor">
                                                                                                                                                                                                                                                                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                                                                                                                                                                                                                                                                                                                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                                                                                                                                                                                                                                                                                                                                                                </svg>'
                    : ' <i class="fa-regular fa-ballot-check fa-lg text-blue-600"></i>' !!}
            </div>
            <div class="flex flex-col">
                <span class="text-gray-900 font-semibold text-base">{{ $role }}</span>
                <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-sm">Nilai saat ini:</span>
                    <span class="font-bold text-lg text-blue-600">0</span>
                </div>
            </div>
        </div>

        <!-- Bobot -->
        <div class="bg-blue-50 py-1.5 px-4 rounded-full flex items-center gap-2">
            <span class="text-blue-700 font-medium text-sm">Bobot:</span>
            <span class="text-blue-800 font-bold">{{ $bobot }}%</span>
        </div>

    </div>
</div>
