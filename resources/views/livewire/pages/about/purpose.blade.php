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
    <div class="max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-0 py-8 sm:py-12">
        <div class="">
            <div class="pb-8 sm:pb-12 text-base sm:text-lg space-y-8 md:w-[70%]">
                <!-- <div >The Alumni Association strives to connect alumni, students <br class="hidden md:block"> and friends of the University to
                    each other.</div> -->
            </div>
            <div class="space-y-8 sm:space-y-12 flex flex-col lg:flex-row lg:justify-between">
                <div class="w-full lg:w-[60%] space-y-8 sm:space-y-12">
                    <div class="flex gap-4">
                        <div class="w-10 mt-1.5 md:mt-0 h-10 flex items-center justify-center  bg-primary-gold">
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
                        <div class="w-10 h-10 mt-1.5 md:mt-0 flex items-center justify-center  bg-primary-gold">
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
                        <div class="w-10 h-10 mt-1.5 md:mt-0 flex items-center justify-center  bg-primary-gold">
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


                                        <div class="flex gap-4">
                        <div class="w-10 h-10 mt-1.5 md:mt-0 flex items-center justify-center  bg-primary-gold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M5.143 14A7.8 7.8 0 0 1 4 9.919C4 5.545 7.582 2 12 2s8 3.545 8 7.919A7.8 7.8 0 0 1 18.857 14M7.383 17.098c-.092-.276-.138-.415-.133-.527a.6.6 0 0 1 .382-.53c.104-.041.25-.041.54-.041h7.656c.291 0 .436 0 .54.04a.6.6 0 0 1 .382.531c.005.112-.041.25-.133.527c-.17.511-.255.767-.386.974a2 2 0 0 1-1.2.869c-.238.059-.506.059-1.043.059h-3.976c-.537 0-.806 0-1.043-.06a2 2 0 0 1-1.2-.868c-.131-.207-.216-.463-.386-.974M15 19l-.13.647c-.14.707-.211 1.06-.37 1.34a2 2 0 0 1-1.113.912C13.082 22 12.72 22 12 22s-1.082 0-1.387-.1a2 2 0 0 1-1.113-.913c-.159-.28-.23-.633-.37-1.34L9 19"/><path d="M8.25 9.75L10.5 12v4m-2.25-5.5a.75.75 0 1 0 0-1.5a.75.75 0 0 0 0 1.5m7.5-.75L13.5 12v4m2.25-5.5a.75.75 0 1 1 0-1.5a.75.75 0 0 1 0 1.5"/></g></svg>
                    </div>
                        <div class="w-[90%] space-y-1 md:space-y-0">
                            <div class="text-lg font-semibold">
                                Mengembangkan Inovasi
                            </div>
                             <div class="text-sm md:text-base">
                               Membentuk komunikasi yang dapat mendorong inovasi dalam manajemen dan riset melalui kolaborasi antara akademisi, praktisi, dan industri.
                            </div>
                        </div>
                    </div>


                                        <div class="flex gap-4">
                        <div class="w-10 h-10 mt-1.5 md:mt-0 flex items-center justify-center  bg-primary-gold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="#ffffff" d="M3.33 8L10 12l10-6l-10-6L0 6h10v2H3.33zM0 8v8l2-2.22V9.2L0 8zm10 12l-5-3l-2-1.2v-6l7 4.2l7-4.2v6L10 20z"/></svg>
                    </div>
                        <div class="w-[90%] space-y-1 md:space-y-0">
                            <div class="text-lg font-semibold">
                                Kontribusi Terhadap Pendidikan
                            </div>
                             <div class="text-sm md:text-base">
                                Menyediakan dukungan kepada mahasiswa aktif dan lulusan baru dalam bentuk bimbingan, beasiswa, atau program magang.
                            </div>
                        </div>
                    </div>

                                        <div class="flex gap-4">
                        <div class="w-10 h-10 mt-1.5 md:mt-0 flex items-center justify-center  bg-primary-gold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path fill="#ffffff" d="M21.066 20.667c1.227-.682 1.068-3.31-.354-5.874c-.61-1.104-1.36-1.998-2.11-2.623a5.229 5.229 0 0 1-3.1 1.03a5.23 5.23 0 0 1-3.105-1.03c-.75.625-1.498 1.52-2.11 2.623c-1.423 2.563-1.58 5.192-.35 5.874c.548.312 1.126.078 1.722-.496a10.51 10.51 0 0 0-.167 1.874c0 2.938 1.14 5.312 2.543 5.312c.846 0 1.265-.865 1.466-2.188c.2 1.314.62 2.188 1.46 2.188c1.397 0 2.546-2.375 2.546-5.312c0-.66-.062-1.29-.168-1.873c.6.575 1.176.813 1.726.497zM15.5 12.2a4.279 4.279 0 1 0-.003-8.557A4.279 4.279 0 0 0 15.5 12.2zm8.594 2.714a3.514 3.514 0 0 0 0-7.025a3.513 3.513 0 1 0 .001 7.027zm4.28 2.13c-.502-.908-1.116-1.642-1.732-2.155a4.3 4.3 0 0 1-2.546.845c-.756 0-1.46-.207-2.076-.55c.496 1.093.803 2.2.86 3.19c.094 1.516-.38 2.64-1.328 3.165a2.017 2.017 0 0 1-.653.224c-.057.392-.096.8-.096 1.23c0 2.413.935 4.362 2.088 4.362c.694 0 1.04-.71 1.204-1.796c.163 1.08.508 1.796 1.2 1.796c1.145 0 2.09-1.95 2.09-4.36c0-.543-.053-1.06-.14-1.54c.492.473.966.668 1.418.408c1.007-.56.877-2.718-.29-4.82zm-21.468-2.13a3.512 3.512 0 1 0-3.514-3.512a3.515 3.515 0 0 0 3.514 3.514zm2.535 6.622c-1.592-.885-1.738-3.524-.456-6.354a4.242 4.242 0 0 1-2.078.553c-.956 0-1.832-.32-2.55-.846c-.615.512-1.228 1.246-1.732 2.153c-1.167 2.104-1.295 4.262-.287 4.82c.45.258.925.065 1.414-.406a8.83 8.83 0 0 0-.135 1.538c0 2.412.935 4.36 2.088 4.36c.694 0 1.04-.71 1.204-1.795c.165 1.08.51 1.796 1.2 1.796c1.147 0 2.09-1.95 2.09-4.36c0-.433-.04-.842-.097-1.234a2.02 2.02 0 0 1-.66-.226z"/></svg>
                    </div>
                        <div class="w-[90%] space-y-1 md:space-y-0">
                            <div class="text-lg font-semibold">
                                Pengabdian Masyarakat
                            </div>
                             <div class="text-sm md:text-base">
                               Melaksanakan kegiatan sosial yang relevan dengan keahlian para alumni. Untuk memberikan kontribusi positif kepada masyarakat.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
