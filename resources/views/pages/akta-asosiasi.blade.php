<x-app-layout>
    <div class="">
        <x-breadcrumb :items="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'Kegiatan', 'url' => route('kegiatan')],
        ]" />
        <div>
            <div class="flex flex-col mb-4">
                <!-- Icon -->
                                <div class="w-10 h-10 mb-2" style="
                background-image: url('{{ url('/images/page_icon.webp') }}');
                background-size: cover;
                background-position: -160px 0px;
                background-repeat: no-repeat;
                ">
                </div>

                <!-- Title -->
                <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D]">
                    Akta Pendirian
                </h2>

                <!-- Description -->
                <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b">
Dokumen resmi pembentukan Asosiasi Alumni DRM BINUS University                </p>
            </div>

        </div>

        <!-- Content Section -->
        <div class="flex flex-col md:flex-row justify-between mt-8">
            <div>
                <div  class="flex md:flex-none flex-col items-center md:items-start w-full md:gap-4">
                    <img class="w-40 h-auto mb-6" src="images/drm.webp" alt="Logo Asosiasi Alumni">

                    <div class= mb-6">
                        <div class="font-['Spline_Sans',sans-serif] text-[18px] font-bold leading-5 text-center md:text-left">ASOSIASI ALUMNI</div>
                        <div class="font-['Spline_Sans',sans-serif] text-[18px] font-bold leading-5 text-center md:text-left">DOCTOR OF RESEARCH IN MANAGEMENT</div>
                        <div class="font-['Spline_Sans',sans-serif] text-[18px] font-bold leading-5 text-center md:text-left">BINUS UNIVERSITY</div>
                    </div>

                    <div class="hidden md:grid grid-cols-[1fr_max-content] grid-rows-2 gap-x-6 gap-y-4 text-[15px]">
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Nomor Akta</div>
                            <p>AHU-0011584.AH.01.</p>
                            <p>07.TAHUN 2024</p>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Nomor Pendaftaran</div>
                            <p>6024 1211 3610 0578</p>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Tanggal Pengesahan</div>
                            <p>11 Desember 2024</p>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Notaris</div>
                            <p>JHONNI MARIHOTUA SIANTURI, SH</p>
                        </div>
                    </div>

                    <div class="md:hidden grid grid-rows-4 mt-8 gap-4">
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Nomor Akta</div>
                            <div class="text-sm">AHU-0011584.AH.01.07.TAHUN 2024</div>
                        </div>
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Nomor Pendaftaran</div>
                            <div class="text-sm">6024 1211 3610 0578</div>
                        </div>
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Tanggal Pengesahan</div>
                            <div class="text-sm">11 Desember 2024</div>
                        </div>
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Notaris</div>
                            <div class="text-sm">JHONNI MARIHOTUA SIANTURI, SH</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Box -->
            <div class="flex flex-col justify-center items-center text-center font-['Spline_Sans',sans-serif] w-full md:w-1/2 p-8 rounded-lg">
                <div class="mb-4">
                    <div class="w-20 h-20 bg-red-500 rounded-lg"></div>
                </div>
                <h4 class="font-bold text-[18px] text-[#03563D] font-['Spline_Sans',sans-serif] leading-5 mb-1">Download Dokumen Akta Pendirian</h4>
                <h4 class="font-bold text-[18px] text-[#03563D] font-['Spline_Sans',sans-serif] leading-5 mb-1">Asosiasi Alumni DRM</h4>
                <h4 class="font-bold text-[18px] text-[#03563D] font-['Spline_Sans',sans-serif] leading-5 mb-1">BINUS UNIVERSITY</h4>

                <p class="mt-4 mb-8 max-w-[75%] text-[14px] leading-[1.55] font-medium text-gray-600 mx-auto">
                    Unduh salinan resmi Akta Pendirian Asosiasi Alumni DRM BINUS University dalam bentuk PDF
                    <br>(Updated: January 2025)
                </p>
                <div class="flex justify-center gap-4 flex-wrap mb-4">
                    <a href="{{ route("download.akta") }}" class="bg-[#03563D] hover:bg-[#02432f] text-white  hover:text-white text-[12px] font-semibold py-2 px-6 rounded-md inline-flex items-center gap-2 no-underline font-['Spline_Sans',sans-serif]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M12 3v14" />
                            <path d="M6 11l6 6 6-6" />
                            <path d="M5 21h14" />
                        </svg>
                        <span>Download PDF (2.4 MB)</span>
                    </a>
                    
                </div>
                <div class="text-[11px] text-gray-600 font-medium">Document last updated: January 15, 2025</div>
            </div>
        </div>
    </div>
</x-app-layout>