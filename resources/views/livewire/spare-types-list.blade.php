<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach ($spare_types as $spare_type)
            <a href="{{ route('spare_part.show', ['spare_type' => $spare_type]) }}">
                <livewire:product-type-card :product_type_name="$spare_type->name"
                    :product_type_image="$spare_type->image" key="{{ $spare_type->id }}" />
            </a>
        @endforeach
    </div>

</div>
