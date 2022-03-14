@section('page-title')
    Spare Part Types
@endsection
<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach ($spare_categories as $spare_category)
            <a href="{{ route('spare_part.show', ['category' => $spare_category]) }}">
                <livewire:product-type-card :product_type_name="$spare_category->name"
                    :product_type_image="$spare_category->image" key="{{ $spare_category->id }}" />
            </a>
        @endforeach
    </div>

</div>
