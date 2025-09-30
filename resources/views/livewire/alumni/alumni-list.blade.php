<div>
    <div class="flex space-x-4">
        <div class="rvt-cols-6-md rvt-m-top-lg rvt-m-top-none-md-up flex flex-col w-full">
            <label class="rvt-label" for="people-filter">Pencarian Nama</label>
            <input wire:model.live.debounce.300="search" type="text" class="rvt-input" id="people-filter"
                placeholder="Cari dengan nama anggota asosiasi alumni" wire:model="search">
        </div>
    </div>

    @forelse ($alumni as $a)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center my-12">

            <x-alumni.card :alumni="$a"></x-alumni.card>

        </div>
    @empty
        <div class="h-32 flex justify-center items-center">
            Data Tidak Ditemukan
        </div>
    @endforelse
</div>