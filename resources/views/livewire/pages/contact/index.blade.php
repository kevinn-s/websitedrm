<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //
}; ?>

<div>
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Kontak Kami', 'url' => ''],
    ]" title="Kontak Kami" background="bg-amber-950"></x-page-title>
    <div class="px-6 md:px-36 pb-32 bg-white">
        <div class="py-10 text-lg space-y-8 md:w-[70%]">
            <div>Hubungi kami untuk informasi lebih lanjut mengenai Asosiasi Alumni Doktor Riset Manajemen.</div>
        </div>

        <div class="space-y-8 md:w-[70%] pb-16">
            <!-- Phone -->
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16"><path fill="#02743d" d="M12.2 10c-1.1-.1-1.7 1.4-2.5 1.8C8.4 12.5 6 10 6 10S3.5 7.6 4.1 6.3c.5-.8 2-1.4 1.9-2.5c-.1-1-2.3-4.6-3.4-3.6C.2 2.4 0 3.3 0 5.1c-.1 3.1 3.9 7 3.9 7c.4.4 3.9 4 7 3.9c1.8 0 2.7-.2 4.9-2.6c1-1.1-2.5-3.3-3.6-3.4z"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Nomor Telpon</h3>
                    <p class="text-gray-700 mt-1">+62 811 203 160</p>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-primary-green mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Email</h3>
                    <p class="text-gray-700 mt-1">
                        <a href="mailto:umalumni@umn.edu" class="text-primary-green hover:underline">asosiasidrm@gmail.com</a>
                    </p>
                </div>
            </div>
        
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="#02743d" fill-rule="evenodd" d="M2.5 8.123C2.5 12.366 6.882 19.5 10 19.5c3.118 0 7.5-7.134 7.5-11.377C17.5 3.917 14.146.5 10 .5S2.5 3.917 2.5 8.123ZM10 5.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5Z" clip-rule="evenodd"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Alamat</h3>
                    <p class="text-gray-700 mt-1">Arcadia Daan Mogot Blok G18 No. 1-2-3
<br>
Jl. Daan Mogot KM 21,
<br>
Batuceper Tangerang 15122</p>
                </div>
            </div>

          
        </div>

        <div class="md:w-1/2">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2871.8023769814763!2d106.6656630732005!3d-6.156710293830409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f9cee62cceb7%3A0xba6a22f075f405fb!2sPT.%20Cipta%20Aneka%20Air!5e1!3m2!1sen!2sid!4v1758100908609!5m2!1sen!2sid" class="md:w-[600] md:h-[450px] w-full h-[200px]" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
    </div>

</div>

