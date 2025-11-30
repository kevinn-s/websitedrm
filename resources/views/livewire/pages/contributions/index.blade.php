<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Mail;

use App\Models\Donation;
use App\Enums\Status;
use App\Enums\ContributionType;
use App\Mail\ContributionThankYouEmail;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    public string $type;
    public $amount;
    public $proof;

    public bool $success = false;

    public function casts(): array
    {
        return [
            'type' => ContributionType::class,
        ];
    }

    protected function rules(): array
    {
        return [
            'type' => ['required', new Enum(ContributionType::class)],
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($this->type === ContributionType::Monthly->name && $value < 10000) {
                        $fail('Minimum for Monthly contribution is Rp 10.000.');
                    }
                    if ($this->type === ContributionType::Yearly->name && $value < 100000) {
                        $fail('Minimum for Yearly contribution is Rp 100.000.');
                    }
                },
            ],
            'proof' => ['required', 'file', 'mimes:jpeg,png,pdf', 'max:2048'],
        ];
    }

    protected function messages(): array
    {
        return [
            'proof.required' => 'Bukti transfer wajib diupload.',
            'proof.file' => 'Bukti transfer harus berupa file.',
            'proof.mimes' => 'Format file bukti transfer harus JPG, PNG, atau PDF.',
            'proof.max' => 'Ukuran file bukti transfer maksimal 2MB.',
            'type.required' => 'Jenis iuran wajib dipilih.',
            'amount.required' => 'Nominal iuran wajib diisi.',
            'amount.numeric' => 'Nominal iuran harus berupa angka.',
        ];
    }
    public function save(): void
    {
        $this->validate();

        try {
            $user = auth()->user();

            Donation::create([
                'user_id' => $user?->id,
                'contribution_type' => $this->type,
                'amount' => $this->amount,
                'proof_path' => $this->proof->store('kontribusi', 'public'),
                'status' => Status::Pending,
            ]);

            // Send thank you email
            $contributionTypeLabel = $this->type === 'MONTHLY' ? 'Iuran Bulanan' : 'Iuran Tahunan';
            Mail::to($user->email)->send(new ContributionThankYouEmail(
                $user->name,
                $contributionTypeLabel,
                (string) $this->amount
            ));

            $this->reset(['type', 'amount', 'proof']);
            $this->success = true;

            // Optional: Add success message
            session()->flash('message', 'Bukti transfer berhasil diupload!');


        } catch (\Exception $e) {
            // Handle file upload errors
            session()->flash('error', 'Gagal mengupload bukti transfer: ' . $e->getMessage());
        }
    }
}; ?>

