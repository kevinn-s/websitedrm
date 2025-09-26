<x-app-layout>
    <div class="">
        <div class="">
            <div>
                <div class="flex flex-col mb-4">
                    <!-- Title -->
                    <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D]">
                        Alumni Directory
                    </h2>
                    <!-- Description -->
                    <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b">
                        Temukan dan terhubung sesama anggota asosiasi alumni DRM
                    </p>
                </div>

            </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center">
                    <livewire:alumni.alumni-list></livewire:alumni.alumni-list>
                </div>
          
        </div>
    </div>
</x-app-layout>