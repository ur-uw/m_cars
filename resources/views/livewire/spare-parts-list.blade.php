<div class="container">
    <h1 class="text-center text-lg lg:font-semibold lg:text-4xl capitalize mb-2">
        {{ $spare_type->name }}
    </h1>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-4">
        @foreach ($spare_parts as $spare_part)
            <a href="#">
                <livewire:spare-part-card :spare_part_name="$spare_part->name" :spare_part_image="$spare_part->image"
                    key="{{ $spare_part->id }}" />
            </a>
        @endforeach
    </div>

</div>
