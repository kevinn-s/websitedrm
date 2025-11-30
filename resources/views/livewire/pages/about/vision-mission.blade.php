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
    ]" title="Visi dan Misi" background="bg-amber-950" description="                    Asosiasi Alumni DRM Binus University hadir sebagai wadah untuk menghubungkan para alumni,
                    mahasiswa, dan sahabat universitas dalam satu komunitas yang solid dan berdampak.
"></x-page-title>
    <div class="max-w-5xl mx-auto bg-white px-4 sm:px-6 lg:px-0 py-8 sm:py-10">
        <div class="">

            <div class="flex flex-col lg:flex-row justify-between gap-8 sm:gap-10">
                <div class="w-full lg:w-[60%] space-y-8 sm:space-y-10">
                    <!-- Visi Section -->
                    <div class="">
                        <!-- <div
                            class="text-xl font-extrabold tracking-wide leading-7 text-white text-center w-12 h-12 flex items-center justify-center bg-primary-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 472 384">
                                <path fill="#ffffff"
                                    d="M235 32q79 0 142.5 44.5T469 192q-28 71-91.5 115.5T235 352T92 307.5T0 192q28-71 92-115.5T235 32zm0 267q44 0 75-31.5t31-75.5t-31-75.5T235 85t-75.5 31.5T128 192t31.5 75.5T235 299zm-.5-171q26.5 0 45.5 18.5t19 45.5t-19 45.5t-45.5 18.5t-45-18.5T171 192t18.5-45.5t45-18.5z" />
                            </svg>
                        </div> -->
                        <div class="text-xl sm:text-2xl font-bold pt-4 sm:pt-6 pb-2 border-b-[0.5px] border-b-gray-300">
                            Visi Kami
                        </div>
                        <div class="my-4 space-y-4 text-sm sm:text-base text-gray-700">
                            <p class="leading-relaxed">
                                Menjadi asosiasi alumni yang unggul, inovatif, dan berpengaruh dalam membangun
                                jaringan profesional yang kuat serta berkontribusi nyata bagi kemajuan bangsa
                                dan almamater.
                            </p>
                            <p class="leading-relaxed">
                                Kami berkomitmen untuk menciptakan ekosistem kolaboratif yang menghubungkan
                                para alumni lintas generasi, mendorong pertukaran pengetahuan, dan membuka
                                peluang karir serta bisnis bagi seluruh anggota.
                            </p>
                        </div>
                    </div>

                    <!-- Misi Section -->
                    <div>
                        <!-- <div
                            class="text-xl font-extrabold tracking-wide leading-7 text-white text-center w-12 h-12 flex justify-center items-center bg-primary-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024">
                                <path fill="#ffffff"
                                    d="M512 1024q-104 0-199-40.5t-163.5-109T40.5 711T0 512t40.5-199t109-163.5T313 40.5T512 0t199 40.5t163.5 109t109 163.5t40.5 199t-40.5 199t-109 163.5t-163.5 109t-199 40.5zm0-896q-104 0-192.5 51.5t-140 140T128 512t51.5 192.5t140 140T512 896t192.5-51.5t140-140T896 512t-51.5-192.5t-140-140T512 128zm0 704q-87 0-160.5-43T235 672.5T192 512t43-160.5T351.5 235T512 192t160.5 43T789 351.5T832 512t-43 160.5T672.5 789T512 832zm-.5-512Q432 320 376 376t-56 136t56 136t136 56t136-56t56-136t-56.5-136t-136-56zm.5 320q-53 0-90.5-37.5T384 512t37.5-90.5T512 384t90.5 37.5T640 512t-37.5 90.5T512 640z" />
                            </svg>
                        </div> -->
                        <div class="text-xl sm:text-2xl font-bold pt-4 sm:pt-6 pb-2 border-b-[0.5px] border-b-gray-300">
                            Misi Kami
                        </div>
                        <div class="my-4 space-y-4 text-sm sm:text-base text-gray-700">
                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-6 h-6 bg-primary-green-500 text-white flex items-center justify-center text-sm font-bold">1</span>
                                    <span class="leading-relaxed"><strong>Membangun Jaringan</strong> - Menghubungkan alumni dari berbagai angkatan dan latar belakang profesi untuk saling mendukung dan berkolaborasi.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-6 h-6 bg-primary-green-500 text-white flex items-center justify-center text-sm font-bold">2</span>
                                    <span class="leading-relaxed"><strong>Pengembangan Profesional</strong> - Menyelenggarakan program pelatihan, seminar, dan workshop untuk meningkatkan kompetensi dan kapasitas alumni.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-6 h-6 bg-primary-green-500 text-white flex items-center justify-center text-sm font-bold">3</span>
                                    <span class="leading-relaxed"><strong>Kontribusi Sosial</strong> - Melaksanakan kegiatan pengabdian masyarakat dan program sosial sebagai wujud kepedulian alumni terhadap lingkungan sekitar.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-6 h-6 bg-primary-green-500 text-white flex items-center justify-center text-sm font-bold">4</span>
                                    <span class="leading-relaxed"><strong>Mendukung Almamater</strong> - Berperan aktif dalam mendukung pengembangan institusi dan memberikan mentorship kepada mahasiswa aktif.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-6 h-6 bg-primary-green-500 text-white flex items-center justify-center text-sm font-bold">5</span>
                                    <span class="leading-relaxed"><strong>Memfasilitasi Peluang</strong> - Membuka akses terhadap peluang karir, bisnis, dan kemitraan strategis antar sesama alumni.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sidebar/Values Section -->
                <div class="w-full lg:w-[35%]">
                    <div class="bg-gray-50 p-4 sm:p-6 border border-gray-200">
                        <h3 class="text-lg sm:text-xl font-bold text-primary-green-900 mb-4">Nilai-Nilai Kami</h3>
                        <ul class="space-y-3 text-xs sm:text-sm text-gray-700">
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>Integritas</strong> - Menjunjung tinggi kejujuran dan etika</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>Kolaborasi</strong> - Bekerja sama untuk hasil terbaik</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>Inovasi</strong> - Terus berinovasi dan berkembang</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>Kebersamaan</strong> - Satu alumni, satu keluarga</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>Keberlanjutan</strong> - Dampak jangka panjang</span>
                            </li>
                        </ul>
                    </div>
                    @guest
                    <div class="mt-6 bg-primary-green-50 p-4 sm:p-6 border border-primary-green-200">
                        <h3 class="text-base sm:text-lg font-bold text-primary-green-900 mb-2">Bergabung Bersama Kami</h3>
                        <p class="text-xs sm:text-sm text-gray-700 mb-4">
                            Jadilah bagian dari komunitas alumni yang bergerak dan berdampak. Bersama kita bisa berbuat lebih banyak.
                        </p>
                        <a href="{{ route('register') }}" class="inline-block bg-primary-green-500 text-white px-4 py-2 text-sm font-semibold hover:bg-primary-green-600 transition">
                            Daftar Sekarang
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
