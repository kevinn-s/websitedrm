<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //
}; ?>

<div>
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Visi dan Misi', 'url' => ''],
    ]"   title="Tujuan" background="bg-amber-950"></x-page-title>
    <div class="px-6 md:px-36 md:pb-32 bg-white">
        <div class="">
            <div class="pt-10 pb-12 text-lg space-y-8 md:w-[70%]">
                <div >The Alumni Association strives to connect alumni, students <br class="hidden md:block"> and friends of the University to
                    each other.</div>
            </div>
            <div class="space-y-12 flex justify-between">
                <div class="md:w-[60%] space-y-12">
                    <div class="flex gap-4">
                        <div class="w-10 mt-1.5 md:mt-0 h-10 flex items-center justify-center  bg-primary-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ffffff" d="M11.792 20.712q-.367 0-.645-.25q-.278-.249-.278-.654q0-.195.085-.43q.084-.236.254-.405l3.682-3.683l-.552-.552l-3.676 3.683q-.17.17-.383.254q-.214.085-.433.085q-.386 0-.655-.269t-.268-.654q0-.231.094-.451q.095-.22.239-.365l3.682-3.683l-.546-.546L8.71 16.47q-.15.15-.373.244q-.224.095-.449.095q-.38 0-.651-.271q-.272-.272-.272-.652q0-.22.085-.433q.085-.214.254-.383l3.452-3.452l-.552-.546l-3.446 3.452q-.145.144-.368.239q-.223.094-.453.094q-.406 0-.665-.259t-.259-.664q0-.22.085-.433t.254-.383l4.94-4.94l2.154 2.16q.275.275.621.389t.702.114q.723 0 1.208-.476t.485-1.216q0-.35-.135-.706q-.135-.355-.421-.642l-2.648-2.648l.98-.98q.33-.324.797-.508q.467-.183.934-.183q.496 0 .97.183q.473.184.807.519L21.03 8.47q.315.316.499.77q.184.453.184 1.005q0 .5-.187.945q-.187.446-.496.755l-8.421 8.427q-.162.162-.38.25q-.216.089-.436.089Zm-7.594-7.539l-1.035-1.035q-.425-.419-.64-1.007q-.215-.589-.215-1.15q0-.593.192-1.075t.49-.781l3.937-3.942q.323-.323.72-.513q.395-.19.863-.19q.502 0 .92.179q.42.178.766.524l4.164 4.163q.15.15.244.373t.094.423q0 .4-.261.671q-.262.272-.662.272q-.225 0-.433-.082q-.207-.082-.382-.257l-2.673-2.661l-6.089 6.088Z"/></svg>
                        </div>
                        <div class="w-[90%] space-y-1 md:space-y-0">
                            <div class="text-lg font-semibold">
                                Memperkuat Jaringan Alumni
                            </div>
                             <div class="text-sm md:text-base">
                                Membangun dan memelihara hubungan antara alumni untuk mendukung kolaborasi akademik riset, dan profesional.
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="w-10 h-10 mt-1.5 md:mt-0 flex items-center justify-center  bg-primary-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12 12"><path fill="#ffffff" d="M.75 0A.75.75 0 0 0 0 .75v10.5c0 .414.336.75.75.75h10.5a.75.75 0 0 0 .75-.75V.75a.75.75 0 0 0-.75-.75zm8.979 3.75c.15 0 .273.122.273.273v2.069a.273.273 0 0 1-.466.192l-.682-.681l-2 2a.5.5 0 0 1-.708 0L5 6.458L2.854 8.604a.5.5 0 1 1-.708-.708l2.5-2.5a.5.5 0 0 1 .708 0L6.5 6.543l1.647-1.647l-.68-.68a.273.273 0 0 1 .193-.466z"/></svg>
                        </div>
                        <div class="w-[90%] space-y-1 md:space-y-0">
                            <div class="text-lg font-semibold leading-6 md:leading-normal">
                                Mendukung Pengembangan Karir
                            </div>
                             <div class="text-sm md:text-base ">
                                Menyediakan platform untuk berbagi informasi terkait peluang pekerjaan, kolaborasi riset, dan pengembangan karir.
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-10 h-10 mt-1.5 md:mt-0 flex items-center justify-center  bg-primary-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 26 26"><path fill="#ffffff" d="M8 5H3.5c-.3 0-.5.2-.5.5v13c0 .3.2.5.5.5H7c3 0 4 2 4 2h1V7c0-.1-1-2-4-2m1 10H6c-.5 0-1-.5-1-1s.5-1 1-1h3c.5 0 1 .5 1 1s-.5 1-1 1m0-4H6c-.5 0-1-.5-1-1s.5-1 1-1h3c.5 0 1 .5 1 1s-.5 1-1 1m5-4v14h1s1-2 4-2h3.5c.3 0 .5-.2.5-.5v-13c0-.3-.2-.5-.5-.5H18c-3 0-4 1.9-4 2m2 7c0-.5.5-1 1-1h3c.5 0 1 .5 1 1s-.5 1-1 1h-3c-.5 0-1-.5-1-1m0-4c0-.5.5-1 1-1h3c.5 0 1 .5 1 1s-.5 1-1 1h-3c-.5 0-1-.5-1-1"/></svg>
                        </div>
                        <div class="w-[90%] space-y-1 md:space-y-0">
                            <div class="text-lg font-semibold">
                                Promosi Ilmu Pengetahuan Dan Riset
                            </div>
                             <div class="text-sm md:text-base">
                               Mendorong pengembangan riset di bidang manajemen dan ilmu terkait melalui seminar diskusi dan publikasi ilmiah.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>