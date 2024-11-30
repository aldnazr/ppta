<x-layout>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="flex justify-between items-center px-4 py-3 bg-white">
                        <div class="flex items-center">
                            <label for="per-page" class="mr-2">Show:</label>
                            <select id="per-page"
                                class="bg-gray-200 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="flex items-center">
                            <input type="text" placeholder="Search..."
                                class="bg-gray-200 rounded-md px-2 py-1 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <div class="flex space-x-2">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tgl Pengajuan Proposal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tgl Pengajuan TA
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mahasiswa
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pembiming
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penguji
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siap Transfer
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($proposals as $index => $proposal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposals->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['tgl_pengajuan_proposal'] ? date('d-m-Y', strtotime($proposal['tgl_pengajuan_proposal'])) : '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['tgl_pengajuan_ta'] ? date('d-m-Y', strtotime($proposal['tgl_pengajuan_ta'])) : '' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proposal['nim'] }}
                                        {{ $proposal['nama_mahasiswa'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proposal['judul'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        1. {{ $proposal['pembimbing1'] }}
                                        2. {{ $proposal['pembimbing2'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['penguji'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal['siap_transfer'] ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('penilaian', $proposal['id']) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                            Nilai
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="min-w-full mx-auto sm:px-6">
                        <div class="py-3">
                            <div class="flex justify-between items-center">
                                <div class="flex-1 flex items-center justify-between">
                                    <p class="text-sm text-gray-700">
                                        Menampilkan
                                        <span class="font-medium">{{ $proposals->firstItem() }}</span>
                                        sampai
                                        <span class="font-medium">{{ $proposals->lastItem() }}</span>
                                        dari
                                        <span class="font-medium">{{ $proposals->total() }}</span>
                                        hasil
                                    </p>
                                    <div>
                                        {{ $proposals->links('vendor.pagination.custom-pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
