<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center">
        @foreach ($alumni as $a)
            <x-alumni.card :alumni="$a"></x-alumni.card>
        @endforeach
    </div>
</div>
