@props(['user'])

<div class="flex h-full w-full" x-data="{
    isOpen: true,
    role: '{{ $user }}',
    getContentMarginClass() {
        if (this.role === 'mahasiswa') {
            return this.isOpen ? 'mt-16 lg:mt-0' : 'mt-16 2xl:mt-0';
        }
        return 'mt-16';
    },
    getTopNavClass() {
        if (this.role === 'mahasiswa') {
            return 'md:border-transparent md:w-max bg-white md:bg-transparent md:shadow-none';
        }
        return 'bg-white lg:shadow-sm';
    }
}" x-init="isOpen = window.innerWidth >= 1024;
window.addEventListener('resize', () => {
    isOpen = window.innerWidth >= 1024;
})">
    <!-- Desktop Sidebar -->
    <div class="hidden md:block">
        <div id="sidebar" x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="w-80 fixed flex pl-3 pr-4 flex-col inset-y-0 left-0 z-40 transform border-r border-gray-300 bg-white">
            <!-- Open Close Button -->
            <button @click="isOpen = !isOpen"
                class="mt-[0.73rem] flex justify-center items-center rounded-full w-10 h-10 hover:bg-gray-200 cursor-pointer">
                {{-- <i class="fa-regular fa-sidebar fa-xl"></i> --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    fill="currentColor" class="text-gray-600">
                    <path
                        d="M4 6a1 1 0 0 0 0 2h16a1 1 0 1 0 0-2H4zM3 12a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zM3 17a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1z" />
                </svg>
            </button>

            <!-- Main Navigation -->
            <nav class="mt-5">
                {{-- Menu khusus Mahasiswa --}}
                <template x-if="role === 'mahasiswa'">
                    <div>
                        <x-nav-link href="{{ route('home') }}" :active="request()->is('/')" iconClass="fa-regular fa-house fa-lg">
                            Home
                        </x-nav-link>

                        <x-nav-link href="{{ route('pencarianpembimbing') }}" :active="request()->is('pencarianpembimbing')"
                            iconClass="fa-regular fa-users-medical fa-lg">
                            Pencarian Pembimbing
                        </x-nav-link>

                        <x-nav-link href="{{ route('taperangkatan') }}" :active="request()->is('taperangkatan')"
                            iconClass="fa-regular fa-books fa-lg">
                            Judul TA Perangkatan
                        </x-nav-link>

                        <x-nav-link href="{{ route('document') }}" :active="request()->is('document')"
                            iconClass="fa-regular fa-folders fa-lg">
                            Dokumen-Dokumen
                        </x-nav-link>

                        <x-nav-link href="{{ route('jadbimbingan') }}" :active="request()->is('jadbimbingan')"
                            iconClass="fa-regular fa-calendar-days fa-lg">
                            Jadwal Bimbingan
                        </x-nav-link>

                        <x-nav-link href="{{ route('usulan') }}" :active="request()->is('usulan')"
                            iconClass="fa-regular fa-list-radio fa-lg">
                            Usulan
                        </x-nav-link>
                    </div>
                </template>

                {{-- Menu khusus Dosen --}}
                <template x-if="role === 'dosen'">
                    <div>
                        <x-nav-link href="{{ route('dosen.dashboard') }}" :active="request()->is('dosen/dashboard')"
                            iconClass="fa-duotone fa-solid fa-grid-2 fa-lg">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('dosen.berkas') }}" :active="request()->is('dosen/berkas')"
                            iconClass="fa-duotone fa-solid fa-folder-open fa-lg">
                            Berkas
                        </x-nav-link>
                    </div>
                </template>

                {{-- Menu khusus PPTA --}}
                <template x-if="role === 'ppta'">
                    <div>
                        <x-nav-link href="{{ route('ppta.proposal_ta') }}" :active="request()->is('ppta/proposal_ta')"
                            iconClass="fa-solid fa-book fa-lg">
                            Proposal TA
                        </x-nav-link>
                        <x-nav-link href="{{ route('ppta.sidang_ta') }}" :active="request()->is('ppta/sidang_ta')"
                            iconClass="fa-solid fa-gavel fa-lg">
                            Sidang TA
                        </x-nav-link>
                        <x-nav-link href="{{ route('ppta.maintenance') }}" :active="request()->is('ppta/maintenance')"
                            iconClass="fa-solid fa-screwdriver-wrench fa-lg">
                            Maintenance Penguji
                        </x-nav-link>
                    </div>
                </template>
            </nav>

            <!-- PPTA advance menu section -->
            <template x-if="role === 'ppta'">
                <div class="mt-8">
                    <div class="pl-2 text-xs font-semibold text-gray-500">Laporan</div>
                    <nav class="mt-2">
                        <x-sub-nav-link href="{{ route('ppta.laporan_fk') }}" :active="request()->is('ppta/laporan_fk')"
                            tabName="Form Konfirmasi Proposal"></x-sub-nav-link>
                        <x-sub-nav-link href="{{ route('ppta.laporan_proposal') }}" :active="request()->is('ppta/laporan_proposal')"
                            tabName="Laporan Proposal TA"></x-sub-nav-link>
                        <x-sub-nav-link href="{{ route('ppta.laporan_ta') }}" :active="request()->is('ppta/laporan_ta')"
                            tabName="Laporan Sidang TA"></x-sub-nav-link>
                    </nav>
                </div>
            </template>

            <!-- Logout -->
            <template x-if="role !== 'mahasiswa'">
                <div class="group mb-4 mt-auto">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="cursor-pointer flex w-full gap-x-4 font-semibold items-center rounded-lg p-3 text-sm text-slate-700 hover:text-indigo-600 hover:bg-zinc-100">
                            <i
                                class="fa-regular fa-arrow-right-from-bracket fa-lg text-slate-700 group-hover:text-indigo-600"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </template>
        </div>
    </div>

    {{-- Mobile Sidebar --}}
    <div class="md:hidden ">
        <div x-show="isOpen" class="z-50 backdrop-contrast-75 absolute h-screen w-screen bg-white/10">
            <div id="sidebar" @click.outside = "isOpen = false" x-show="isOpen"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="w-[55vh] max-w-80 pt-2 pl-2 pr-6 fixed flex flex-col pt-2.5 inset-y-0 left-0 z-40 transform border-r border-gray-300 bg-white">
                <!-- Close Button -->
                <div class="flex justify-end"><button @click="isOpen = !isOpen"
                        class="mt-[0.73rem] flex justify-center pt-[0.1rem] items-center h-6 w-6 rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-100 cursor-pointer">
                        {{-- <i class="fa-regular fa-sidebar fa-xl"></i> --}}
                        <i class="fa-regular fa-xmark fa-sm"></i>
                    </button>
                </div>

                <!-- Main Navigation -->
                <nav class="mt-1">
                    {{-- Menu khusus Mahasiswa --}}
                    <template x-if="role === 'mahasiswa'">
                        <div>
                            <x-nav-link href="{{ route('home') }}" :active="request()->is('/')"
                                iconClass="fa-regular fa-house fa-lg">
                                Home
                            </x-nav-link>

                            <x-nav-link href="{{ route('pencarianpembimbing') }}" :active="request()->is('pencarianpembimbing')"
                                iconClass="fa-regular fa-users-medical fa-lg">
                                Pencarian Pembimbing
                            </x-nav-link>

                            <x-nav-link href="{{ route('taperangkatan') }}" :active="request()->is('taperangkatan')"
                                iconClass="fa-regular fa-books fa-lg">
                                Judul TA Perangkatan
                            </x-nav-link>

                            <x-nav-link href="{{ route('document') }}" :active="request()->is('document')"
                                iconClass="fa-regular fa-folders fa-lg">
                                Dokumen-Dokumen
                            </x-nav-link>

                            <x-nav-link href="{{ route('jadbimbingan') }}" :active="request()->is('jadbimbingan')"
                                iconClass="fa-regular fa-calendar-days fa-lg">
                                Jadwal Bimbingan
                            </x-nav-link>

                            <x-nav-link href="{{ route('usulan') }}" :active="request()->is('usulan')"
                                iconClass="fa-regular fa-list-radio fa-lg">
                                Usulan
                            </x-nav-link>
                        </div>
                    </template>

                    {{-- Menu khusus Dosen --}}
                    <template x-if="role === 'dosen'">
                        <div>
                            <x-nav-link href="{{ route('dosen.dashboard') }}" :active="request()->is('dosen/dashboard')"
                                iconClass="fa-duotone fa-solid fa-grid-2 fa-lg">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link href="{{ route('dosen.berkas') }}" :active="request()->is('dosen/berkas')"
                                iconClass="fa-duotone fa-solid fa-folder-open fa-lg">
                                Berkas
                            </x-nav-link>
                        </div>
                    </template>

                    {{-- Menu khusus PPTA --}}
                    <template x-if="role === 'ppta'">
                        <div>
                            <x-nav-link href="{{ route('ppta.proposal_ta') }}" :active="request()->is('ppta/proposal_ta')"
                                iconClass="fa-solid fa-book fa-lg">
                                Proposal TA
                            </x-nav-link>
                            <x-nav-link href="{{ route('ppta.sidang_ta') }}" :active="request()->is('ppta/sidang_ta')"
                                iconClass="fa-solid fa-gavel fa-lg">
                                Sidang TA
                            </x-nav-link>
                            <x-nav-link href="{{ route('ppta.maintenance') }}" :active="request()->is('ppta/maintenance')"
                                iconClass="fa-solid fa-screwdriver-wrench fa-lg">
                                Maintenance Penguji
                            </x-nav-link>
                        </div>
                    </template>
                </nav>

                <!-- PPTA advance menu section -->
                <template x-if="role === 'ppta'">
                    <div class="mt-8">
                        <div class="px-2 text-xs font-semibold text-gray-500">Laporan</div>
                        <nav class="mt-2">
                            <x-sub-nav-link href="{{ route('ppta.laporan_fk') }}" :active="request()->is('ppta/laporan_fk')"
                                tabName="Form Konfirmasi Proposal"></x-sub-nav-link>
                            <x-sub-nav-link href="{{ route('ppta.laporan_proposal') }}" :active="request()->is('ppta/laporan_proposal')"
                                tabName="Laporan Proposal TA"></x-sub-nav-link>
                            <x-sub-nav-link href="{{ route('ppta.laporan_ta') }}" :active="request()->is('ppta/laporan_ta')"
                                tabName="Laporan Sidang TA"></x-sub-nav-link>
                        </nav>
                    </div>
                </template>

                <!-- Logout -->
                <template x-if="role !== 'mahasiswa'">
                    <div class="group mb-4 mt-auto">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit"
                                class="cursor-pointer flex w-full gap-x-4 font-semibold items-center  rounded-lg p-3 text-sm text-slate-700 hover:text-indigo-600 hover:bg-gray-50">
                                <i
                                    class="fa-regular fa-arrow-right-from-bracket fa-lg text-slate-700 group-hover:text-indigo-600"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main :class="{ 'lg:pl-80': isOpen }" class="flex bg-zinc-100 flex-1 flex-col h-full w-full">
        <!-- Top Navigation -->
        <div :class="getTopNavClass()"
            class="fixed top-0 justify-between left-0 right-0 z-30 flex h-16 items-center pl-2 lg:pl-3 pr-4 shadow-md">

            <!-- Button Toggle Sidebar -->
            <button @click="isOpen = !isOpen"
                class="flex justify-center items-center rounded-full w-10 h-10 hover:bg-gray-200 cursor-pointer {{ $user === 'mahasiswa' ? 'bg-transparent md:bg-white' : 'bg-transparent' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    fill="currentColor" class="text-gray-600">
                    <path
                        d="M4 6a1 1 0 0 0 0 2h16a1 1 0 1 0 0-2H4zM3 12a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zM3 17a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1z" />
                </svg>
            </button>

            <!-- Right Section -->
            <div class="{{ $user == 'mahasiswa' ? 'hidden' : '' }} flex items-center gap-x-4">
                <!-- User Info -->
                <div class="flex items-center gap-x-2 pr-1">
                    <img class="h-8 w-8 rounded-full object-cover"
                        src="https://plus.unsplash.com/premium_photo-1671656349322-41de944d259b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="User Avatar">
                    <span class="hidden md:block text-sm font-medium text-gray-700">
                        {{ $nama ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div :class="getContentMarginClass()" class="flex-1 overflow-auto">
            <div class="bg-zinc-100 container mt-3 mb-12 lg:mt-0 lg:mb-0 p-4 lg:p-8 max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </div>
    </main>
</div>
</div>
