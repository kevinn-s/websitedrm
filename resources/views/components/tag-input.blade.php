<div 
    x-data="{
        tags: @entangle($attributes->wire('model')),
        tag: null,
        focused: false,
        init() {

            if (this.tags == null || !Array.isArray(this.tags)) {
                this.tags = [];
            }

        // Fix weird issue when navigating back
        document.addEventListener('livewire:navigating', () => {
                            let elements = document.querySelectorAll('.tags-element');
                            elements.forEach(el =>  el.remove());
                        });
                    },
                    push() {
                        if (this.tag != '' && this.tag != null && this.tag != undefined) {
                            let tag = this.tag.toString().replace(/,/g, '').trim()

                            if (tag != '' && !this.hasTag(tag)) {
                                this.tags.push(tag)
                            }
                        }

                        this.clear()
                    },

                    hasTag(tag) {
                        var tag = this.tags.find(e => {
                            e = e.toString();
                            return e.toLowerCase() === tag.toLowerCase()
                        })
                        return tag != undefined
                    },

                    remove(index) {
                        this.tags.splice(index, 1)
                    },

                    clear() {
                        this.tag = null;
                        this.focused = false;
                    },

                    clearAll() {
                        this.tags = [];
                    },

                    focus() {
                        this.focused = true
                        $refs.searchInput.focus()
                    },

                    resize() {
                        $refs.searchInput.style.width = ($refs.searchInput.value.length + 1) * 0.55 + 'rem'
                    }
}" 
    {{ $attributes->except('wire:model')->merge(['class' => '']) }}
>

    <input 
        id="{{ $uuid }}" 
        type="text" 
        enterkeyhint="done" 
        x-ref="searchInput" 
        class="w-full h-10 {{ $inputClass }}" 
        x-model="tag"
        placeholder="{{ $attributes->get('placeholder') }}"
        @input="focus();" 
        @focus="focus()" 
        @click.outside="clear()" 
        @keydown.enter.prevent="push()"
        @keyup.prevent="if (event.key === ',') { push() }" 
    />

    <div wire:key="tags-{{ $uuid }}" class="flex flex-wrap gap-2 p-2 border-gray-200 border-[0.25px]">
        <template :key="index" x-for="(tag, index) in tags">
            <div
                class="relative cursor-pointer rounded-md bg-slate-800 pt-0.5 pb-1 px-2 border border-transparent text-sm text-white transition-all shadow-sm max-w-full">
                <div class="flex items-center gap-1"> 
                <div x-text="tag" class="break-all max-w-full"></div>
                <button
                    class="transition-all rounded-md text-white hover:bg-white/10 active:bg-white/10 h-full pt-0.5 flex-shrink-0"
                    type="button" @click="remove(index)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                    </svg>
                </button></div>
            </div>
        </template>
</div>
</div>