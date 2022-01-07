<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach ($accessoryTypes as $accessory_type)
            <a href="{{ route('accessory.show', ['accessory_type' => $accessory_type]) }}">
                <livewire:product-type-card :product_type_name="$accessory_type->name"
                    :product_type_image="$accessory_type->image" key="{{ $accessory_type->id }}" />
            </a>
        @endforeach
    </div>

</div>
