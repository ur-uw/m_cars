@section('page-title')
    {{ Str::upper($category->name) }}
@endsection
<div class="container">
    {{-- Search section --}}
    <section class="mb-6">
        <div class="flex items-center gap-3 px-6 py-4 mx-auto rounded-md shadow md:rounded-full lg:w-3/4">
            <i class="text-2xl fas fa-search text-primary"></i>
            <span class="flex-1">
                <input wire:model.debounce.350ms='term' class="w-full border-0 " type="text"
                    placeholder="Ex: Seat covers,...">
            </span>
            <span>
                <button class="hidden transition lg:block btn btn-primary">
                    Search
                </button>
            </span>
        </div>
    </section>

    {{-- Accessories Section --}}
    <section>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-4 lg:gap-4">
            @forelse ($products as $product)
                <livewire:product-card :product="$product" key="{{ $product->id }}" />
            @empty
                <h2 class="mt-10 text-xl text-center lg:text-2xl text-secondary">
                    {{-- Info icon --}}
                    <i class="fas fa-info-circle "></i>
                    No products found
                </h2>
            @endforelse
        </div>

    </section>

</div>
