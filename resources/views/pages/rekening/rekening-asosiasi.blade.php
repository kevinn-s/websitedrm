<x-app-layout>
    <x-page-title 
        :breadcrumbs="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'Rekening', 'url' => route('kegiatan')],]"
        title="Rekening Asosiasi Alumni"
        ></x-page-title>
    <div class="px-36 pb-32 bg-white">
        <div class="w-10/12">
            <div class="py-10 text-xl">
                Lorem ipsum dolor sit amet consectetur. Aliquam diam aliquam morbi morbi diam odio. Praesent nec commodo
                sit lacus mattis.
            </div>
            <div class="pt-10 text-xl">
                Dukungan dapat diberikan baik melalui transfer langsung maupun dengan berkomitmen pada iuran berkala
                yang telah ditetapkan.
            </div>
            <div x-data="{ activeSection: 'TRANSFER' }" class="py-12">
                <div class="border-gray-300 border-b-2 flex font-semibold">
                    <div class="px-4 py-4 hover:bg-[#14a15b] hover:text-white transition-all duration-200 select-none"
                        :class="activeSection === 'TRANSFER' ? 'hover:bg-[#02743D] bg-[#02743D] text-white' : 'hover:bg-[#14a15b] hover:text-white'"
                        @click="activeSection = 'TRANSFER'">
                        Transfer secara langsung
                    </div>
                    <div class="px-8 py-4 hover:bg-[#14a15b] hover:text-white transition-all duration-200 select-none"
                        :class="activeSection === 'IURAN' ? 'hover:bg-[#02743D] bg-[#02743D] text-white' : 'hover:bg-[#14a15b] hover:text-white'"
                        @click="activeSection = 'IURAN'">
                        Iuran berkala</div>
                </div>
                <template x-if="activeSection === 'IURAN'">
                    <div class="space-y-12 pt-7 pb-14">
                        <div class="space-y-2">
                            <div class="text-2xl font-bold">
                                Iuran Berkala
                            </div>
                            <div class="text-lg">
                                Iuran berkala merupakan bentuk dukungan secara rutin yang dibayarkan dengan berjadwal.
                                sebagai donatur, anda dapat memilih skema
                                bulanan maupun tahunan:
                            </div>
                        </div>
                        <ul class="space-y-2 list-none w-[90%]">
                            <x-list title="Iuran Bulanan"
                                content="Lorem ipsum dolor sit amet consectetur. Aliquam diam aliquam morbi morbi diam odio. Praesent nec commodo sit lacus mattis." />
                        </ul>
                        <ul class="space-y-2 list-none  w-[90%]">
                            <x-list title="Iuran Tahunan"
                                content="Lorem ipsum dolor sit amet consectetur. Aliquam diam aliquam morbi morbi diam odio. Praesent nec commodo sit lacus mattis." />
                        </ul>
                        <div class="w-8/12 text-lg space-y-4">
                            <div class="font-bold">Lorem ipsum dolor sit amet consectetur.</div>
                            <div>Anda dapat melanjutkan pembayaran iuran alumni dengan menekan tombol di bawah ini:
                            </div>
                            <x-button class="relative z-20 mt-4">Bayar Iuran Alumni</x-button>
                        </div>
                    </div>
                </template>
                <template x-if="activeSection === 'TRANSFER'">
                    <div class="space-y-12 pt-7 pb-14">
                        <div class="space-y-2">
                            <div class="text-2xl font-bold">
                                Transfer Secara Langsung
                            </div>
                            <div class="text-lg">
                                Anda dapat berkontribusi dengan melakukan transfer secara langsung sesuai dengan nominal yang Anda inginkan. Informasi rekening tujuan dapat Anda lihat pada bagian di bawah ini:
                            </div>
                            <div class="w-9/12 space-y-8 font-inter my-14">
                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green px-6 py-3.5">
                                        <div class="font-semibold">
                                            BANK CENTRAL ASIA
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-700"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="absolute -top-3 left-5 px-1 bg-white font-medium">
                                            Nama Bank
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green px-6 py-3.5">
                                        <div class="font-semibold">
                                            PERKUMPULAN ALUMNI DOKTOR RISET MANAJEMEN
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-700"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="absolute -top-3 left-5 px-1 bg-white font-medium">
                                            Nama Rekening
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green px-6 py-3">
                                        <div class="text-[17px] font-semibold">
                                            594-188-8811
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-700"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="absolute -top-3 left-5 px-1 bg-white font-medium">
                                            Nomor Rekening
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green px-6 py-3.5">
                                        <div class="font-semibold">
                                            CABANG CIPONDOH
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-700"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="absolute -top-3 left-5 px-1 bg-white font-medium">
                                            Nama Cabang
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

        </div>
    </div>
</x-app-layout>