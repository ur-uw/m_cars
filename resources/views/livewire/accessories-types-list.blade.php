@section('page-title')
    Accessory Types
@endsection
<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach ($category as $accessory_type)
            <a href="{{ route('accessory.show', ['category' => $accessory_type]) }}">
                <livewire:product-type-card :product_type_name="$accessory_type->name"
                    :product_type_image="$accessory_type->image" key="{{ $accessory_type->id }}" />
            </a>
        @endforeach
    </div>

</div>
