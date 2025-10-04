<x-app-layout>
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => route('homepage')],
        ['label' => 'Visi dan Misi', 'url' => route('kegiatan')],
    ]" title="Visi dan Misi" background="bg-amber-950"></x-page-title>
    <div class="px-36 pb-32 bg-white">
        <div class="">
            <div class="py-10 text-lg space-y-8 w-[70%]">
                <div>The Alumni Association strives to connect alumni, students <br> and friends of the University to
                    each other.</div>
            </div>
            <div class="space-y-12 flex justify-between bg-">
                <div class="w-[60%] space-y-18">
                    <div class="">
                        <div
                            class="text-xl font-extrabold tracking-wide leading-7 text-white text-center w-12 h-12 flex items-center justify-center  bg-primary-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 472 384">
                                <path fill="#ffffff"
                                    d="M235 32q79 0 142.5 44.5T469 192q-28 71-91.5 115.5T235 352T92 307.5T0 192q28-71 92-115.5T235 32zm0 267q44 0 75-31.5t31-75.5t-31-75.5T235 85t-75.5 31.5T128 192t31.5 75.5T235 299zm-.5-171q26.5 0 45.5 18.5t19 45.5t-19 45.5t-45.5 18.5t-45-18.5T171 192t18.5-45.5t45-18.5z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold pt-6 pb-2 border-b-[0.5px] border-b-gray-300">
                            Visi Kami
                        </div>
                        <div class="my-4 space-y-8 text-lg">

                            <div>
                                The Alumni Association advocates for the University and its alumni with a credible,
                                independent, and collaborative voice.
                            </div>
                            <div>
                                The University of Minnesota Alumni Association fosters a lifelong spirit of belonging
                                and pride by connecting alumni, students, and friends to the University of Minnesota and
                                each other.
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="text-xl font-extrabold tracking-wide leading-7 text-white text-center w-12 h-12 flex justify-center items-center bg-primary-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024">
                                <path fill="#ffffff"
                                    d="M512 1024q-104 0-199-40.5t-163.5-109T40.5 711T0 512t40.5-199t109-163.5T313 40.5T512 0t199 40.5t163.5 109t109 163.5t40.5 199t-40.5 199t-109 163.5t-163.5 109t-199 40.5zm0-896q-104 0-192.5 51.5t-140 140T128 512t51.5 192.5t140 140T512 896t192.5-51.5t140-140T896 512t-51.5-192.5t-140-140T512 128zm0 704q-87 0-160.5-43T235 672.5T192 512t43-160.5T351.5 235T512 192t160.5 43T789 351.5T832 512t-43 160.5T672.5 789T512 832zm-.5-512Q432 320 376 376t-56 136t56 136t136 56t136-56t56-136t-56.5-136t-136-56zm.5 320q-53 0-90.5-37.5T384 512t37.5-90.5T512 384t90.5 37.5T640 512t-37.5 90.5T512 640z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold pt-6 pb-2 border-b-[0.5px] border-b-gray-300">
                            Misi Kami
                        </div>
                        <div class="my-4 space-y-8 text-lg">
                            To engage the University of Minnesota’s global community to support and advance the
                            University's excellence.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<!-- 
                <div>
                    <div class="text-2xl font-bold w-8/12 pb-2">
                        Featured Events
                    </div>
                    <div class="my-4 flex gap-16">
                        <div class="w-[30%] h-80">
                            <img class="h-8/12 w-fullobject-fill" src="https://arb.umn.edu/sites/arb.umn.edu/files/styles/folwell_full/public/2024-07/scarecrows_770x450.jpg?itok=x0zFPMim" alt="">
                            <div class="font-bold text-lg my-3">
                                Cultural Commons
                            </div>
                            <div class="text-sm">
                                This year marks a major milestone: the 500th graduate of the Master
                            </div>
                        </div>

                         <div class="w-[30%] h-80">
                            <img class=" h-8/12 w-full object-fill" src="https://arb.umn.edu/sites/arb.umn.edu/files/styles/folwell_full/public/2024-07/scarecrows_770x450.jpg?itok=x0zFPMim" alt="">
                            <div class="font-bold text-lg my-3">
                                Cultural Commons
                            </div>
                            <div class="text-sm">
                                This year marks a major milestone: the 500th graduate of the Master
                            </div>
                        </div>

                      
             
                    </div>
                </div> -->