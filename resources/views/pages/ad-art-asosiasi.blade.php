<x-app-layout>
    <div class="mx-[1rem] mt-[4rem] pb-[4rem] md:mx-[8rem] md:mt-[4rem] md:mb-[12rem] pt-10 md:pt-20">
                <x-breadcrumb :items="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'AD/ART Asosiasi Alumni DRM', 'url' => route('ad-art-asosiasi')],
        ]" />
        <div>
            <div class="flex flex-col mb-4">
                <!-- Icon -->
                <div class="w-10 h-10">
                    <img src="/path/to/icon.png" alt="icon" class="" />
                </div>

                <!-- Title -->
                <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D]">
                    AD/ART Asosiasi Alumni DRM
                </h2>

                <!-- Description -->
                <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b">
Dokumen resmi AD/ART Asosiasi Alumni DRM BINUS University            </div>

        </div>

        <!-- Content Section -->
        <div class="flex flex-col md:flex-row gap-8 mt-8">
            <!-- Download Box -->
            <div class="flex flex-col justify-center items-center bg-[#f7faf9] text-center font-['Spline_Sans',sans-serif] w-full md:w-1/2 p-8 rounded-lg">
                <div class="mb-4">
                    <div class="w-20 h-20 bg-red-500 rounded-lg"></div>
                </div>
                <h4 class="font-bold text-[18px] text-[#03563D] font-['Spline_Sans',sans-serif] leading-5 mb-1">Download Dokumen AD/ART Resmi</h4>
                <h4 class="font-bold text-[18px] text-[#03563D] font-['Spline_Sans',sans-serif] leading-5 mb-1">Asosiasi Alumni DRM</h4>
                <h4 class="font-bold text-[18px] text-[#03563D] font-['Spline_Sans',sans-serif] leading-5 mb-1">BINUS UNIVERSITY</h4>

                <p class="mt-4 mb-8 max-w-[75%] text-[14px] leading-[1.55] font-medium text-gray-600 mx-auto">
                    Unduh salinan resmi dokumen AD/ART Asosiasi Alumni DRM BINUS University dalam bentuk PDF
                    <br>(Updated: January 2025)
                </p>
                <div class="flex justify-center gap-4 flex-wrap mb-4">
                    <a href="{{ route("download.ad-art") }}" class="bg-[#03563D] hover:bg-[#02432f] text-white text-[12px] font-semibold py-2 px-6 rounded-md inline-flex items-center gap-2 no-underline font-['Spline_Sans',sans-serif]">
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
            <!-- Document Summary Box -->
            <div class="border-2 border-dashed border-[#C09831] w-full md:w-1/2 rounded-lg p-8 text-[14px] leading-[1.55] font-['Spline_Sans',sans-serif] bg-white">
                <h4 class="mb-5 text-[18px] font-bold text-[#03563D] font-['Spline_Sans',sans-serif]">Document Summary</h4>
                <ul class="list-none m-0 p-0">
                    <li class="mb-3 font-medium text-gray-600 relative pl-2 before:content-['•'] before:text-[#03563D] before:font-bold before:absolute before:left-0">Articles of Incorporation and Organizational Structure</li>
                    <li class="mb-3 font-medium text-gray-600 relative pl-2 before:content-['•'] before:text-[#03563D] before:font-bold before:absolute before:left-0">Board of Directors Composition and Governance</li>
                    <li class="mb-3 font-medium text-gray-600 relative pl-2 before:content-['•'] before:text-[#03563D] before:font-bold before:absolute before:left-0">Membership Rights, Responsibilities, and Classifications</li>
                    <li class="mb-3 font-medium text-gray-600 relative pl-2 before:content-['•'] before:text-[#03563D] before:font-bold before:absolute before:left-0">Financial Management and Audit Requirements</li>
                    <li class="mb-3 font-medium text-gray-600 relative pl-2 before:content-['•'] before:text-[#03563D] before:font-bold before:absolute before:left-0">Amendment Procedures and Legal Compliance</li>
                    <li class="mb-3 font-medium text-gray-600 relative pl-2 before:content-['•'] before:text-[#03563D] before:font-bold before:absolute before:left-0">Dissolution Provisions and Asset Distribution</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>