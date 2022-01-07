<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach ($accessoryTypes as $accessoryType)
            <a href="#">
                <livewire:product-type-card :product_type_name="$accessoryType->name"
                    :product_type_image="$accessoryType->image" key="{{ $accessoryType->id }}" />
            </a>
        @endforeach
    </div>

</div>
