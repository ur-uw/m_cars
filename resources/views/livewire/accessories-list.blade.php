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
    {{-- Heading and Filters --}}
    <section class="my-10">
        <div class="flex flex-col items-start justify-between gap-2 lg:flex-row">
            <div class="mb-3">
                <h1 class="text-xl font-semibold lg:text-2xl">Accessories Catalogue</h1>
                <p class="text-sm">Explore out accessories for your car</p>
            </div>
            <div class="flex flex-col items-center justify-center w-full gap-3 lg:w-1/2 md:flex-row">
                <div class="flex items-center w-full gap-3 lg:items-start lg:flex-col lg:justify-center lg:gap-0">
                    <label for="manufacturer" class="flex-1">Manufacturer</label>
                    <select wire:click='loadManufacturers' id="manufacturer" class="flex-1"
                        wire:model='filterManufacturer' class="text-sm">
                        <option value="">All</option>
                        @if ($manufacturers)
                            @foreach ($manufacturers as $man)
                                <option value="{{ $man->id }}">{{ $man->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </section>

    {{-- Accessories Section --}}
    <section>
        <h1 class="mb-2 text-lg text-center capitalize lg:font-semibold lg:text-4xl">
            {{ $category->name }}
        </h1>
        @if (count($accessories) > 0)
            <div class="grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-4 lg:gap-4">
                @foreach ($accessories as $accessory)
                    <livewire:product-card :product="$accessory" key="{{ $accessory->id }}" />
                @endforeach
            </div>
        @else
            <h2 class="mt-10 text-2xl text-center text-secondary">
                No Accessories!
            </h2>
        @endif
    </section>

</div>
