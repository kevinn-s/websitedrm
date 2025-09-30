<x-app-layout>


    <div class="my-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 ">Edit Profil Alumni</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">Perbarui informasi profil Anda dengan
            lengkap</p>
    </div>

    <form wire:submit.prevent="save" class="w-full md:w-3/5 mx-auto md:mx-0 space-y-8">
        
        <fieldset class="rvt-fieldset rvt-m-top-md space-y-4">
            <div class="flex flex-col">
                <label class="rvt-label" for="text-one">Nama Lengkap <span
                        class="rvt-color-orange-500 rvt-text-bold">*</span></label>
                <input class="rvt-input" type="text" id="name" name="name" wire:model="name" required>
            </div>

            <div class="flex flex-col">
                <label class="rvt-label" for="text-one">Nomor Telpon</label>
                <input class="rvt-input" type="tel" id="phone_number" name="phone_number">
            </div>
        </fieldset>

        <fieldset class="rvt-fieldset rvt-m-top-md">
            <legend class="rvt-legend border-b-[1px] pb-2 w-full">Domisili</legend>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 ">
                <div class="flex flex-col">
                    <label class="rvt-label" for="linkedin">Kota</label>
                    <input class="rvt-input" type="text" wire:model="linkedin">
                </div>

                <div class="flex flex-col">
                    <label class="rvt-label" for="x">Provinsi</label>
                    <input class="rvt-input" type="text" wire:model="x">
                </div>
            </div>
        </fieldset>

        <fieldset class="rvt-fieldset rvt-m-top-md">
            <legend class="rvt-legend border-b-[1px] pb-2 w-full">Informasi Pekerjaan</legend>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 ">
                <div class="flex flex-col">
                    <label class="rvt-label" for="linkedin">Posisi</label>
                    <input class="rvt-input" type="text" wire:model="linkedin">
                </div>

                <div class="flex flex-col">
                    <label class="rvt-label" for="x">Nama Perusahaan</label>
                    <input class="rvt-input" type="text" wire:model="x">
                </div>
            </div>
        </fieldset>

        <fieldset class="rvt-fieldset rvt-m-top-md">
            <legend class="rvt-legend border-b-[1px] pb-2 w-full">
                Akun Media Sosial
            </legend>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 ">
                <div class="flex flex-col">
                    <label class="rvt-label" for="linkedin">LinkedIn</label>
                    <input class="rvt-input" type="text" wire:model="linkedin">
                </div>

                <div class="flex flex-col">
                    <label class="rvt-label" for="x">X (twitter)</label>
                    <input class="rvt-input" type="text" wire:model="x">
                </div>

                <div class="flex flex-col">
                    <label class="rvt-label" for="instagram">Instagram</label>
                    <input class="rvt-input" type="text" wire:model="instagram">
                </div>

                <div class="flex flex-col">
                    <label class="rvt-label" for="facebook">Facebook</label>
                    <input class="rvt-input" type="text" wire:model="facebook">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend class="rvt-legend border-b-[1px] pb-2 w-full">
                Karya Ilmiah
            </legend>
            <div x-data="{
                    research: @entangle('research'),
                    add: function() {
                        this.research.push({
                            title: '',
                            type: '',
                            publication_year: new Date().getFullYear(),
                            publisher: '',
                            publication_link: ''
                        })
                    },
                    remove: function(index) {
                        this.research.splice(index, 1);
                    },
                    init: function() {
                        this.add()
                        console.log(this.research)
                    },
                }" class="space-y-2">
                <template x-for="(item, index) in research" :key="index">
                    <fieldset class="">
                        <div class="grid grid-cols-2 gap-4 mt-4 ">
                            <div class="flex flex-col">
                                <label class="rvt-label" :for="'title_' + index">Judul</label>
                                <input class="rvt-input" type="text" :id="'title_' + index"
                                    x-model="research[index].title">
                            </div>

                            <div class="flex flex-col">
                                <label class="rvt-label" :for="'type_' + index">Type</label>
                                <input class="rvt-input" type="text" :id="'type_' + index"
                                    x-model="research[index].type">
                            </div>

                            <div class="flex flex-col">
                                <label class="rvt-label" :for="'year_' + index">Publication Year</label>
                                <input class="rvt-input" type="number" :id="'year_' + index"
                                    x-model="research[index].publication_year">
                            </div>

                            <div class="flex flex-col">
                                <label class="rvt-label" :for="'publisher_' + index">Publisher</label>
                                <input class="rvt-input" type="text" :id="'publisher_' + index"
                                    x-model="research[index].publisher">
                            </div>

                            <div class="flex flex-col col-span-2">
                                <label class="rvt-label" :for="'link_' + index">Publication Link</label>
                                <div class="flex gap-2">
                                    <input class="rvt-input flex-grow" type="url" :id="'link_' + index"
                                        x-model="research[index].publication_link">
                                    <button type="button"
                                        class="rvt-button bg-red-500 text-white hover:bg-red-600 whitespace-nowrap px-5 py-1"
                                        @click="remove(index)">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </template>

                <div class="mt-6">
                    <button type="button" class="bg-blue-500 text-white px-6 py-2 rounded" @click="add()">
                        Tambah Karya Ilmiah
                    </button>
                </div>
            </div>
        </fieldset>


        <fieldset>
            <legend class="rvt-legend border-b-[1px] pb-2 w-full">
                Kompetensi
            </legend>
            <div class="space-y-4" x-data="{ 
            competency: @entangle('competency'), 
            newCompetency: '', 
            add() {
                if (this.newCompetency.trim() !== '') {
                    this.competency.push(this.newCompetency);
                    this.newCompetency = ''; // reset after adding
                }
            },
            remove(index) {
                this.competency.splice(index, 1);
            }
            }">
               
                <div class="flex flex-row">
                    <input class="rvt-input flex-grow" type="text" x-model="newCompetency"
                        placeholder="Tambah kompetensi">
                    <button type="button" @click="add()" class="bg-blue-500 text-white px-6 py-2 ml-4 rounded">
                        Tambah
                    </button>
                </div>

                <!-- List of competencies -->
                <div class="border border-gray-200 w-full flex items-center px-4 py-4">
                    <div class="flex flex-wrap  gap-2">
                        <template x-for="(item, index) in competency" :key="index">
                            <div class="flex items-center bg-green-100 px-3 py-1 rounded-full">
                                <span x-text="item"></span>
                                <button type="button" class="ml-2 text-red-500" @click="remove(index)">×</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="flex flex-col sm:flex-row items-center pt-6 gap-4">
            <button type="submit"
                class="w-full sm:w-auto px-6 py-2 text-center bg-primary-green text-white hover:bg-primary-green-dark focus:ring-4 focus:ring-blue-200">
                Simpan Perubahan
            </button>
            <a href="{{ route('alumni.profile', ["alumni" => $alumni->id]) }}"
                class="w-full sm:w-auto px-6 py-2 text-center border border-gray-500 text-gray-700 hover:bg-gray-50">
                Batal
            </a>
        </div>
    </form>


</x-app-layout>