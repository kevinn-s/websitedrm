<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //
}; ?>

<div class="space-y-10 sm:space-y-20">
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Kontak Kami', 'url' => ''],
    ]" title="Kontak Kami" background="bg-amber-950"></x-page-title>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-0 list-none grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-4">
        <div class="space-y-4 sm:space-y-3">
            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <x-list
                    title="Nomor Telpon:"
                    direction="horizontal"
                    size="md"
                    content=""
                />
                <span class="text-base sm:text-lg tracking-wide">
                    +62 811 203 160
                </span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <x-list
                    title="Email:"
                    direction="horizontal"
                    size="md"
                    content=""
                />
                <a href="mailto:asosiasidrm@gmail.com" class="font-bold underline text-primary-green-500 text-base sm:text-lg tracking-wide break-all sm:break-normal">
    asosiasidrm@gmail.com
</a>

            </div>
            <div class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-2">
                <x-list
                    title="Alamat:"
                    direction="horizontal"
                    size="md"
                    content=""
                />
                <span class="text-base sm:text-lg tracking-wide">
                    Arcadia Daan Mogot Blok G18 No. 1-2-3<br>
    Jl. Daan Mogot KM 21,
    Batuceper Tangerang 15122
                </span>
            </div>
        </div>
        <div class="w-full">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2871.8023769814763!2d106.6656630732005!3d-6.156710293830409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f9cee62cceb7%3A0xba6a22f075f405fb!2sPT.%20Cipta%20Aneka%20Air!5e1!3m2!1sen!2sid!4v1758100908609!5m2!1sen!2sid" class="w-full h-64 sm:h-80" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

</div>

