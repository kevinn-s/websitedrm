<x-app-layout>
    <div class="mx-[1rem] mt-[4rem]  pb-16 mb-[8rem] md:mx-[8rem] md:mt-[4rem] md:mb-[12rem] pt-10 md:pt-20">
        <x-breadcrumb :items="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'Kegiatan', 'url' => route('kegiatan')],
        ]" />
        <div>
            <div class="flex flex-col mb-4">
                <!-- Icon -->
                <div class="w-10 h-10 mb-2" style="
                background-image: url('{{ url('/images/icon_page.webp') }}');
                background-size: cover;
                background-position: -80px 0px;
                background-repeat: no-repeat;
                ">
                </div>

                <!-- Title -->
                <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D]">
                    Visi & Misi
                </h2>

                <!-- Description -->
                <p class="w-[100%] md:w-[720px] pb-8 md:mb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b">
                    Asosiasi Alumni Doctor of Research in Management BINUS University didirikan pada 28 November 2024 sebagai wadah kebersamaan dan kontribusi bagi seluruh lulusan program DRM. 
                </p>
            </div>

        </div>

        <div class="md:w-[60%]">
        <!-- Visi -->
        <div class="text-black mb-12">
        <!-- Icon + Title -->
        <div class="flex flex-col gap-1 mb-4">
            <h2 class="text-[24px] font-bold tracking-[-1px]">
            <span class="text-[#03563D]">Visi</span> Kami
            </h2>
        </div>

        <!-- Description -->
        <p class="md:text-[19px] leading-[22px] md:leading-[30px] font-medium mb-5">
            Sebagai asosiasi alumni, kami memiliki visi untuk membangun jejaring yang kuat, inspiratif, 
            dan berdampak positif bagi anggota serta masyarakat luas.
        </p>

        <!-- List -->
        <ul class="ml-5 md:text-[18px] list-disc">
            <li class="mb-2">Menjadi komunitas alumni yang solid dan saling mendukung.</li>
            <li class="mb-2">Mendorong kontribusi alumni dalam pengembangan ilmu dan profesi.</li>
            <li class="mb-2">Menjadi penghubung antara alumni, mahasiswa, dan almamater.</li>
            <li class="mb-2">Berperan aktif dalam kegiatan sosial dan kemasyarakatan.</li>
        </ul>
        </div>

        <!-- Misi -->
        <div class="text-black mb-12">
        <!-- Icon + Title -->
        <div class="flex flex-col gap-1 mb-4">
          
            <h2 class="text-[24px] font-bold tracking-[-1px]">
            <span class="text-[#03563D]">Misi</span> Kami
            </h2>
        </div>

        <!-- Description -->
        <p class="md:text-[19px] leading-[22px] md:leading-[30px] font-medium mb-5">
            Sebagai asosiasi alumni, kami memiliki visi untuk membangun jejaring yang kuat, inspiratif, 
            dan berdampak positif bagi anggota serta masyarakat luas.
        </p>

        <!-- List -->
        <ul class="ml-5 text-[18px] md:text-[19px] list-disc">
            <li class="mb-2">Menjadi komunitas alumni yang solid dan saling mendukung.</li>
            <li class="mb-2">Mendorong kontribusi alumni dalam pengembangan ilmu dan profesi.</li>
            <li class="mb-2">Menjadi penghubung antara alumni, mahasiswa, dan almamater.</li>
            <li class="mb-2">Berperan aktif dalam kegiatan sosial dan kemasyarakatan.</li>
        </ul>
        </div>
        </div>

    </div>
</x-app-layout>