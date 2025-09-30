<x-app-layout>

    <div>
         <x-breadcrumb :items="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'Alumni Directory', 'url' => route('alumni.directory')],
        ]" />
        <div class="flex flex-col mb-4">
            <div class="w-10 h-10 mb-2" style="
                background-image: url('{{ url('/images/page_icon.webp') }}');
                background-size: cover;
                background-position: left;
                background-repeat: no-repeat;
                ">
            </div>

            <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D]">
                Alumni Directory
            </h2>
            <!-- Description -->
            <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b">
                Temukan dan terhubung sesama anggota asosiasi alumni DRM
            </p>
        </div>

    </div>

   
        <livewire:alumni.alumni-list></livewire:alumni.alumni-list>
  


</x-app-layout>