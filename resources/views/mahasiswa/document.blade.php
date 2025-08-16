@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Header Section with Gradient -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-5 lg:px-8 lg:py-6">
            <h1 class="text-2xl font-bold text-white">
                Dokumen Tugas Akhir (TA)
            </h1>
            <p class="mt-1.5 text-blue-100 ">
                Panduan dan dokumen pendukung untuk penyelesaian Tugas Akhir
            </p>
        </div>

        <!-- Content Section -->
        <div class="p-5 md:p-8">
            <!-- Introduction -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg mb-8">
                <p class="text-gray-700 text-justify md:text-left leading-relaxed">
                    Tugas Akhir adalah mata kuliah 6 sks, bertujuan untuk membekali mahasiswa Program S1
                    dengan pengalaman mengaplikasikan ilmu pengetahuan dan ketrampilan yang diperoleh
                    selama masa studi, mulai kegiatan analisa, perancangan dan atau implementasi sistem,
                    kemudian dituangkan dalam bentuk karya ilmiah.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-4">
                    <span class="bg-blue-100 p-2 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 lg:h-5 lg:w-5 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    Prasyarat Menempuh Tugas Akhir
                </h2>
                <ul class="space-y-2 text-gray-600 ml-11">
                    <li class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></div>
                        <span>Mencantumkan mata kuliah Tugas Akhir di KRS (Kartu Rencana Studi)</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></div>
                        <span>IPK minimal 2.00</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></div>
                        <span>Telah atau sedang menempuh Kerja Praktek</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></div>
                        <span>Telah menempuh minimal 114 sks</span>
                    </li>
                </ul>
            </div>

            <!-- Documents Grid -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Document Card 1 -->
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-3">
                        <span class="text-blue-600 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                        Pedoman Tugas Akhir
                    </h2>
                    <div class="space-y-2">
                        <a href="https://ppta.dinamika.ac.id/doc/PEDOMAN%20TA%20FTI%20FEB.pdf"
                            class="flex items-center px-4 py-2 bg-orange-50 text-orange-700 rounded-lg hover:bg-orange-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            PEDOMAN TA FTI/FEB
                        </a>
                        <a href="https://ppta.dinamika.ac.id/doc/PEDOMAN%20TA%20FDIK%20TAHUN%202022%20TTD.pdf"
                            class="flex items-center px-4 py-2 bg-orange-50 text-orange-700 rounded-lg hover:bg-orange-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            PEDOMAN TA FDIK
                        </a>
                    </div>
                </div>

                <!-- Document Card 2 -->
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-3">
                        <span class="text-blue-600 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </span>
                        Template & Dokumen
                    </h2>
                    <div class="space-y-2">
                        <a href="https://ppta.dinamika.ac.id/doc/Template%20Proposal%20Tugas%20Akhir.pdf"
                            class="flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Template Proposal
                        </a>
                        <a href="https://ppta.dinamika.ac.id/doc/Kartu%20Bimbingan%20TA.pdf"
                            class="flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Kartu Bimbingan TA
                        </a>
                        <a href="https://ppta.dinamika.ac.id/doc/Bukti%20Seminar%20TA%20-%20Universitas%20Dinamika.jpg"
                            class="flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Bukti Seminar TA
                        </a>
                        <a href="https://ppta.dinamika.ac.id/doc/Bukti%20Keaslian%20Karya%20Ilmiah.pdf"
                            class="flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Bukti Keaslian Karya Ilmiah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