<div class="space-y-10" x-data="{ showContent: true, showSuccess: @entangle('success')}">
    <x-page-title title="Rekening Asosiasi Alumni" :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Kegiatan', 'url' => ''],
    ]" />
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-0" x-show="showContent">
        <div class="md:w-8/12">
            <div class="py-6 sm:py-10 text-base sm:text-lg md:text-lg">
                Asosiasi Alumni Doktor Riset Manajemen BINUS University berkomitmen untuk terus mengembangkan
                program-program berkualitas dan membangun jaringan alumni yang kuat. Kontribusi Anda membantu kami
                mencapai visi tersebut.
            </div>
            <div class=" text-lg md:text-lg">
                Dukungan dapat diberikan baik melalui transfer langsung maupun dengan berkomitmen pada iuran berkala
                yang telah ditetapkan.
            </div>
            <div x-data="{ activeSection: 'TRANSFER', copiedId: null }" class="py-8 md:py-12">
                <div class="hidden border-gray-300 border-b-2 md:flex font-semibold">
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
                <div class="md:hidden border-[1px] border-gray-400 font-semibold">
                    <div class="px-4 py-4 hover:bg-[#14a15b] hover:text-white transition-all duration-200 select-none"
                        :class="activeSection === 'TRANSFER' ? 'hover:bg-[#02743D] bg-[#02743D] text-white' : 'hover:bg-[#14a15b] hover:text-white'"
                        @click="activeSection = 'TRANSFER'">
                        Transfer secara langsung
                    </div>
                    <div class="px-4 py-4 hover:bg-[#14a15b] hover:text-white transition-all duration-200 select-none"
                        :class="activeSection === 'IURAN' ? 'hover:bg-[#02743D] bg-[#02743D] text-white' : 'hover:bg-[#14a15b] hover:text-white'"
                        @click="activeSection = 'IURAN'">
                        Iuran berkala</div>
                </div>
                <template x-if="activeSection === 'IURAN'">
                    <div class="space-y-12 md:pt-7 pt-11 ">
                        <div class="space-y-2">
                            <div class="text-1.5xl font-bold">
                                Iuran Berkala
                            </div>
                            <div class="text-lg">
                                Iuran berkala merupakan bentuk dukungan secara rutin yang dibayarkan dengan berjadwal.
                                sebagai donatur, anda dapat memilih skema
                                bulanan maupun tahunan:
                            </div>
                        </div>
                        <ul class="space-y-2 list-none md:w-[90%]">
                            <x-list title="Iuran Bulanan" class="text-normal" size="md+"
                                content="Kelanjutan komitmen Anda dengan pembayaran bulanan membantu kami memastikan keberlanjutan program dan kegiatan asosiasi. Anda dapat memilih nominal sesuai kemampuan Anda." />
                        </ul>
                        <ul class="space-y-2 list-none  md:w-[90%]">
                            <x-list title="Iuran Tahunan" size="md+"
                                content="Alternatif pembayaran tahunan memberikan fleksibilitas lebih dengan sistem pembayaran yang dapat disesuaikan dengan periode keuangan atau keinginan pribadi Anda." />
                        </ul>
                        <div class="md:w-8/12 text-lg space-y-4">
                            <div class="font-bold">Mulai berkontribusi untuk asosiasi alumni kami hari ini</div>
                            <div>Anda dapat melanjutkan pembayaran iuran alumni dengan menekan tombol di bawah ini:
                            </div>
                            <x-button class="relative z-20 mt-4"
                                @click="showContent = false;   $nextTick(() => {
        $nextTick(() => {
            window.scrollTo({ top: 0, behavior: 'smooth' })
        });
    });">Bayar
                                Iuran Alumni</x-button>
                        </div>
                    </div>
                </template>
                <template x-if="activeSection === 'TRANSFER'">
                    <div class=" md:pt-7 pt-11 pb-14 md:w-10/12 ">
                        <div>
                            <div class="text-1.5xl font-bold">
                                Transfer Secara Langsung
                            </div>
                            <div class="mt-2 md:mt-2 md:text-lg">
                                Anda dapat berkontribusi dengan melakukan transfer secara langsung sesuai dengan nominal
                                yang Anda inginkan. Informasi rekening tujuan dapat Anda lihat pada bagian di bawah ini:
                            </div>
                            <div class="space-y-8 font-inter my-10 md:my-14 ">
                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green-500 px-6 py-3.5">
                                        <div class="font-semibold">
                                            BANK CENTRAL ASIA
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            @click="navigator.clipboard.writeText('BANK CENTRAL ASIA'); copiedId = 'bank'; setTimeout(() => copiedId = null, 2000)"
                                            :class="copiedId === 'bank' ? 'text-green-600' : 'text-amber-700 hover:text-green-600'"
                                            class="h-6 w-6 cursor-pointer transition-colors duration-200" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" title="Klik untuk copy">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="select-none absolute -top-3 left-5 px-1 bg-white font-medium">
                                            Nama Bank
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green-500 px-6 py-3.5">
                                        <div class="font-semibold w-10/12 md:w-full">
                                            PERKUMPULAN ALUMNI DOKTOR RISET MANAJEMEN
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            @click="navigator.clipboard.writeText('PERKUMPULAN ALUMNI DOKTOR RISET MANAJEMEN'); copiedId = 'rekening'; setTimeout(() => copiedId = null, 2000)"
                                            :class="copiedId === 'rekening' ? 'text-green-600' : 'text-amber-700 hover:text-green-600'"
                                            class="h-6 w-6 cursor-pointer transition-colors duration-200 flex-shrink-0"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            title="Klik untuk copy">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="select-none absolute -top-3 left-5 px-1 bg-white font-medium">
                                            Nama Rekening
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green-500 px-6 py-3">
                                        <div class="text-[17px] font-semibold">
                                            594-188-8811
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            @click="navigator.clipboard.writeText('594-188-8811'); copiedId = 'nomor'; setTimeout(() => copiedId = null, 2000)"
                                            :class="copiedId === 'nomor' ? 'text-green-600' : 'text-amber-700 hover:text-green-600'"
                                            class="h-6 w-6 cursor-pointer transition-colors duration-200" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" title="Klik untuk copy">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="select-none absolute -top-3 left-5 px-1 bg-white font-medium">
                                            Nomor Rekening
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="relative flex justify-between border-[1px] border-primary-green-500 px-6 py-3.5">
                                        <div class="font-semibold">
                                            CABANG CIPONDOH
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            @click="navigator.clipboard.writeText('CABANG CIPONDOH'); copiedId = 'cabang'; setTimeout(() => copiedId = null, 2000)"
                                            :class="copiedId === 'cabang' ? 'text-green-600' : 'text-amber-700 hover:text-green-600'"
                                            class="h-6 w-6 cursor-pointer transition-colors duration-200" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" title="Klik untuk copy">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <label class="select-none absolute -top-3 left-5 px-1 bg-white font-medium">
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
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-0 space-y-4" x-show="showContent === false">

        <div x-data="{}">
            <form x-show="!showSuccess" wire:submit.prevent="save" x-data="{
                dropdownOpen: false,
                selectedValue: '',
                selectedFilter: 'Pilih jenis iuran',
                nominalIuran: 0,
                options: [
                    { value: 'MONTHLY', label: 'Iuran Bulanan' },
                    { value: 'YEARLY', label: 'Iuran Tahunan' }
                ],
                selectOption(value, label) {
                    this.dropdownOpen = false;
                    this.selectedValue = value;
                    this.selectedFilter = label;
                    @this.set('type', value, false);
                    if(value === 'MONTHLY'){
                        this.nominalIuran =  10000;
                        @this.set('amount', 10000, false);
                    } else if(value === 'YEARLY'){
                        this.nominalIuran = 100000;
                        @this.set('amount', 100000, false);
                    }
                },
                getMinimumAmount() {
                    return this.selectedValue === 'MONTHLY' ? 10000 : this.selectedValue === 'YEARLY' ? 100000 : 0;
                },
                validateAmount() {
                    const min = this.getMinimumAmount();
                    if (this.nominalIuran && parseInt(this.nominalIuran) < min) {
                        return false;
                    }
                    return true;
                }
            }" class="space-y-4">
                <div>
                    <x-input-label for="type" class="font-semibold">Pilih Tipe Iuran</x-input-label>

                    <div class="relative inline-block w-full my-2" @click.outside="dropdownOpen = false">
                        <button type="button" @click="dropdownOpen = !dropdownOpen"
                            class="w-full font-semibold flex items-center justify-between bg-white border border-gray-300 px-4 py-2 text-left outline-0 focus:outline-none rounded-none">
                            <span x-text="selectedFilter"></span>
                            <svg class="inline ml-2 w-4 h-4 transition-transform duration-200"
                                :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="z-30 font-normal absolute top-full left-0 w-full bg-white border border-gray-300 shadow-lg">
                            <template x-for="option in options" :key="option.value">
                                <div @click="selectOption(option.value, option.label)"
                                    class="px-4 py-2 cursor-pointer hover:bg-gray-50 transition-colors duration-150"
                                    x-text="option.label"></div>
                            </template>
                        </div>
                    </div>
                    @error('type')
                        <x-input-error :messages="$message" class="mt-1" />
                    @enderror
                </div>
                <div>
                    <x-input-label for="amount" class="font-semibold">Nominal Iuran</x-input-label>
                    <div class="relative my-2">
                        <x-text-input id="amount" type="number" name="amount" x-model="nominalIuran"
                            wire:model.defer="amount" class="w-full rounded-none border border-gray-300 px-4 py-2"
                            placeholder="Masukkan nominal" x-bind:min="getMinimumAmount()"
                            x-bind:disabled="selectedValue === ''" />
                    </div>
                    <!-- Minimum amount info -->
                    <p class="text-xm text-gray-500 mt-1" x-show="selectedValue !== ''">
                    <div x-show="selectedValue === 'MONTHLY'">
                        <span class="text-sm" x-show="nominalIuran && validateAmount()">Minimal untuk iuran bulanan: Rp
                            10.000</span>
                        <span class="text-red-600 text-xm" x-show="nominalIuran && !validateAmount()">Nominal minimum untuk
                            iuran bulanan adalah Rp 10.000</span>
                    </div>
                    <div x-show="selectedValue === 'YEARLY'">
                        <span x-show="nominalIuran && validateAmount()">Minimal untuk iuran tahunan: Rp 100.000</span>
                        <span class="text-red-600 text-xm" x-show="nominalIuran && !validateAmount()">Nominal minimum untuk
                            iuran tahunan adalah Rp 100.000</span>
                    </div>
                    </p>

                    @error('amount')
                        <x-input-error :messages="$message" class="mt-1" />
                    @enderror
                </div>
                <div>
                    <x-input-label for="proof" class="font-semibold">Bukti Transfer</x-input-label>
                    <div class="my-2 flex justify-between items-center w-full border-gray-300 border rounded-none">
                        <input id="proof" type="file" name="proof" wire:model="proof" accept="image/*,.pdf"
                            class="truncate flex-1 min-w-0" />
                        <div wire:loading wire:target="proof" class="flex-shrink-0 mr-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 2v4m0 12v4m8-10h-4M6 12H2m15.364-7.364l-2.828 2.828M7.464 17.536l-2.828 2.828m12.728 0l-2.828-2.828M7.464 6.464L4.636 3.636" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 my-2">Format: JPG, PNG, atau PDF (Maks. 2MB)</p>
                    <x-input-error :messages="$errors->get('proof')" class="mt-1" />
                </div>
                <x-button wire:click="save" type="submit" class="w-full"
                    x-bind:disabled="!selectedValue || !nominalIuran || !validateAmount()">
                    <div class="flex items-center gap-2">
                        <span class="text-base">Kirim Pembayaran</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 15 15">
                            <path fill="#ffffff"
                                d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z" />
                        </svg>
                    </div>
                </x-button>
            </form>


        </div>
    </div>
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-0" x-show="showSuccess">
                 <div class="relative overflow-hidden border border-primary-green-200 bg-white shadow-md">
                     <div class="absolute inset-y-0 left-0 w-2 bg-primary-green-500"></div>
                     <div class="relative px-4 sm:px-8 md:px-12 py-8 sm:py-10 md:py-14">
                            <div class="flex flex-col gap-6 md:flex-row md:items-start">
                                   <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-green-100 text-primary-green-700">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                 <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                   </div>
                                   <div class="flex-1 space-y-3 text-slate-700">
                                          <h1 class="font-sora text-2xl font-semibold text-primary-green-900 tracking-tight">Terima kasih telah berkontribusi</h1>
                                          <p class="text-base leading-relaxed md:text-base+">
                                                 Dukungan Anda membantu Asosiasi Alumni DRM menghadirkan program pengembangan, ruang kolaborasi, dan kegiatan yang bermanfaat bagi seluruh anggota. Tim kami akan memverifikasi bukti transfer Anda dalam waktu dekat.
                                          </p>
                                              <div class="mt-6 flex flex-wrap gap-3">
                            <x-button href="{{ route('dashboard') }}" variant="primary">Kembali ke beranda</x-button>
                     </div>
                                   </div>
                            </div>
                     </div>
              </div>
            </div>
</div>
