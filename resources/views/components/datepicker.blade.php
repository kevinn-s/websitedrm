 <div class="relative" wire:ignore
     x-data="{ date: '' }"
      @clear-datepicker.window="date= ``;"

     x-init="$watch('date', value => {
         // If you’re selecting a single date
        console.log(date)
         $dispatch('date-range-selected', { startDate: value, endDate: value });
     })"
     x-on:date-range-selected="
        date = $event.detail.startDate;
        $wire.updateDate(date);
    "
    style="user-select: none"
>
    <input x-model="date" readonly
           class="datepicker form-input pl-9 text-gray-600 hover:text-gray-800 font-medium w-[15.5rem]"
           placeholder="Select dates"
           data-class="flatpickr-right"
    />
    <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
        <svg class="fill-current text-gray-400 ml-3" width="16" height="16" viewBox="0 0 16 16">
            <path d="M5 4a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z" />
            <path d="M4 0a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4H4ZM2 4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z" />
        </svg>
    </div>
</div>