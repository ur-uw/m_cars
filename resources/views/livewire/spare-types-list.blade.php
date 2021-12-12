<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-4">
        @foreach ($spare_types as $spare_type)
            <livewire:spare-type-card :spare_type_name="$spare_type->name" :spare_type_image="$spare_type->image"
                key="{{ $spare_type->id }}" />
        @endforeach
    </div>

</div>
