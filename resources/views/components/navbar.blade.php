<div class="flex h-full w-full" x-data="{ isOpen: true }" x-init="isOpen = window.innerWidth >= 768;
window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        isOpen = false;
    } else {
        isOpen = true;
    }
})">
    <!-- Sidebar -->
    <div id="sidebar" x-show="isOpen" :class="{ '-translate-x-full': !isOpen, 'translate-x-0': isOpen }"
        x-transition:enter="transition transform duration-300 ease-in-out" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition transform duration-300 ease-in-out"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
        class="w-72 fixed flex flex-col inset-y-0 left-0 z-50 transform border-r border-gray-200 bg-white">
        <!-- Open Close Button -->
        <button @click="isOpen = !isOpen"
            class="mt-3 ml-3 flex justify-center items-center pt-1 rounded-lg hover:border hover:bg-zinc-50 w-10 h-10 text-zinc-700 hover:text-zinc-500 hover:shadow-xs">
            {{-- <i class="fa-regular fa-sidebar fa-xl"></i> --}}
            <i class="fa-light fa-bars-sort fa-lg"></i>
        </button>

        <!-- Search Bar -->
        {{-- <div class="mt-2 px-4">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-2 top-2.5 h-4 w-4 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search..."
                    class="w-full rounded-lg border border-gray-200 bg-gray-50 py-2 pl-8 pr-4 text-sm" />
            </div>
        </div> --}}

        <!-- Main Navigation -->
        <nav class="mt-1 md:mt-5 px-3">
            <x-nav-link href="/" :active="request()->is('/')" iconClass="fa-regular fa-house fa-lg">
                Home
            </x-nav-link>

            <x-nav-link href="/pencarianpembimbing" :active="request()->is('pencarianpembimbing')" iconClass="fa-regular fa-users-medical fa-lg">
                Pencarian Pembimbing
            </x-nav-link>

            <x-nav-link href="/taperangkatan" :active="request()->is('taperangkatan')" iconClass="fa-regular fa-subtitles fa-lg">
                Judul TA Perangkatan
            </x-nav-link>

            <x-nav-link href="/document" :active="request()->is('document')" iconClass="fa-regular fa-folder-open fa-lg">
                Dokumen-Dokumen
            </x-nav-link>

            <x-nav-link href="/jadbimbingan" :active="request()->is('jadbimbingan')" iconClass="fa-regular fa-calendar-days fa-lg">
                Jadwal Bimbingan
            </x-nav-link>

            <x-nav-link href="/usulan" :active="request()->is('usulan')" iconClass="fa-solid fa-list-radio fa-lg">
                Usulan
            </x-nav-link>
        </nav>

        <!-- Teams Section -->
        {{-- <div class="mt-8">
            <div class="px-4 text-xs font-medium text-gray-500">Your teams</div>
            <nav class="mt-2 px-3">
                <a href="#"
                    class="flex items-center gap-x-3 rounded-lg px-2 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-sm bg-gray-100 text-xs font-medium">H</span>
                    Heroicons
                </a>
                <a href="#"
                    class="flex items-center gap-x-3 rounded-lg px-2 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-sm bg-gray-100 text-xs font-medium">T</span>
                    Tailwind Labs
                </a>
                <a href="#"
                    class="flex items-center gap-x-3 rounded-lg px-2 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-sm bg-gray-100 text-xs font-medium">W</span>
                    Workcation
                </a>
            </nav>
        </div> --}}

        <!-- Logout -->
        <div class="group mb-4 mt-auto px-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex w-full gap-x-4 font-semibold items-center  rounded-lg p-3 text-sm text-slate-700 hover:text-indigo-600 hover:bg-sky-50">
                    <i
                        class="fa-regular fa-arrow-right-from-bracket fa-lg text-slate-700 group-hover:text-indigo-600"></i>
                    Logout
                </button>
            </form>
            {{-- @csrf
            <a href="/login"
                class="flex font-semibold items-center gap-x-4 rounded-lg p-3 text-sm text-slate-700 hover:text-indigo-600 hover:bg-sky-50">
                <i class="fa-regular fa-arrow-right-from-bracket fa-lg text-slate-700 group-hover:text-indigo-600"></i>
                Logout
            </a> --}}
        </div>
    </div>

    <!-- Main Content Area -->
    <div :class="{ 'md:pl-72': isOpen }" class="flex flex-1 flex-col h-full w-full">
        <!-- Top Navigation -->
        <div :class="{ 'justify-between': !isOpen, 'justify-end': isOpen }"
            class="fixed top-0 left-0 right-0 z-40 flex h-16 items-center bg-white border-b border-gray-200 px-3">

            <!-- Button Toggle Sidebar -->
            <button :class="{ 'hidden': isOpen }" @click="isOpen = !isOpen"
                class="flex justify-center items-center pt-1 rounded-lg hover:border hover:bg-zinc-50 w-10 h-10 text-zinc-700 hover:text-zinc-500 hover:shadow-xs">
                <i class="fa-light fa-bars-sort fa-lg"></i>
            </button>

            <!-- Right Section -->
            <div class="flex items-center gap-x-4">
                <!-- User Info -->
                <div class="flex items-center gap-x-2 pr-1">
                    <img class="h-8 w-8 rounded-full object-cover"
                        src="https://plus.unsplash.com/premium_photo-1671656349322-41de944d259b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="User Avatar">
                    <span class="hidden md:block text-sm font-medium text-gray-700">
                        Tom Cook
                    </span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 mt-16 overflow-auto">
            <main class="px-6 py-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</div>
